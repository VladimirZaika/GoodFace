export async function presendValidation(action = 'form_check', form) {
    const validationInfo = {
        bot: false,
        recaptcha: false,
        hp: false,
    };

    if (!form || !wpData?.ajaxUrl) {
        return validationInfo;
    }

    const data = new FormData();
    const hp = form.querySelector('.hpv-input');

    if (hp) {
        validationInfo.hp = true;
        data.append('hpv', hp.value);
    }

    if (window.grecaptcha && wpData?.siteKey) {
        try {
            await new Promise(resolve => grecaptcha.ready(resolve));
            const token = await grecaptcha.execute(wpData.siteKey, { action });

            validationInfo.recaptcha = true;
            data.append('recaptcha_token', token);
            data.append('recaptcha_action', action);
        } catch (e) {
            console.warn('reCAPTCHA failed, skipping');
        }
    }

    if (!validationInfo.hp && !validationInfo.recaptcha) {
        return validationInfo;
    }

    data.append('action', 'check_form');

    try {
        const response = await fetch(wpData.ajaxUrl, {
            method: 'POST',
            body: data,
        });

        const result = await response.json();
        validationInfo.bot = !!result?.bot_detected;

    } catch (e) {
        console.error('Presend validation error:', e);
    }

    return validationInfo;
}
