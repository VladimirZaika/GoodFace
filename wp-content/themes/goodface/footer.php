<?php
/**
 * The footer
 *
 * @package GoodFace
 */
$currentTerm = get_queried_object();
$id = get_the_ID();

$insertAfterFooterCode = get_field('insert_after_footer_code', 'options');

$apiKey = get_field('api_key', $id);
$compaignId = get_field('campaign_id', $id);
$customClass = get_field('footer_custom_class', $id) ? ' ' . get_field('footer_custom_class', $id) : '';
$archiveClass = '';

if ( $currentTerm && ! is_wp_error( $currentTerm ) ):
    $tax = $currentTerm->taxonomy ?? $currentTerm->name;

    if ($tax):
        $archiveClass = ' footer-' . $tax;
    endif;
endif;
?>
        <!-- Main end -->
        </main>
            <footer class="footer<?= $customClass . $archiveClass ?>">
                <div class="container footer-container">
                    <?php if ( !empty($apiKey) && !empty($compaignId) ): ?>
                        <div class="form-wrapper">
                            <?php get_template_part( 'components/subscribtion-form' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </footer>
        <!-- Wrapper End -->
        </div>

        <?php
            echo $insertAfterFooterCode;

            wp_footer();
        ?>
    </body>
</html>