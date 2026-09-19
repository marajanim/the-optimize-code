<?php
/** Theme asset registration. @package The_Optimize_Code */
if (!defined('ABSPATH')) { exit; }

function toc_asset_version(string $relative_path): string
{
    $absolute_path = get_template_directory() . '/' . ltrim($relative_path, '/');
    return is_file($absolute_path) ? (string) filemtime($absolute_path) : wp_get_theme()->get('Version');
}

function toc_enqueue_assets(): void
{
    wp_enqueue_style('toc-fonts', 'https://fonts.googleapis.com/css2?family=Anton+SC&family=Anton&family=Inter:wght@400;500;600&display=swap', [], null);
    wp_enqueue_style('toc-base', get_template_directory_uri() . '/css/style.css', ['toc-fonts'], toc_asset_version('css/style.css'));
    wp_enqueue_style('toc-optimize', get_template_directory_uri() . '/css/optimize.css', ['toc-base'], toc_asset_version('css/optimize.css'));
    wp_enqueue_style('toc-responsive', get_template_directory_uri() . '/css/responsive.css', ['toc-optimize'], toc_asset_version('css/responsive.css'));
    wp_enqueue_style('toc-wordpress', get_stylesheet_uri(), ['toc-responsive'], toc_asset_version('style.css'));
    wp_enqueue_style('toc-dynamic', get_template_directory_uri() . '/css/dynamic.css', ['toc-wordpress'], toc_asset_version('css/dynamic.css'));
    wp_enqueue_script('toc-interactions', get_template_directory_uri() . '/js/script.js', [], toc_asset_version('js/script.js'), true);
}
add_action('wp_enqueue_scripts', 'toc_enqueue_assets');

function toc_enqueue_admin_bar_offset(): void
{
    wp_enqueue_script('toc-admin-bar-offset', get_template_directory_uri() . '/js/wordpress-admin-bar.js', ['toc-interactions'], toc_asset_version('js/wordpress-admin-bar.js'), true);
}
add_action('wp_enqueue_scripts', 'toc_enqueue_admin_bar_offset', 20);
