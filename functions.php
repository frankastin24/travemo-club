<?php

/**
 * vdtheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package vdtheme
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

if (!defined('IMG_URL')) {
	define('IMG_URL', get_template_directory_uri() . '/img/');
}



/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function vdtheme_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on vdtheme, use a find and replace
		* to change 'vdtheme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('vdtheme', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.

	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'vdtheme'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
}
add_action('after_setup_theme', 'vdtheme_setup');


add_action('wp_enqueue_scripts', 'vdtheme_scripts');

/**
 * Enqueue scripts and styles.
 */

function vdtheme_scripts()
{
	wp_enqueue_style('vdtheme-styles', get_stylesheet_uri(), array(), time());
	wp_enqueue_style('playfair-fonts',  'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', array(), '2');

	wp_enqueue_style('worksans-fonts',  'https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&display=swap', array(), '2');

	wp_enqueue_style('vdtheme-style', get_template_directory_uri() . '/scss/index.css', array(), time());

	wp_enqueue_script('jquery');

	wp_enqueue_script('vdtheme-script', get_template_directory_uri() . '/js/script.js', array('jquery'), time(), true);

	wp_localize_script('vdtheme-script', 'Travemo', ['template_url' => get_template_directory_uri(), 'ajax_url' => admin_url('admin-ajax.php')]);
}


function register_custom_blocks()
{
	register_block_type(get_template_directory() . '/blocks/experiences-block');

	register_block_type(get_template_directory() . '/blocks/tour-block');

	register_block_type(get_template_directory() . '/blocks/destination-block');
}
add_action('init', 'register_custom_blocks');


/**
 * Add custom taxonomies
 *
 * Additional custom taxonomies can be defined here
 * https://codex.wordpress.org/Function_Reference/register_taxonomy
 */
function travemo_init()
{
	$post_types = array(
		array('post-type' => 'tour-collection', 'name' => 'Tours', 'single-name' => 'Tour', 'taxonomies' => array('tours-category'), 'template' => array(
			array('core/paragraph'),
			array('fa-gutenberg-blocks/single-tour'),

		)),

		array('post-type' => 'experiences', 'name' => 'Experiences', 'single-name' => 'Experience', 'taxonomies' => array(), 'template' => array()),

		array('post-type' => 'destinations', 'name' => 'Destinations', 'taxonomies' => array(),  'single-name' => 'Destination', 'template' => array(
			array('core/image'),
			array('core/heading'),
			array('core/paragraph'),
			array('fa-gutenberg-blocks/single-destination'),
		)),

		array('post-type' => 'testimonials', 'name' => 'Testimonials', 'taxonomies' => array(), 'single-name' => 'Testimonials', 'template' => array()),
	);







	// Add new "Tours Category" taxonomy to Posts
	register_taxonomy('tours-category', 'post', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => false,
		'show_in_rest'      => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x('Tours Categories', 'taxonomy general name'),
			'singular_name' => _x('Tours Categoy', 'taxonomy singular name'),
			'search_items' =>  __('Search Locations'),
			'all_items' => __('All Tour Categories'),
			'parent_item' => __('Parent Location'),
			'parent_item_colon' => __('Parent Location:'),
			'edit_item' => __('Edit Tour Category'),
			'update_item' => __('Update Tour Category'),
			'add_new_item' => __('Add New Tour Category'),
			'new_item_name' => __('New Tour Category Name'),
			'menu_name' => __('Tour Categories'),
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'tour-categories', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true, // This will allow URL's like "/locations/boston/cambridge/"

		),
	));

	register_taxonomy('tours-category', 'post', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => false,
		'show_in_rest'      => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x('Tours Categories', 'taxonomy general name'),
			'singular_name' => _x('Tours Categoy', 'taxonomy singular name'),
			'search_items' =>  __('Search Locations'),
			'all_items' => __('All Tour Categories'),
			'parent_item' => __('Parent Location'),
			'parent_item_colon' => __('Parent Location:'),
			'edit_item' => __('Edit Tour Category'),
			'update_item' => __('Update Tour Category'),
			'add_new_item' => __('Add New Tour Category'),
			'new_item_name' => __('New Tour Category Name'),
			'menu_name' => __('Tour Categories'),
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'tour-categories', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true, // This will allow URL's like "/locations/boston/cambridge/"

		),
	));

	foreach ($post_types as $post_type) {



		$labels = array(
			'name'                  => _x($post_type['name'], 'Post type general name', 'textdomain'),
			'singular_name'         => _x($post_type['single-name'], 'Post type singular name', 'textdomain'),
			'menu_name'             => _x($post_type['name'], 'Admin Menu text', 'textdomain'),
			'name_admin_bar'        => _x($post_type['single-name'], 'Add New on Toolbar', 'textdomain'),
			'add_new'               => __('Add New', 'textdomain'),
			'add_new_item'          => __('Add New ' . $post_type['single-name'], 'textdomain'),
			'new_item'              => __('New ' . $post_type['single-name'], 'textdomain'),
			'edit_item'             => __('Edit ' . $post_type['single-name'], 'textdomain'),
			'view_item'             => __('View . ' . $post_type['single-name'], 'textdomain'),
			'all_items'             => __('All ' . $post_type['name'], 'textdomain'),
			'search_items'          => __('Search ' . $post_type['name'], 'textdomain'),
			'parent_item_colon'     => __('Parent ' . $post_type['name'], 'textdomain'),
			'not_found'             => __('No ' . $post_type['name'] . ' found', 'textdomain'),
			'not_found_in_trash'    => __('No ' . $post_type['name'] . ' found in Trash.', 'textdomain'),
			'featured_image'        => _x($post_type['single-name'] . ' Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain'),
			'set_featured_image'    => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain'),
			'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain'),
			'use_featured_image'    => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain'),
			'archives'              => _x($post_type['single-name'] . ' archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain'),
			'insert_into_item'      => _x('Insert into ' . $post_type['single-name'], 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain'),
			'uploaded_to_this_item' => _x('Uploaded to this ' . $post_type['single-name'], 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain'),
			'filter_items_list'     => _x('Filter.' . $post_type['name'] . ' list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain'),
			'items_list_navigation' => _x($post_type['name'] . ' list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain'),
			'items_list'            => _x($post_type['name'] . ' list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain'),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array('slug' => $post_type['post-type']),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'template' => $post_type['template'],
			'show_in_rest' => true,
			'taxonomies' => $post_type['taxonomies'],
			'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields')

		);

		register_post_type($post_type['post-type'], $args);
	}
}

add_action('init', 'travemo_init', 0);

function wpse27856_set_content_type()
{
	return "text/html";
}

add_filter('wp_mail_content_type', 'wpse27856_set_content_type');



register_post_meta(
	'tour-collection',
	'locations',
	array(
		'show_in_rest'       => true,
		'single'             => true,
		'type'               => 'string',
	)
);

register_post_meta(
	'tour-collection',
	'headerImage',
	array(
		'show_in_rest'       => true,
		'single'             => true,
		'type'               => 'string',
	)
);


add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');

function load_more_posts()
{
	global $wpdb; // this is how you get access to the database

	$posts = new WP_Query(['post_type' => 'post', 'posts_per_page' => -1]);

	$posts_html = '';



	foreach ($posts->posts as $post) {
		$link = get_the_permalink($post->ID);
		$post_categories = wp_get_post_categories($post->ID, ['fields' => 'all']);
		$title = get_the_title($post->ID);
		$post_categories_html = '';
		$date = get_the_date('F j, Y', $post->ID);

		foreach ($post_categories as $post_category) {

			$post_categories_html .= '<a href="' . site_url() . '/category/' .  $post_category->slug . '" class="tag">' . $post_category->name . '</a>';
		}

		$img = get_the_post_thumbnail_url($post->ID, 'full');
		$posts_html .=  <<<END

		<article class="show">
		<a href="$link" class="blog-image"><img src="$img " alt="Travemo Club"></a>
		<div class="blog-text">

			<div class="blog-date">$date</div>

			<h3><a href="$link">$title</a></h3>

			<a href="$link" class="btn-sm"></a>

			$post_categories_html
		</div>
	</article>
	END;
	}

	echo $posts_html;

	wp_die(); // this is required to terminate immediately and return a proper response
}
