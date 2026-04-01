<?php
$addtionalFields = ( isset($args['addtional_fields']) && !empty($args['addtional_fields']) ) ? true : false;
$labels = ( isset($args['labels']) && !empty($args['labels']) && $args['labels'] === 'off' ) ? true : false;
?>

<form
    class="form"
    id="gr-subscribe-form"
    method="post"
    action="/"
>
    <?php if ( $addtionalFields ): ?>
        <div class="input-wrapper name-input-wrapper">
            <?php if ( !$labels ): ?>
                <label class="label" for="name"><?php _e( 'Name', 'goodface' ); ?></label>
            <?php endif; ?>

            <input
                class="input name-input"
                id="name"
                type="text"
                name="text"
                placeholder="<?php _e( 'Name', 'goodface' ); ?>"
                required
            >
        </div>
    <?php endif; ?>

    <div class="input-wrapper email-input-wrapper">
        <?php if ( !$labels ): ?>
            <label class="label" for="email"><?php _e( 'Email', 'goodface' ); ?></label>
        <?php endif; ?>

        <input
            class="input email-input"
            id="email"
            type="email"
            name="email"
            placeholder="<?php _e( 'my_email@mail.com', 'goodface' ); ?>"
            required
        >
        <div class="input-message" id="gr-message"></div>
    </div>

    <div class="input-wrapper hpv-input-wrapper d-none">
        <?php if ( !$labels ): ?>
            <label class="label" for="hpv"><?php _e( 'Hpv', 'goodface' ); ?></label>
        <?php endif; ?>

        <input
            class="input hpv-input"
            id="hpv"
            type="text"
            name="hpv"
            placeholder="<?php _e( 'Hpv', 'goodface' ); ?>"
            value=""
        >
    </div>

    <div class="btn-wrapper">
        <div class="button-preloader-wrap">
            <button class="button button-primary" type="submit">
                <span class="button-text"><? _e('Subscribe', 'goodface'); ?></span>
            </button>

            <?php get_template_part( 'components/preloader' ); ?>
        </div>
    </div>
</form>