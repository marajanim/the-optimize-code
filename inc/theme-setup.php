<?php
/**
 * Theme setup for The Optimize Code.
 *
 * @package The_Optimize_Code
 */

if (!defined('ABSPATH')) {
    exit;
}

function toc_theme_setup(): void
{
    load_theme_textdomain('the-optimize-code', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('custom-logo', [
        'height'      => 120,
        'width'       => 480,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    register_nav_menus([
        'primary' => __('Primary navigation', 'the-optimize-code'),
        'footer'  => __('Footer navigation', 'the-optimize-code'),
    ]);
}
add_action('after_setup_theme', 'toc_theme_setup');

/**
 * Return a cache-safe version based on an asset's modification time.
 */
function toc_asset_version(string $relative_path): string
{
    $absolute_path = get_template_directory() . '/' . ltrim($relative_path, '/');

    return is_file($absolute_path) ? (string) filemtime($absolute_path) : wp_get_theme()->get('Version');
}

function toc_enqueue_assets(): void
{
    wp_enqueue_style(
        'toc-fonts',
        'https://fonts.googleapis.com/css2?family=Anton+SC&family=Anton&family=Inter:wght@400;500;600&display=swap',
        [],
        null
    );
    wp_enqueue_style(
        'toc-base',
        get_template_directory_uri() . '/css/style.css',
        ['toc-fonts'],
        toc_asset_version('css/style.css')
    );
    wp_enqueue_style(
        'toc-optimize',
        get_template_directory_uri() . '/css/optimize.css',
        ['toc-base'],
        toc_asset_version('css/optimize.css')
    );
    wp_enqueue_style(
        'toc-responsive',
        get_template_directory_uri() . '/css/responsive.css',
        ['toc-optimize'],
        toc_asset_version('css/responsive.css')
    );
    wp_enqueue_style(
        'toc-wordpress',
        get_stylesheet_uri(),
        ['toc-responsive'],
        toc_asset_version('style.css')
    );

    wp_enqueue_script(
        'toc-interactions',
        get_template_directory_uri() . '/js/script.js',
        [],
        toc_asset_version('js/script.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'toc_enqueue_assets');

/**
 * Keep the security headers that were present in the original PHP site.
 */
function toc_send_security_headers(): void
{
    if (!headers_sent()) {
        header('X-Content-Type-Options: nosniff');
        header('Referrer-Policy: strict-origin-when-cross-origin');
        header('X-Frame-Options: SAMEORIGIN');
    }
}
add_action('send_headers', 'toc_send_security_headers');

/**
 * Create the two designed interior pages when the theme is first activated.
 */
function toc_create_theme_pages(): void
{
    $pages = [
        'testing' => __('Testing', 'the-optimize-code'),
        'gallery' => __('Gallery', 'the-optimize-code'),
    ];

    foreach ($pages as $slug => $title) {
        if (get_page_by_path($slug) instanceof WP_Post) {
            continue;
        }

        wp_insert_post([
            'post_type'    => 'page',
            'post_status'  => 'publish',
            'post_title'   => $title,
            'post_name'    => $slug,
            'post_content' => '',
        ]);
    }

    flush_rewrite_rules();
}
add_action('after_switch_theme', 'toc_create_theme_pages');

/**
 * Preserve the original page-specific body classes.
 *
 * @param string[] $classes Existing body classes.
 * @return string[]
 */
function toc_body_classes(array $classes): array
{
    if (is_page('testing')) {
        $classes[] = 'testing-page';
    }

    if (is_page('gallery')) {
        $classes[] = 'gallery-page';
    }

    return array_values(array_unique($classes));
}
add_filter('body_class', 'toc_body_classes');

function toc_home_anchor(string $anchor = ''): string
{
    return esc_url(home_url('/' . ltrim($anchor, '/')));
}

function toc_page_url(string $slug, string $anchor = ''): string
{
    $page = get_page_by_path($slug);
    $url  = $page instanceof WP_Post ? get_permalink($page) : home_url('/' . trim($slug, '/') . '/');

    return esc_url($url . $anchor);
}

