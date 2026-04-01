<?php /**
 * Post: Blog
*
* This is the template that displays the single Blog post
*/

get_header();
$id = get_the_ID();
$sectionName = 'single-blog';
$sectionName_2 = 'related-articles';
$blockId = wp_unique_id('block-');

$customHeading = get_field('heading_custom', $id);
$title = $customHeading ? get_field('custom_title', $id) : get_the_title();
$readingTime = get_field('reading_time', $id);

$postThumbnailId = get_post_thumbnail_id($id);
$suddenBg = get_field('sudden_bg_post_blog', 'options');

$viewCount = (int) get_field('view_count', $id);
$increaseCounter = get_field('increase_counter', $id);

$floatMsgArgs = [
    'text' => get_field('blog_post_float_msg_text', 'options'),
    'image' => get_field('blog_post_float_msg_icon', 'options'),
    'custom_class' => 'blog-post-float-msg',
];

if ( $increaseCounter ):
    $increasedCount = (int) get_field('view_count_upd', $id);

    $viewCount += $increasedCount;
endif;

if ( $postThumbnailId ):
    $img = [
        'url'   => wp_get_attachment_image_url( $postThumbnailId, 'full' ),
        'sizes' => [
            'medium_large' => wp_get_attachment_image_url( $postThumbnailId, 'medium_large' ),
        ],
        'alt'   => get_post_meta( $postThumbnailId, '_wp_attachment_image_alt', true ),
    ];
endif;

yoast_breadcrumbs_output(); ?>

<section
    class="section-single section-<?php echo $sectionName; ?>"

    <?php if ( $blockId ): ?>
        id="<?php echo $blockId; ?>"
    <?php endif; ?>
>
    <div class="container <?php echo $sectionName; ?>-container">
        <?php if ( $suddenBg ):
            $suddenBgDesk = get_field('sudden_bg_post_blog_desk', 'options');
            $suddenBgMob = get_field('sudden_bg_post_blog_mob', 'options');
            $suddenBgDesk_2 = get_field('sudden_bg_post_blog_desk_2', 'options');
            $suddenBgMob_2 = get_field('sudden_bg_post_blog_mob_2', 'options');
        
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
        endif; ?>

        <div class="post-wrapper">
            <div class="left-side-content">
                <?php if ( !empty($title) ): ?>
                    <div class="title-wrapper">
                        <h1><?= goodface_prepare_macros( $title ); ?></h1>
                    </div>
                <?php endif; ?>

                <div class="info-wrapper">
                    <?php get_template_part( 'components/date', null, ['id' => $id] ); ?>

                    <div class="counts-wrapper">
                        <?php if ( !empty($readingTime) ):
                            get_template_part( 'components/reading-time', null, ['reading_time' => $readingTime] );
                        endif;

                        if ( !empty($viewCount) ):
                            get_template_part( 'components/view-count', null, ['view_count' => $viewCount] );
                        endif; ?>
                    </div>
                </div>

                <?php if ( !empty($img) ): ?>
                    <div class="img-wrapper">
                        <?php get_template_part( 'components/image', null, ['img' => $img] ); ?>
                    </div>
                <?php endif; ?>

                <div class="content-wrapper">
                    <?php get_template_part( 'components/loop' ); ?>
                </div>

                <?php
                    get_template_part( 'components/share-links');
                    get_template_part( 'components/float-message', null, $floatMsgArgs );
                ?>
            </div>

            <?php if ( is_active_sidebar('sidebar-goodface-2') ): ?>
                <div class="right-side-content">
                    <aside id="sidebar" class="sidebar widget-area" role="complementary">
                        <?php dynamic_sidebar( 'sidebar-goodface-2' ); ?>
                    </aside>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php if ( is_active_sidebar('section-goodface') ):
    dynamic_sidebar( 'section-goodface' );
endif;

get_footer();