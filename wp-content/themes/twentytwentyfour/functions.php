<?php
/**
 * Twenty Twenty-Four functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Twenty Twenty-Four
 * @since Twenty Twenty-Four 1.0
 */

/**
 * Register block styles.
 */

if ( ! function_exists( 'twentytwentyfour_block_styles' ) ) :
	/**
	 * Register custom block styles
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_block_styles() {

		register_block_style(
			'core/details',
			array(
				'name'         => 'arrow-icon-details',
				'label'        => __( 'Arrow icon', 'twentytwentyfour' ),
				/*
				 * Styles for the custom Arrow icon style of the Details block
				 */
				'inline_style' => '
				.is-style-arrow-icon-details {
					padding-top: var(--wp--preset--spacing--10);
					padding-bottom: var(--wp--preset--spacing--10);
				}

				.is-style-arrow-icon-details summary {
					list-style-type: "\2193\00a0\00a0\00a0";
				}

				.is-style-arrow-icon-details[open]>summary {
					list-style-type: "\2192\00a0\00a0\00a0";
				}',
			)
		);
		register_block_style(
			'core/post-terms',
			array(
				'name'         => 'pill',
				'label'        => __( 'Pill', 'twentytwentyfour' ),
				/*
				 * Styles variation for post terms
				 * https://github.com/WordPress/gutenberg/issues/24956
				 */
				'inline_style' => '
				.is-style-pill a,
				.is-style-pill span:not([class], [data-rich-text-placeholder]) {
					display: inline-block;
					background-color: var(--wp--preset--color--base-2);
					padding: 0.375rem 0.875rem;
					border-radius: var(--wp--preset--spacing--20);
				}

				.is-style-pill a:hover {
					background-color: var(--wp--preset--color--contrast-3);
				}',
			)
		);
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'twentytwentyfour' ),
				/*
				 * Styles for the custom checkmark list block style
				 * https://github.com/WordPress/gutenberg/issues/51480
				 */
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
		register_block_style(
			'core/navigation-link',
			array(
				'name'         => 'arrow-link',
				'label'        => __( 'With arrow', 'twentytwentyfour' ),
				/*
				 * Styles for the custom arrow nav link block style
				 */
				'inline_style' => '
				.is-style-arrow-link .wp-block-navigation-item__label:after {
					content: "\2197";
					padding-inline-start: 0.25rem;
					vertical-align: middle;
					text-decoration: none;
					display: inline-block;
				}',
			)
		);
		register_block_style(
			'core/heading',
			array(
				'name'         => 'asterisk',
				'label'        => __( 'With asterisk', 'twentytwentyfour' ),
				'inline_style' => "
				.is-style-asterisk:before {
					content: '';
					width: 1.5rem;
					height: 3rem;
					background: var(--wp--preset--color--contrast-2, currentColor);
					clip-path: path('M11.93.684v8.039l5.633-5.633 1.216 1.23-5.66 5.66h8.04v1.737H13.2l5.701 5.701-1.23 1.23-5.742-5.742V21h-1.737v-8.094l-5.77 5.77-1.23-1.217 5.743-5.742H.842V9.98h8.162l-5.701-5.7 1.23-1.231 5.66 5.66V.684h1.737Z');
					display: block;
				}

				/* Hide the asterisk if the heading has no content, to avoid using empty headings to display the asterisk only, which is an A11Y issue */
				.is-style-asterisk:empty:before {
					content: none;
				}

				.is-style-asterisk:-moz-only-whitespace:before {
					content: none;
				}

				.is-style-asterisk.has-text-align-center:before {
					margin: 0 auto;
				}

				.is-style-asterisk.has-text-align-right:before {
					margin-left: auto;
				}

				.rtl .is-style-asterisk.has-text-align-left:before {
					margin-right: auto;
				}",
			)
		);
	}
endif;

add_action( 'init', 'twentytwentyfour_block_styles' );

/**
 * Enqueue block stylesheets.
 */

if ( ! function_exists( 'twentytwentyfour_block_stylesheets' ) ) :
	/**
	 * Enqueue custom block stylesheets
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_block_stylesheets() {
		/**
		 * The wp_enqueue_block_style() function allows us to enqueue a stylesheet
		 * for a specific block. These will only get loaded when the block is rendered
		 * (both in the editor and on the front end), improving performance
		 * and reducing the amount of data requested by visitors.
		 *
		 * See https://make.wordpress.org/core/2021/12/15/using-multiple-stylesheets-per-block/ for more info.
		 */
		wp_enqueue_block_style(
			'core/button',
			array(
				'handle' => 'twentytwentyfour-button-style-outline',
				'src'    => get_parent_theme_file_uri( 'assets/css/button-outline.css' ),
				'ver'    => wp_get_theme( get_template() )->get( 'Version' ),
				'path'   => get_parent_theme_file_path( 'assets/css/button-outline.css' ),
			)
		);
	}
endif;

add_action( 'init', 'twentytwentyfour_block_stylesheets' );

/**
 * Register pattern categories.
 */

if ( ! function_exists( 'twentytwentyfour_pattern_categories' ) ) :
	/**
	 * Register pattern categories
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_pattern_categories() {

		register_block_pattern_category(
			'twentytwentyfour_page',
			array(
				'label'       => _x( 'Pages', 'Block pattern category', 'twentytwentyfour' ),
				'description' => __( 'A collection of full page layouts.', 'twentytwentyfour' ),
			)
		);
	}
endif;

add_action( 'init', 'twentytwentyfour_pattern_categories' );




// Register Custom Taxonomy
function custom_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Playlist Categories', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Playlist Category', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Playlist Category', 'text_domain' ),
        'all_items'                  => __( 'All Categories', 'text_domain' ),
        'parent_item'                => __( 'Parent Category', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Category:', 'text_domain' ),
        'new_item_name'              => __( 'New Category Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Category', 'text_domain' ),
        'edit_item'                  => __( 'Edit Category', 'text_domain' ),
        'update_item'                => __( 'Update Category', 'text_domain' ),
        'view_item'                  => __( 'View Category', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate categories with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove categories', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Categories', 'text_domain' ),
        'search_items'               => __( 'Search Categories', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No categories', 'text_domain' ),
        'items_list'                 => __( 'Categories list', 'text_domain' ),
        'items_list_navigation'      => __( 'Categories list navigation', 'text_domain' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true, // Change to false if it's not hierarchical
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'rewrite'                    => array( 'slug' => 'playlist-category' ), // Replace with your desired slug
    );
    register_taxonomy( 'playlist_category', array( 'bb_playlist_player' ), $args ); // Replace 'your_custom_post_type' with your actual custom post type name
}
add_action( 'init', 'custom_taxonomy', 0 );





add_action('init', 'import');

function import()
{

    if (isset($_GET['run-script'])) {

        importFromWoocommerceProduct();

    }

}


function custom_rewrite_rules() {
    add_rewrite_rule(
        '^amotAudio/import-playlists/?$',
        'index.php?custom_action=import_playlists',
        'top'
    );
}
add_action('init', 'custom_rewrite_rules');

function handle_custom_action() {
    if (get_query_var('custom_action') == 'import_playlists') {
        importFromWoocommerceProduct();
        echo 'Playlist import completed!';
        exit;
    }
}
add_action('template_redirect', 'handle_custom_action');

// http://localhost/amotAudio/import-playlists




function importFromWoocommerceProduct()
{
    generate_playlist_entries('AA Speaker Singles');
    generate_playlist_entries('Al-Anon Speaker Singles');
}
function generate_playlist_entries($category_name)
{
    $products_query = new WP_Query(
        array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'name',
                    'terms' => $category_name,
                )
            )
        )
    );

    if ($products_query->have_posts()) {
        while ($products_query->have_posts()) {
            $products_query->the_post();

            $product_id = get_the_ID();
            $product = wc_get_product($product_id);

            // Fetch variations
            $variations = $product->get_available_variations();

            $product_name = get_the_title();
            $product_content = get_the_content();

            // Check if entry already exists
            $existing_entry = get_page_by_title($product_name, OBJECT, 'bb_playlist_player');

            $song_data = array();

            foreach ($variations as $variation) {
                $variation_id = $variation['variation_id'];
                $variation_obj = new WC_Product_Variation($variation_id);

                if ($variation_obj->is_downloadable()) {
                    $downloadable_files = $variation_obj->get_downloads();

                    foreach ($downloadable_files as $file) {
                        $file_name = $file['name'];
                        $file_url = $file['file'];

                        $song_data[] = array(
                            'name' => $file_name,
                            'author' => '',
                            'url' => $file_url,
                        );
                    }
                }
            }

            $post_data = array(
                'post_type' => 'bb_playlist_player',
                'post_title' => $product_name,
                'post_content' => $product_content,
                'post_status' => 'publish',
            );

            if ($existing_entry) {
                $post_data['ID'] = $existing_entry->ID;
                wp_update_post($post_data);
            } else {
                $post_id = wp_insert_post($post_data);
                if ($post_id) {
                    wp_set_object_terms($post_id, $category_name, 'playlist_category', false);
                }
            }

            // Update playlist data if there are songs
            if (!empty($song_data)) {
                update_post_meta($existing_entry ? $existing_entry->ID : $post_id, 'bb_playlist', $song_data);
            }
        }

        wp_reset_postdata();
    }
}


function create_custom_post_type() {
    $labels = array(
        'name'                  => _x( 'Books', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Book', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Books', 'text_domain' ),
        'name_admin_bar'        => __( 'Book', 'text_domain' ),
        'archives'              => __( 'Book Archives', 'text_domain' ),
        'attributes'            => __( 'Book Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Book:', 'text_domain' ),
        'all_items'             => __( 'All Books', 'text_domain' ),
        'add_new_item'          => __( 'Add New Book', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Book', 'text_domain' ),
        'edit_item'             => __( 'Edit Book', 'text_domain' ),
        'update_item'           => __( 'Update Book', 'text_domain' ),
        'view_item'             => __( 'View Book', 'text_domain' ),
        'view_items'            => __( 'View Books', 'text_domain' ),
        'search_items'          => __( 'Search Book', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into book', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this book', 'text_domain' ),
        'items_list'            => __( 'Books list', 'text_domain' ),
        'items_list_navigation' => __( 'Books list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter books list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Book', 'text_domain' ),
        'description'           => __( 'Post Type Description', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'taxonomies'            => array( 'genre', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,		
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'book', $args );

}
add_action( 'init', 'create_custom_post_type', 0 );


function delete_book_attachments() {
    // Arguments for fetching posts of custom post type 'books'
    $args = array(
        'post_type'      => 'book',
        'posts_per_page' => -1,
        'post_status'    => 'any',
    );

    $book_posts = new WP_Query($args);

    if ($book_posts->have_posts()) {
        while ($book_posts->have_posts()) {
            $book_posts->the_post();
            $post_id = get_the_ID();

            $attachments = get_attached_media('', $post_id);

            foreach ($attachments as $attachment) {
                wp_delete_attachment($attachment->ID, true);
            }
        }
    }

    wp_reset_postdata();
}

// add_action('init', 'delete_book_attachments');

function get_url() {
	if(isset($_GET['url'])) {
		delete_book_attachments();
	}
}
get_url();



function enqueue_filter_scripts() {
    if (is_shop() || is_product_category()) {
        wp_enqueue_script('jquery-ui-slider');
        wp_enqueue_script('category-price-filter', get_template_directory_uri() . '/category-price-filter.js', array('jquery', 'jquery-ui-slider'), null, true);
        wp_localize_script('category-price-filter', 'ajaxurl', admin_url('admin-ajax.php'));
    }
}
add_action('wp_enqueue_scripts', 'enqueue_filter_scripts');

function enqueue_filter_styles() {
    if (is_shop() || is_product_category()) {
        wp_enqueue_style('jquery-ui-slider', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_filter_styles');


add_action('wp_ajax_filter_products', 'filter_products');
add_action('wp_ajax_nopriv_filter_products', 'filter_products');

function filter_products() {
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
    $min_price = isset($_POST['min_price']) ? floatval($_POST['min_price']) : 0;
    $max_price = isset($_POST['max_price']) ? floatval($_POST['max_price']) : 50000;

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => '_price',
                'value' => array($min_price, $max_price),
                'compare' => 'BETWEEN',
                'type' => 'NUMERIC'
            )
        )
    );

    if ($category) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        );
    }

    $query = new WP_Query($args);

    $products_html = '';
    if ($query->have_posts()) {
        while ($query->have_posts()) : $query->the_post();
            ob_start();
            wc_get_template_part('content', 'product');
            $products_html .= ob_get_clean();
        endwhile;
    } else {
        $products_html = '<p>No products found</p>';
    }

    wp_reset_postdata();

    $count = $query->found_posts;
    $count_html = $count > 0 ? sprintf(_n('Showing the single result', 'Showing all %d results', $count, 'woocommerce'), $count) : '';

    echo json_encode(array(
        'products' => $products_html,
        'count'    => $count_html
    ));

    wp_die();
}


add_action('woocommerce_before_shop_loop', 'add_filters', 25);
function add_filters() {
    if (is_shop() || is_product_category()) {
        $categories = get_terms('product_cat');
        echo '<div id="filters">';
        echo '<select id="category-filter">';
        echo '<option value="">Select a category</option>';
        foreach ($categories as $category) {
            echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
        }
        echo '</select>';

        echo '<div id="price-slider"></div>';
        echo '<p>Price: <span id="price-range"></span></p>';
        echo '<input type="hidden" id="min-price" value="0">';
        echo '<input type="hidden" id="max-price" value="1000">';
        echo '</div>';
    }
}


