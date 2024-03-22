<?php
/**
 * School Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package School_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function fwd_school_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on School Theme, use a find and replace
		* to change 'fwd-school-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'fwd-school-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	
	// add title placeholder changed to student name
	function custom_change_default_title( $title ){
		$screen = get_current_screen();
		if  ( 'fwd-students' == $screen->post_type ) {
			$title = 'Add student name';
		}
		if  ( 'fwd-staff' == $screen->post_type ) {
			$title = 'Add staff name';
		}
		return $title;
	}
	add_filter( 'enter_title_here', 'custom_change_default_title' );
	
	add_theme_support( 'align-wide' );
	add_theme_support( 'align-full' );

	//customizer section and setting for footer img
function school_theme_customize_footer( $wp_customize ) {
    $wp_customize->add_section( 'footer_img_section' , array(
        'title'      => __( 'Footer Image', 'school-theme' ),
        'priority'   => 100,
    ) );
    $wp_customize->add_setting( 'footer_img' , array(
        'default'   => '',
        'transport' => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_img', array(
        'label'      => __( 'Upload a footer image', 'school-theme' ),
        'section'    => 'footer_img_section',
        'settings'   => 'footer_img',
    ) ) );
}
add_action( 'customize_register', 'school_theme_customize_footer' );

	/*
	* Enable support for Post Thumbnails on posts and pages.
	*
	* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	*/
	add_theme_support( 'post-thumbnails' );
	// Student Portrait Size - 200px width, 300px height, hard crop
	add_image_size( 'student-portrait', 300, 200, true );
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'fwd-school-theme' ),
			'footer' => esc_html__( 'Footer', 'fwd-school-theme' ),
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
			'fwd_school_theme_custom_background_args',
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
add_action( 'after_setup_theme', 'fwd_school_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fwd_school_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'fwd_school_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'fwd_school_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fwd_school_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'fwd-school-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'fwd-school-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'fwd_school_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function fwd_school_theme_scripts() {
	wp_enqueue_style( 'fwd-school-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'fwd-school-theme-style', 'rtl', 'replace' );


	wp_enqueue_script( 'fwd-school-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_style(
		'fwd-google-fonts',
		'https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,100..900;1,100..900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap rel="stylesheet"',
		array(),
		null,
		'all',
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if( get_post_type() === 'post' ) {
		wp_enqueue_style ( 
			'aos-styles',
			get_template_directory_uri() . '/styles/aos.css',
			array(), 
			'1.0'
		);

		wp_enqueue_script(
			'aos-scripts',
			get_template_directory_uri() . '/js/aos.js',
			array(),
			'1.0',
			array( 'strategy' => 'defer' )
		);
	}
}
add_action( 'wp_enqueue_scripts', 'fwd_school_theme_scripts' );

/**
 * register custom post types and custom taxonomies.
 */
require get_template_directory() . '/inc/cpt-taxonomy.php';

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

function fwd_excerpt_length( $length ) {
	return 20;
}

add_filter( 'excerpt_length', 'fwd_excerpt_length', 999 );

function fwd_excerpt_more( $more ) {
	$more = '... <a href="'. esc_url( get_permalink() ) .'">Keep Reading</a>';
	return $more;
}
add_filter( 'excerpt_more', 'fwd_excerpt_more' );