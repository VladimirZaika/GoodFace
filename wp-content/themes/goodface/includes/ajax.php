<?php
function load_more_posts() {
    $paged     = intval( $_POST['paged'] ?? 1 );
    $termId    = intval( $_POST['id'] ?? 0 );
    $taxonomy  = sanitize_text_field( $_POST['taxonomy'] ?? '' );
    $postType  = sanitize_text_field( $_POST['post_type'] ?? 'post' );
    $archive   = sanitize_text_field( $_POST['archive'] ?? '' );

    if ( $archive ) {
        $archive = strtolower($archive);
    }

    if ( !$termId && !$taxonomy && !$postType ) {
        wp_send_json_error('Not enough data');
    }

    if ( $termId || $taxonomy ) {
        $args['tax_query'][]['field'] = 'term_id';
        
        if ( $termId ) {
            $args['tax_query'][]['terms'] = $termId;
        }

        if ( $taxonomy ) {
            $args['tax_query'][]['taxonomy'] = $taxonomy;
        }
    }

    if ( $postType === 'post' ) {
        $offset = 10 + ( ($paged - 2) * 9 );
        $postsPerPage = 9;
    } else {
        $offset = 8 + ( ($paged - 2) * 9 );
        $postsPerPage = 9;
    }

    $args = [
        'post_type'      => $postType,
        'post_status'    => 'publish',
        'posts_per_page' => $postsPerPage,
        'offset'         => $offset,
        'paged'          => 1,
    ];

    $query = new WP_Query($args);

    ob_start();

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $postObj = get_post();

            get_template_part('components/post-card', null, ['post' => $postObj]);

        }
    }

    $html = ob_get_clean();

    $countArgs = [
        'post_type'      => $postType,
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'tax_query'      => [ [
            'taxonomy' => $taxonomy,
            'field'    => 'term_id',
            'terms'    => $termId,
        ] ],
        'fields' => 'ids',
    ];

    $allPosts = new WP_Query( $countArgs );
    $total = count( $allPosts->posts );

    $loaded = $offset + $query->post_count;
    $hasMore = $loaded < $total;

    wp_send_json_success( [
        'html' => $html,
        'has_more' => $hasMore,
    ] );
}

add_action( 'wp_ajax_load_more_posts', 'load_more_posts' );
add_action( 'wp_ajax_nopriv_load_more_posts', 'load_more_posts' );
