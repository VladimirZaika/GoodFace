<?php
$postCard = ( isset($args['post']) && !empty($args['post']) ) ? $args['post'] : '';

if ( !empty($postCard) ):
    $postId = $postCard->ID;
    $postLink = get_permalink($postId);

    $tags = get_field('tags', $postId);

    $title = $postCard->post_title; 
    $excerpt = $postCard->post_excerpt;

    $colTitle_1 = get_field('title_1', $postId);
    $colTitle_4 = get_field('title_4', $postId);
    
    $btn = get_field('button', $postId);
    $btn_disabled = get_field('link_field_disabled');
    ?>
    
    <article class="card post-card">
        <?php if ( !empty($tags) ): ?>
            <div class="tags-wrapper">
                <span class="tag"><?= $tags['label']; ?></span>
            </div>
        <?php endif;

        if ( !empty($title) ): ?>
            <div class="title-wrapper">
                <a href="<?= $postLink?>"><h5><?= esc_html($title); ?></h5></a>
            </div>
        <?php endif;

        if ( !empty($postCard->post_excerpt) ): ?>
            <div class="content-wrapper post-card-content-wrapper">
                <a href="<?= $postLink?>"><p><?= esc_html($excerpt); ?></p></a>
            </div>
        <?php endif; ?>

        <div class="conditions-wrapper">
            <?php if ( !empty($colTitle_1) ):
                $customCol_1 = get_field('text_switcher_1', $postId);
                $colText_1 = $customCol_1 ? get_field('text_1', $postId) : get_field('col_text_1', 'options');
                $colArgs = [
                    'col_title'=> $colTitle_1,
                    'col_text' => $colText_1,
                ];

                get_template_part( 'components/col-sm', null, $colArgs );
            endif;

            if ( !empty($colTitle_4) ):
                $customCol_4 = get_field('text_switcher_4', $postId);
                $colText_4 = $customCol_4 ? get_field('text_4', $postId) : get_field('col_text_4', 'options');
                $colArgs = [
                    'col_title'=> $colTitle_4,
                    'col_text' => $colText_4,
                ];

                get_template_part( 'components/col-sm', null, $colArgs );
            endif; ?>
        </div>

        <div class="btn-wrapper post-card-btn-wrapper">
            <?php
            if ( !empty($btn) ):
                $target = $btn['target'] ? $btn['target'] : '_self';
                $url = $btn['url'] ? $btn['url'] : '';
                $descr = $btn['title'] ? $btn['title'] : '';
                $disabled = isset($btn['disabled']) && $btn['disabled'] ? true : false;

                $btnArgs = [
                    'label' => $descr,
                    'type' => 'primary',
                    'link' => $url,
                    'target' => $target,
                    'disabled' => $btn_disabled,
                    'custom_class' => 'link-utm',
                ];

                get_template_part( 'components/button', null, $btnArgs );
            endif;

                if ( isset($postLink) && !empty($postLink) ):
                    $target = '_self';
                    $url = $postLink;
                    $descr = 'See more';

                    $linkArgs = [
                        'label' => $descr,
                        'link' => $url,
                        'target' => $target,
                    ];

                    get_template_part( 'components/link', null, $linkArgs );
                endif;
            ?>
        </div>
    </article>
<?php endif; ?>