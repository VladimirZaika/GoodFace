<?php
$id = ( isset($args['id']) && !empty($args['id']) ) ? $args['id'] : '';
$options = ( isset($args['options']) && !empty($args['options']) ) ? $args['options'] : false;
$index = ( isset($args['index']) && !empty($args['index']) ) ? $args['index'] : '';

if ($options) {
    $id = 'options';
}

$bgc = get_field('cta_card_bgc', $id) ? 'background-color: ' . get_field('cta_card_bgc', $id) . ';' : false;
$background = $bgc ? 'style="' . $bgc . '"' : false;
$bgImg = get_field('cta_card_bg_img', $id);
$bgImgMob = get_field('cta_card_bg_img_mob', $id);

$img = get_field('cta_card_img', $id);
$title = get_field('cta_card_title', $id);
$content = get_field('cta_card_text', $id);
$btn = get_field('cta_card_btn', $id);

if ( !empty($img) || !empty($title) || !empty($content) || !empty($btn) ): ?>
    <article class="card cta-card" data-index="<?= $index; ?>">
        <?php if ( !empty($bgImg) || !empty($bgImgMob) ):
            $bgArgs = [
                'img' => $bgImg,
                'img_mob' => $bgImgMob,
            ]; ?>

            <div class="bg-img-wrapper">
                <?php get_template_part( 'components/image', null, $bgArgs ); ?>
            </div>
        <?php endif;

        if ( !empty($img) ): ?>
            <div class="img-wrapper">
                <?php get_template_part( 'components/image', null, ['img' => $img] ); ?>
            </div>
        <?php endif;

        if ( !empty($title) ): ?>
            <div class="title-wrapper text-center">
                <h3><?= esc_html($title); ?></h3>
            </div>
        <?php endif;

        if ( !empty($content) ): ?>
            <div class="content-wrapper text-center">
                <p><?= $content; ?></p>
            </div>
        <?php endif;

        if ( !empty($btn) ): ?>
            <div class="btn-wrapper">
                <?php
                    $target = $btn['target'] ? $btn['target']: '_self';
                    $url = $btn['url'] ? $btn['url']: '';
                    $descr = $btn['title'] ? $btn['title']: '';
                
                    $btnArgs = [
                        'label' => $descr,
                        'type' => 'primary',
                        'link' => $url,
                        'target' => $target,
                    ];

                    get_template_part( 'components/button', null, $btnArgs );
                ?>
            </div>
        <?php endif; ?>
    </article>
<?php endif; ?>