<?php
/** Reusable template helpers. @package The_Optimize_Code */
if (!defined('ABSPATH')) { exit; }

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

function toc_is_elementor_page(?int $post_id = null): bool
{
    if (!class_exists('\\Elementor\\Plugin')) { return false; }
    $post_id = $post_id ?: (int) get_queried_object_id();
    if ($post_id < 1) { return false; }
    $elementor = \Elementor\Plugin::$instance;
    return isset($elementor->db) && $elementor->db->is_built_with_elementor($post_id);
}

function toc_render_full_width_content(): void
{
    while (have_posts()) { the_post(); the_content(); }
}
