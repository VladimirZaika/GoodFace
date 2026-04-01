<?php
$options = ( isset($args['options']) && !empty($args['options']) ) ? true : false;
$btnClass = ( isset($args['btn_class']) && !empty($args['btn_class']) ) ? $args['btn_class'] : '';
$visible = ( isset($args['visible']) && !empty($args['visible']) ) ? 'visible' : 'hidden';
$popupStatus = ( isset($args['popup_status']) && !empty($args['popup_status']) && $args['popup_status'] === 'off' ) ? 'popup-overlay-transparent' : 'popup-overlay';
$popupOverlayClass = $popupStatus . ' ' . $visible;

$title = ( isset($args['title']) && !empty($args['title']) ) ? $args['title'] : '';
$text = ( isset($args['text']) && !empty($args['text']) ) ? $args['text'] : '';

$img = ( isset($args['image']) && !empty($args['image']) ) ? $args['image'] : '';
$mobSize = ( isset($args['mob_size']) && !empty($args['mob_size']) ) ? $args['mob_size'] : '';

$btn = ( isset($args['btn']) && !empty($args['btn']) ) ? $args['btn'] : '';

$bgc = ( isset($args['bgc']) && !empty($args['bgc']) ) ? 'background-color: ' . $args['bgc'] . ';' : false;
$bgImg = ( isset($args['image_desk']) && !empty($args['image_desk']) ) ? $args['image_desk'] : '';
$bgImgMob = ( isset($args['image_mob']) && !empty($args['image_mob']) ) ? $args['image_mob'] : '';

if ( $options ):
    $title = ( isset($args['title']) && !empty($args['title']) ) ? get_field($args['title'], 'options') : '';
    $text = ( isset($args['text']) && !empty($args['text']) ) ? get_field($args['text'], 'options') : '';

    $img = ( isset($args['image']) && !empty($args['image']) ) ? get_field($args['image'], 'options') : '';

    $btn = ( isset($args['btn']) && !empty($args['btn']) ) ? get_field($args['btn'], 'options') : '';

    $bgc = ( isset($args['bgc']) && !empty($args['bgc']) ) ? 'background-color: ' . get_field($args['bgc'], 'options') . ';' : false;
    $bgImg = ( isset($args['image_desk']) && !empty($args['image_desk']) ) ? get_field($args['image_desk'], 'options') : '';
    $bgImgMob = ( isset($args['image_mob']) && !empty($args['image_mob']) ) ? get_field($args['image_mob'], 'options') : '';
endif;

$background = $bgc ? 'style="' . $bgc . '"' : false;

if ( !empty($title) || !empty($text) || !empty($img) ): ?>
    <div class="<?= $popupOverlayClass ?>"
        <?php if ( $background ):
            echo $background;
        endif; ?>
    >
        <div class="popup-wrapper">
            <div class="container">
                <div class="popup">
                    <?php if ( !empty($bgImg) || !empty($bgImgMob) ):
                        $bgArgs = [
                            'img' => $bgImg,
                            'img_mob' => $bgImgMob,
                            'mob_size' => $mobSize,
                        ]; ?>

                        <div class="bg-img-wrapper">
                            <?php get_template_part( 'components/image', null, $bgArgs ); ?>
                        </div>
                    <?php endif;

                    if ( !empty($img) ): ?>
                        <div class="img-wrapper">
                            <?php get_template_part( 'components/image', null, ['img' => $img, 'mob_size' => $mobSize] ); ?>
                        </div>
                    <?php endif;

                    if ( !empty($title) ): ?>
                        <div class="title-wrapper">
                            <span class="popup-title"><?= goodface_prepare_macros( $title ); ?></span>
                        </div>
                    <?php endif;

                    if ( !empty($text) ): ?>
                        <div class="content-wrapper">
                            <p class="popup-text"><?= goodface_prepare_macros( $text ); ?></p>
                        </div>
                    <?php endif;

                    if ( !empty($btn) ): ?>
                        <div class="btn-wrapper">
                            <?php
                                if ( !empty($btn) ):
                                    $target = $btn['target'] ? $btn['target']: '_self';
                                    $url = $btn['url'] ? $btn['url']: '';
                                    $descr = $btn['title'] ? $btn['title']: '';
                                
                                    $btnArgs = [
                                        'label' => $descr,
                                        'type' => 'primary',
                                        'link' => $url,
                                        'target' => $target,
                                        'custom_class' => $btnClass,
                                    ];

                                    get_template_part( 'components/button', null, $btnArgs );
                                endif;
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>