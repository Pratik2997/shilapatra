<?php

/**
 * Viral functions and definitions.
 *
 * @package Viral
 */
if (!defined('VIRAL_VERSION')) {
    $viral_get_theme = wp_get_theme();
    $viral_version = $viral_get_theme->Version;
    define('VIRAL_VERSION', $viral_version);
}

if (!function_exists('viral_setup')) :

    function viral_setup() {

        load_theme_textdomain('viral', get_template_directory() . '/languages');

        add_theme_support('automatic-feed-links');

        add_theme_support('title-tag');

        add_theme_support('post-thumbnails');
        add_image_size('viral-780x440', 780, 440, true);
        add_image_size('viral-600x600', 600, 600, true);
        add_image_size('viral-400x400', 400, 400, true);
        add_image_size('viral-150x150', 150, 150, true);

        register_nav_menus(array(
            'primary' => esc_html__('Main Menu', 'viral'),
            'top-menu' => esc_html__('Top Header Menu', 'viral'),
        ));

        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        add_theme_support('custom-background', apply_filters('viral_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        add_theme_support('custom-logo', array(
            'height' => 60,
            'width' => 300,
            'flex-height' => true,
            'flex-width' => true,
            'header-text' => array('.vl-site-title', '.vl-site-description'),
        ));
        
        // Add support for Block Styles.
        add_theme_support('wp-block-styles');

        // Add support for full and wide align images.
        add_theme_support('align-wide');

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');
        
        // Add support for responsive embedded content.
        add_theme_support('responsive-embeds');
        
        add_theme_support('custom-line-height');

        add_theme_support('custom-spacing');

        add_theme_support('custom-units');
    }

endif; // viral_setup
add_action('after_setup_theme', 'viral_setup');

function viral_content_width() {
    $GLOBALS['content_width'] = apply_filters('viral_content_width', 810);
}

add_action('after_setup_theme', 'viral_content_width', 0);

/**
 * Register widget area.
 */
function viral_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('Right Sidebar', 'viral'),
        'id' => 'viral-sidebar',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Left Sidebar', 'viral'),
        'id' => 'viral-left-sidebar',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Header Ads', 'viral'),
        'id' => 'viral-header-ads',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Home Middle Section - Right Sidebar', 'viral'),
        'id' => 'viral-frontpage-sidebar',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer 1', 'viral'),
        'id' => 'viral-footer1',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer 2', 'viral'),
        'id' => 'viral-footer2',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer 3', 'viral'),
        'id' => 'viral-footer3',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer 4', 'viral'),
        'id' => 'viral-footer4',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

add_action('widgets_init', 'viral_widgets_init');

if (!function_exists('viral_fonts_url')) :

    /**
     * Register Google fonts for Viral.
     *
     * @return string Google fonts URL for the theme.
     */
    function viral_fonts_url() {
        $fonts_url = '';
        $fonts = array();
        $subsets = 'latin,latin-ext';

        $viral_header_typography = get_theme_mod('viral_header_typography', 'Roboto Condensed');
        $viral_body_typography = get_theme_mod('viral_body_typography', 'Roboto');
        $standard_fonts = array('Arial', 'Georgia');

        if (!in_array($viral_header_typography, $standard_fonts)) {
            $fonts[] = $viral_header_typography . ':400,400i,700';
        }

        if (!in_array($viral_body_typography, $standard_fonts)) {
            $fonts[] = $viral_body_typography . ':400,400i,700';
        }

        $fonts = array_unique($fonts);

        /*
         * Translators: To add an additional character subset specific to your language,
         * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
         */
        $subset = _x('no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'viral');

        if ('cyrillic' == $subset) {
            $subsets .= ',cyrillic,cyrillic-ext';
        } elseif ('greek' == $subset) {
            $subsets .= ',greek,greek-ext';
        } elseif ('devanagari' == $subset) {
            $subsets .= ',devanagari';
        } elseif ('vietnamese' == $subset) {
            $subsets .= ',vietnamese';
        }

        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urlencode(implode('|', $fonts)),
                'subset' => urlencode($subsets),
                'display' => 'swap',
                    ), '//fonts.googleapis.com/css');
        }

        return $fonts_url;
    }

endif;

/**
 * Enqueue scripts and styles.
 */
function viral_scripts() {
    wp_enqueue_style('customTheme-bootstrap-css','https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css',array(),'5.0.2','all');
    wp_enqueue_style('viral-fonts', viral_fonts_url(), array(), NULL);
    wp_enqueue_style('materialdesignicons', get_template_directory_uri() . '/css/materialdesignicons.css', array(), VIRAL_VERSION);
    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css', array(), VIRAL_VERSION);
    wp_enqueue_style('viral-style', get_stylesheet_uri(), array(), VIRAL_VERSION);
    wp_enqueue_style('font-awesome-abdc', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css', array(), VIRAL_VERSION);
    wp_add_inline_style('viral-style', viral_dymanic_styles());

    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), VIRAL_VERSION, true);
    wp_enqueue_script('theia-sticky-sidebar', get_template_directory_uri() . '/js/theia-sticky-sidebar.js', array('jquery'), VIRAL_VERSION, true);
    wp_enqueue_script('jquery-superfish', get_template_directory_uri() . '/js/jquery.superfish.js', array('jquery'), VIRAL_VERSION, true);
    wp_enqueue_script('viral-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), VIRAL_VERSION, true);
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', array('jquery'), VIRAL_VERSION, true);
    


    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'viral_scripts');

/**
 * Enqueue admin scripts and styles.
 */
function viral_admin_scripts() {
    wp_enqueue_media();
    wp_enqueue_script('viral-admin-scripts', get_template_directory_uri() . '/inc/js/admin-scripts.js', array('jquery'), VIRAL_VERSION, true);
    wp_enqueue_style('viral-admin-style', get_template_directory_uri() . '/inc/css/admin-style.css', array(), VIRAL_VERSION);
}

add_action('admin_enqueue_scripts', 'viral_admin_scripts');

add_action('elementor/editor/before_enqueue_scripts', 'viral_admin_scripts');

if (!function_exists('wp_body_open')) {

    function wp_body_open() {
        do_action('wp_body_open');
    }

}

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
 * Metabox additions.
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Hooks additions.
 */
require get_template_directory() . '/inc/hooks.php';

/**
 * Dynamic Styles additions.
 */
require get_template_directory() . '/inc/style.php';

/**
 * Widgets additions.
 */
require get_template_directory() . '/inc/widgets/widget-fields.php';
require get_template_directory() . '/inc/widgets/widget-contact-info.php';
require get_template_directory() . '/inc/widgets/widget-personal-info.php';
require get_template_directory() . '/inc/widgets/widget-timeline.php';
require get_template_directory() . '/inc/widgets/widget-category-block.php';
require get_template_directory() . '/inc/widgets/widget-advertisement.php';

/**
 * Welcome Page.
 */
require get_template_directory() . '/welcome/welcome.php';
