<?php get_header();
$currentTerm = get_queried_object();

if ( $currentTerm && ! is_wp_error( $currentTerm ) ):
    $name = $currentTerm->name;
    $tax = $currentTerm->taxonomy ?? $name;
    $isNewsroom = $tax === 'newsroom-category';
    $isMissions = $tax === 'missions-category';
    $isMarketplace = $tax === 'marketplace';
    $isBlog = $tax === 'category';
    $slug = $currentTerm->slug ?? $currentTerm->rewrite['slug'];
    $sectionClass = ( isset($slug) && !empty($slug) ) ? ' section-' . $slug . ' section-' . $tax : '';
    $firstPostObj = '';

    $eyebrow = get_field('eyebrow', $currentTerm);
    $customHeading = get_field('heading_custom', $currentTerm);
    $title = $customHeading ? get_field('custom_title', $currentTerm) : $name;
    $descr = $currentTerm->description;
    $relatedArticle = get_field('related_article', $currentTerm);
endif;

if ( $isMissions || $isMarketplace ):
    $suddenBg = get_field('sudden_bg_cat_mission', 'options');
endif;

if ( $isNewsroom ):
    $suddenBg = get_field('sudden_bg_cat_newsroom', 'options');
endif;

if ( $isBlog ):
    $suddenBg = get_field('sudden_bg_cat_blog', 'options');
endif;

$sectionName = 'archive';
$blockId = wp_unique_id('block-');
$blockId_2 = wp_unique_id('grid-block-');
$index = 0;

yoast_breadcrumbs_output(); ?>

<section
    class="section-<?= $sectionName; ?>-top section-<?= $sectionName . $sectionClass; ?>"

    <?php if ( $blockId ): ?>
        id="<?php echo $blockId; ?>"
    <?php endif; ?>
>
    <div class="container <?= $sectionName; ?>-container">
        <?php if ( $suddenBg ):
            if ( $isMissions || $isMarketplace ):
                $suddenBgDesk = get_field('sudden_bg_cat_mission_desk', 'options');
                $suddenBgMob = get_field('sudden_bg_cat_mission_mob', 'options');
                $suddenBgDesk_2 = get_field('sudden_bg_cat_mission_desk_2', 'options');
                $suddenBgMob_2 = get_field('sudden_bg_cat_mission_mob_2', 'options');
            endif;

            if ( $isNewsroom ):
                $suddenBgDesk = get_field('sudden_bg_cat_newsroom_desk', 'options');
                $suddenBgMob = get_field('sudden_bg_cat_newsroom_mob', 'options');
                $suddenBgDesk_2 = get_field('sudden_bg_cat_newsroom_desk_2', 'options');
                $suddenBgMob_2 = get_field('sudden_bg_cat_newsroom_mob_2', 'options');
            endif;

            if ( $isBlog ):
                $suddenBgDesk = get_field('sudden_bg_cat_blog_desk', 'options');
                $suddenBgMob = get_field('sudden_bg_cat_blog_mob', 'options');
                $suddenBgDesk_2 = get_field('sudden_bg_cat_blog_desk_2', 'options');
                $suddenBgMob_2 = get_field('sudden_bg_cat_blog_mob_2', 'options');
            endif;
        
            $bgArgs = [
                'img' => $suddenBgDesk,
                'img_mob' => $suddenBgMob,
                'section' => $sectionName,
            ];

            $bgArgs_2 = [
                'img' => $suddenBgDesk_2,
                'img_mob' => $suddenBgMob_2,
                'section' => 'sudden-bg-wrapper-second ' . $sectionName,
            ];

            get_template_part( 'components/image', null, $bgArgs );
            get_template_part( 'components/image', null, $bgArgs_2 );
        endif;

        if ( !empty($title) || !empty($descr) ): ?>
            <div class="text-wrapper">
                <?php if ( !empty($eyebrow) ):
                    get_template_part( 'components/eyebrow', null, ['text' => $eyebrow] );
                endif;
                
                if ( !empty($title) ) : ?>
                    <div class="title-wrapper">
                        <h1><?= goodface_prepare_macros( $title ); ?></h1>
                    </div>
                <?php endif;

                if ( !empty($descr) ) : ?>
                    <div class="content-wrapper">
                        <?= wpautop( $descr ); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif;

        if ( $isMissions || $isMarketplace ):
            $currentTermId = $currentTerm->term_id;
            $terms = get_terms([
                'taxonomy' => $tax,
                'hide_empty' => true,
                'orderby'    => 'count',
                'order'      => 'DESC',
            ]);

            if ( !empty($terms) && !is_wp_error($terms) ) : ?>
                <div class="filter-wrapper">
                    <ul class="filter-list">
                        <?php foreach ( $terms as $term ):
                            $isActive = $term->term_id === $currentTermId;
                            $name = $term->parent == 0 ? 'All' :  $term->name;
                            $filterBtnArgs = [
                                    'label' => $name,
                                    'link' => get_term_link($term),
                                    'target' => '_self',
                                    'type' => 'filter',
                                    'custom_class' => $isActive ? 'active' : '',
                                ]; ?>

                            <li>
                                <?php get_template_part( 'components/button', null, $filterBtnArgs ); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif;
        endif;

        if ( have_posts() && $isBlog ):
            the_post();
            $firstPostObj = get_post(); ?>

            <div class="full-width-post-wrapper">
                <?php get_template_part( 'components/newsroom-card', null, [ 'post' => $firstPostObj, 'index' => 0 ] ); ?>

                <div class="form-side-wrapper">
                    <?php
                        get_template_part( 'template-parts/sections/section-subscriber' );

                        if ( !empty($relatedArticle) ):
                            get_template_part( 'components/related-article-card', null, ['post' => $relatedArticle] );
                        endif;
                    ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<section
    class="section-<?= $sectionName; ?>-grid section-<?= $sectionName . $sectionClass; ?>"

    <?php if ( $blockId_2 ): ?>
        id="<?php echo $blockId_2; ?>"
    <?php endif; ?>
>
    <div class="container <?= $sectionName; ?>-container">
        <?php if ( have_posts() ):
            if ( $isNewsroom || $isBlog ): ?>
                <div class="title-wrapper grid-card-title-wrapper">
                    <?php if ( $currentTerm->parent == 0 ): ?>
                        <h2><?php _e('All articles', 'goodface'); ?></h2>
                    <?php else: ?>
                        <h2><?= esc_html( $currentTerm->name ) . ' articles'; ?></h2>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="post-cards-wrapper">
                <?php while ( have_posts() ) : the_post();
                    $postObj = get_post();
                    $index++;

                    if ( $isMissions || $isMarketplace ):
                        get_template_part( 'components/marketplace-card', null, [ 'post' => $postObj ] );
                    endif;

                    if ( $isNewsroom || $isBlog ):
                        if ( $isNewsroom && $index === 3 ):
                            get_template_part( 'components/cta-card', null, [ 'options' => true, 'index' => $index ] );

                            $index++;
                        endif;

                        get_template_part( 'components/newsroom-card', null, [ 'post' => $postObj, 'index' => $index ] );
                    endif;
                endwhile; ?>
            </div>

            <?php if ( $isNewsroom || $isBlog ): ?>
                <div class="btn-wrapper load-more-btn-wrapper">
                    <?php
                        $btnArgs = [
                            'label' => 'Show more',
                            'link' => '#',
                            'target' => '_self',
                            'type' => 'dark',
                            'preloader' => true,
                        ];

                        get_template_part( 'components/button', null, $btnArgs );
                    ?>
                </div>
            <?php endif;
        else:
            if ( empty($firstPostObj) ): ?>
                <p><?php _e( 'Posts Not Found.', 'goodface' ); ?></p>
            <?php endif;
        endif; ?>
    </div>
</section>

<?php
    if ( $isNewsroom && is_active_sidebar('section-goodface-2') ):
        dynamic_sidebar( 'section-goodface-2' );
    endif;

    get_footer();
?>
