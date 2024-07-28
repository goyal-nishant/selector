<?php


/* Custom Post Type Start */

    function create_posttype() {

        register_post_type( 'location',
        array(
        'labels' => array(
        'name' => __( 'locations' ),
        'singular_name' => __( 'locations' )
        ),  
        'public' => true,
        'has_archive' => false,
        'rewrite' => array('slug' => 'locations'),
        ));
    }
    add_action( 'init', 'create_posttype' );
    
    
    function create_location_taxonomy() {
        $labels = array(
            'name'              => _x('Location Categories', 'taxonomy general name'),
            'singular_name'     => _x('Location Category', 'taxonomy singular name'),
            'search_items'      => __('Search Location Categories'),
            'all_items'         => __('All Location Categories'),
            'parent_item'       => __('Parent Location Category'),
            'parent_item_colon' => __('Parent Location Category:'),
            'edit_item'         => __('Edit Location Category'),
            'update_item'       => __('Update Location Category'),
            'add_new_item'      => __('Add New Location Category'),
            'new_item_name'     => __('New Location Category Name'),
            'menu_name'         => __('Location Categories'),
        );
    
        $args = array(
            'hierarchical'      => true, 
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'location-category'),
        );
    
        register_taxonomy('location_category', array('location'), $args);
    }
    add_action('init', 'create_location_taxonomy');

$terms = get_the_terms(get_the_ID(), 'location_category');
if ($terms && !is_wp_error($terms)) {
    echo '<ul>';
    foreach ($terms as $term) {
        echo '<li>' . esc_html($term->name) . '</li>';
    }
    echo '</ul>';
}


add_action('wp_ajax_filter_locations', 'filter_locations');
add_action('wp_ajax_nopriv_filter_locations', 'filter_locations');

function filter_locations() {
    $term_id = isset($_GET['term_id']) ? intval($_GET['term_id']) : 0;

    $args = array(
        'post_type' => 'location',
        'posts_per_page' => -1,
        'fields' => 'ids', 
    );

    if ($term_id && $term_id !== 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'location_category',
                'field'    => 'term_id',
                'terms'    => $term_id,
            ),
        );
    }

    $posts = get_posts($args);
    $output = '';

    if ($posts) {
        update_meta_cache('post', $posts);
        foreach ($posts as $post_id) {
            $latitude = get_post_meta($post_id, 'latitude', true);
            $longitude = get_post_meta($post_id, 'longitude', true);
            $icon = get_post_meta($post_id, 'icon_url', true);

            if ($latitude && $longitude) {
                $output .= '<button data-lat="' . esc_attr($latitude) . '" data-lng="' . esc_attr($longitude) . '" data-icon="' . esc_url($icon) . '">' . get_the_title($post_id) . '</button>';
            } else {
                $output .= '<button>' . get_the_title($post_id) . ' (Coordinates not found)</button>';
            }
        }
    } else {
        $output = '<p>No locations found.</p>';
    }

    echo $output;
    wp_die();
}


function enqueue_custom_styles() {
    wp_enqueue_style('custom-map-style', get_stylesheet_directory_uri() . '/map.css');
}

add_action('wp_enqueue_scripts', 'enqueue_custom_styles');


function get_location_buttons() {
    $args = array(
        'post_type' => 'location', 
        'posts_per_page' => -1,
        'fields' => 'ids', 
    );
    
    $posts = get_posts($args);
    $output = '';

    if ($posts) {
        update_meta_cache('post', $posts);
        foreach ($posts as $post_id) {
            $latitude = get_post_meta($post_id, 'latitude', true);
            $longitude = get_post_meta($post_id, 'longitude', true);
            $icon = get_post_meta($post_id, 'icon_url', true);

            if ($latitude && $longitude) {
                $output .= '<button data-lat="' . esc_attr($latitude) . '" data-lng="' . esc_attr($longitude) . '" data-icon="' . esc_url($icon) . '">' . get_the_title($post_id) . '</button>';
            } else {
                $output .= '<button>' . get_the_title($post_id) . ' (Coordinates not found)</button>';
            }
        }
    } else {
        $output = '<p>No locations found.</p>';
    }

    return $output;
}
