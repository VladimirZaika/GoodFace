import { presendValidation } from '../../utils/recaptcha-honeypot/recaptcha-honeypot.js';

document.addEventListener( 'DOMContentLoaded', () => {
    const popupOverlay = document.querySelector('.popup-overlay');
    const form = document.getElementById('gr-subscribe-form');
    const inputEmail = form ? form.querySelector('.email-input') : false;
    const emailWrapper = form ? form.querySelector('.email-input-wrapper') : false;
    const messageBox = document.getElementById('gr-message');
    const preloaderWrap = form ? form.querySelector('.button-preloader-wrap') : false;

    if (inputEmail) {
        inputEmail.addEventListener('input', () => {
            if (emailWrapper) {
                emailWrapper.classList.remove('invalid');
            }

            if (messageBox) {
                messageBox.innerText = '';
            }
        });
    }

    if (form) {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            document.body.classList.add('processing');
            preloaderWrap?.classList.add('processing');

            const isHuman = await presendValidation('gr_subscribe', form);

            if (isHuman.bot) {
                document.body.classList.remove('processing');
                preloaderWrap?.classList.remove('processing');
                emailWrapper.classList.add('invalid');

                if (messageBox) {
                    messageBox.innerText = 'Suspicious activity';
                }

                return;
            }

            const email = this.email.value;
            const name = this.name.value;
            const data = new FormData();

            data.append('action', 'gr_subscribe');
            data.append('name', name);
            data.append('email', email);
            data.append('id', wpData?.id);

            const res = await fetch(wpData?.ajaxUrl, {
                method: "POST",
                body: data,
            });

            const result = await res.json();

            document.body.classList.remove('processing');
            preloaderWrap?.classList.remove('processing');

            if (messageBox && result.message) {
                messageBox.innerText = result.message;
            }

            if (result.success && popupOverlay) {
                (function () {
                    window.dataLayer = window.dataLayer || [];

                    window.dataLayer.push({
                        event: 'generate_lead',
                        utm_source: getUTMValue('utm_source'),
                        utm_medium: getUTMValue('utm_medium'),
                        utm_campaign: getUTMValue('utm_campaign'),
                        utm_content: getUTMValue('utm_content'),
                        utm_term: getUTMValue('utm_term'),
                        email: data.get('email') || '',
                    });

                    popupOverlay.classList.remove('hidden');

                    requestAnimationFrame(() => {
                        popupOverlay.classList.add('show');
                        document.documentElement.classList.add('lock', 'popup-open');
                    });
                })();

                form.reset();

                emailWrapper?.classList.remove('invalid');
                if (messageBox) messageBox.innerText = '';
            } else {
                emailWrapper.classList.add('invalid');
            }
        });
    }
});