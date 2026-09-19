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
        'primary'         => __('Primary navigation', 'the-optimize-code'),
        'footer'          => __('Legacy footer navigation', 'the-optimize-code'),
        'footer_explore'  => __('Footer: Explore', 'the-optimize-code'),
        'footer_services' => __('Footer: Services', 'the-optimize-code'),
        'footer_legal'    => __('Footer: Legal', 'the-optimize-code'),
    ]);
}
add_action('after_setup_theme', 'toc_theme_setup');
