<?php
/**
 * Archive: Marketplace
*
* This is the template that displays the archive Marketplace page
*/

get_header();

$currentTerm = get_queried_object();

if ( $currentTerm && !is_wp_error( $currentTerm ) ):
    $name = $currentTerm->label ?? '';
    $tax = 'marketplace_category';
    $slug = $currentTerm->slug ?? $currentTerm->rewrite['slug'];
    $sectionClass = ( isset($slug) && !empty($slug) ) ? ' section-' . $slug . ' section-' . $tax : '';

    $eyebrow = get_field('archive_marketplace_eyebrow', 'options');
    $customHeading = get_field('archive_marketplace_heading_custom', 'options');
    $title = $customHeading ? get_field('archive_marketplace_custom_title', 'options') : $name;
    $descr = get_field('archive_marketplace_descr', 'options');
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
        <?php if ( !empty($title) || !empty($descr) ): ?>
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

        $terms = get_terms([
            'taxonomy' => $tax,
            'hide_empty' => true,
            'orderby'    => 'count',
            'order'      => 'DESC',
        ]);

        if ( !empty($terms) && !is_wp_error($terms) ) : ?>
            <div class="filter-wrapper">
                <ul class="filter-list">
                    <?php $filterBtnArgs = [
                        'label' => 'All',
                        'link' => get_post_type_archive_link('marketplace'),
                        'target' => '_self',
                        'type' => 'filter',
                        'custom_class' => 'active',
                    ]; ?>

                    <li>
                        <?php get_template_part( 'components/button', null, $filterBtnArgs ); ?>
                    </li>

                    <?php foreach ( $terms as $term ):
                        $name = $term->name;
                        $filterBtnArgs = [
                                'label' => $name,
                                'link' => get_term_link($term),
                                'target' => '_self',
                                'type' => 'filter',
                            ]; ?>

                        <li>
                            <?php get_template_part( 'components/button', null, $filterBtnArgs ); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
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
        <?php if ( have_posts() ): ?>
            <div class="post-cards-wrapper">
                <?php while ( have_posts() ):
                    the_post();
                    $postObj = get_post();
                    $index++;

                    get_template_part( 'components/marketplace-card', null, [ 'post' => $postObj ] );
                endwhile; ?>
            </div>
        <?php else: ?>
            <p><?php _e( 'Posts Not Found.', 'goodface' ); ?></p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
