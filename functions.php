<?php
/**
 * square_apple functions and definitions
 *
 * @package square_apple
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 960; /* pixels */
}

if ( ! function_exists( 'square_apple_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function square_apple_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on square_apple, use a find and replace
	 * to change 'square_apple' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'square_apple', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'square_apple' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'square_apple_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // square_apple_setup
add_action( 'after_setup_theme', 'square_apple_setup' );

add_filter( 'admin_post_thumbnail_html', 'add_featured_image_instruction');
function add_featured_image_instruction( $content ) {
    return $content .= '<p>The Featured Image is an image that is chosen as the representative image for Posts or Pages. Click the link above to add or change the image for this post. </p>';
}

/************Show dimensions in media list ***************************/

add_filter('manage_upload_columns', 'size_column_register');
function size_column_register($columns) {
  $columns['dimensions'] = 'Dimensions';
  return $columns;
}
add_action('manage_media_custom_column', 'size_column_display', 10, 2);
function size_column_display($column_name, $post_id) {
  if( 'dimensions' != $column_name || !wp_attachment_is_image($post_id))
    return;
    list($url, $width, $height) = wp_get_attachment_image_src($post_id, 'full');
    echo esc_html("{$width}&amp;times;{$height}");
}

/******WOOCOMMERCE**************/

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function square_apple_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'square_apple' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'square_apple_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function square_apple_scripts() {
	wp_enqueue_style( 'square_apple-style', get_stylesheet_uri() );

        wp_enqueue_style( 'custom-style-min-css', get_template_directory_uri() . '/css/style.min.css', array(), '', 'all'  );

	wp_enqueue_script( 'square_apple-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'square_apple-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
    
    wp_register_script( 'bootstrap-js', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '3.0.1', true );

    wp_register_script( 'script-js', get_template_directory_uri() . '/js/script.js', array(), '', true );

wp_enqueue_script( 'script-js' );

// load bootstrap css
    wp_register_style( 'bootstrap-css', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css', array(), '3.0.1', 'all' );
    
// load bootstrap js
    wp_enqueue_script( 'bootstrap-js' );

    wp_enqueue_style( 'bootstrap-css' );
 
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'square_apple_scripts' );

add_action( 'wp_enqueue_scripts', 'prefix_enqueue_awesome' );

function prefix_enqueue_awesome() {
    wp_enqueue_style( 'prefix-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css', array(), '4.0.3' );
}

add_action('init', 'my_init'); 
remove_filter('the_content', 'wpautop');

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
require get_template_directory() . '/inc/bootstrap-wp-navwalker.php';

/*************SCHEMA***************************/
function html_tag_schema()
{
    $schema = 'http://schema.org/';
    
    if ( function_exists(is_woocommerce) && is_woocommerce() ) {
      $type = 'Product';
    }
    // Is single post
    elseif(is_single())
    {
        $type = "Blog";
    }
    // Contact form page ID
    else if( is_page(1) )
    {
        $type = 'ContactPage';
    }
    // Is author page
    elseif( is_author() )
    {
        $type = 'ProfilePage';
    }
    // Is search results page
    elseif( is_search() )
    {
        $type = 'SearchResultsPage';
    }
    // Is of movie post type
    elseif(is_singular('movies'))
    {
        $type = 'Movie';
    }
    // Is of book post type
    elseif(is_singular('books'))
    {
        $type = 'Book';
    }
    elseif ( function_exists(is_woocommerce) && is_woocommerce() ) {
      $type = 'Product';
    }
 // Is archive page
    elseif( is_archive() )
    {
        $type = 'Blog';
    }
    else
    {
        $type = 'WebPage';
    }

    echo 'itemscope="itemscope" itemtype="' . $schema . $type . '"';
}
