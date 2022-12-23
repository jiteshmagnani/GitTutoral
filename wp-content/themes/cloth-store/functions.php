<?php
/**
 * Cloth Store functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Cloth_Store
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', time() );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cloth_store_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Cloth Store, use a find and replace
		* to change 'cloth-store' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'cloth-store', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'primary_menu' => esc_html__( 'Primary Menu', 'cloth-store' ),
			'information_menu' => esc_html__( 'Information Menu', 'cloth-store' ),
			'why_choose_menu' => esc_html__( 'Why Choose Menu', 'cloth-store' ),
			'my_account_menu' => esc_html__( 'My Account Menu', 'cloth-store' ),
			'guest_menu' => esc_html__( 'Guest Menu', 'cloth-store' ),
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

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'cloth_store_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'cloth_store_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cloth_store_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cloth_store_content_width', 640 );
}
add_action( 'after_setup_theme', 'cloth_store_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cloth_store_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'cloth-store' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'cloth-store' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'cloth_store_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function cloth_store_scripts() {
	wp_enqueue_style( 'cloth-store-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'cloth-store-style', 'rtl', 'replace' );
	wp_enqueue_style( 'cloth-slick', get_template_directory_uri() . '/css/slick.css' , array(), _S_VERSION );
	wp_enqueue_script( 'cloth-jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'cloth-store-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'cloth-slick', get_template_directory_uri() . '/js/slick.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'cloth-general', get_template_directory_uri() . '/js/general.js', array(), _S_VERSION, true );
	$translation_array = array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'security'  => wp_create_nonce( 'add-to-cart-clothstore-nonce' ),
	);
	wp_localize_script( 'cloth-general', 'wc_add_to_cart_params', $translation_array );
	/* if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	} */
}
add_action( 'wp_enqueue_scripts', 'cloth_store_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
/*
Cloth Store Stores
*/
require get_template_directory() . '/inc/clothstore-options.php';
/*
Cloth Store Functions
*/
require get_template_directory() . '/inc/clothstore-functions.php';




/* require get_template_directory() . '/inc/clothstore-functions.php'; */