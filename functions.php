<?php
/**
 * Tatteo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Tatteo
 */

if ( ! function_exists( 'tatteo_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function tatteo_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Tatteo, use a find and replace
		 * to change 'tatteo' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'tatteo', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'tatteo' ),
			'menu-2' => esc_html__( 'Footer', 'tatteo' ),
			'menu-3' => esc_html__( 'Social', 'tatteo' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'tatteo_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Set theme image sizes
		add_image_size( 'site-logo', 99999, 60, false ); // 60 pixels height (and unlimited width)
		add_image_size( 'content-hero', 1280, 9999999, false ); // 1280 pixels wide (and unlimited height)

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'size' => 'site-logo'
		) );
	}
endif;
add_action( 'after_setup_theme', 'tatteo_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tatteo_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'tatteo_content_width', 640 );
}
add_action( 'after_setup_theme', 'tatteo_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tatteo_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'tatteo' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'tatteo' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'tatteo_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tatteo_scripts() {

	wp_enqueue_style( 'tatteo-style', get_template_directory_uri() . '/build/css/style.css', array());

	wp_enqueue_style( 'tatteo-google-fonts', 'https://fonts.googleapis.com/css?family=Roboto:400,400i,500,700i&display=swap', false );

	wp_enqueue_style( 'inhabitents-fontawesome', 'https://use.fontawesome.com/releases/v5.8.2/css/all.css', array());

	wp_enqueue_script( 'tatteo-toggle-menu', get_template_directory_uri() . '/js/toggle-menu.js', array(), '20151215', true );

	wp_enqueue_script( 'tatteo-search-reveal', get_template_directory_uri() . '/js/search-reveal.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'tatteo-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'tatteo-popup-form', get_template_directory_uri() . '/js/popup-form.js', array('jquery'), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tatteo_scripts' );

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

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}
