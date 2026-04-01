<?php
$gallery = ( isset($args['gallery']) && !empty($args['gallery']) ) ? $args['gallery'] : '';

if ( !empty($gallery) ): ?>
    <div class="gallery-wrapper">
        <?php foreach($gallery as $img):
            if ( !empty($img) ): ?>
                <div class="img-wrapper">
                    <?php get_template_part( 'components/image', null, ['img' => $img] ); ?>
                </div>
            <?php endif;
        endforeach; ?>
    </div>
<?php endif;