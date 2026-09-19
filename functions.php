<?php
/**
 * Theme bootstrap.
 *
 * @package The_Optimize_Code
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once get_template_directory() . '/inc/theme-setup.php';

/**
 * Keep fixed navigation aligned with the visible portion of WordPress's
 * responsive admin toolbar. On narrow screens the toolbar scrolls away,
 * so a fixed CSS-only offset would leave an empty strip above the navbar.
 */
function toc_enqueue_admin_bar_offset(): void
{
    wp_enqueue_script(
        'toc-admin-bar-offset',
        get_template_directory_uri() . '/js/wordpress-admin-bar.js',
        ['toc-interactions'],
        toc_asset_version('js/wordpress-admin-bar.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'toc_enqueue_admin_bar_offset', 20);

