<?php
/**
 * Theme bootstrap.
 *
 * @package The_Optimize_Code
 */

if (!defined('ABSPATH')) {
    exit;
}

$toc_includes = [
    '/inc/theme-setup.php',
    '/inc/template-tags.php',
    '/inc/theme-settings.php',
    '/inc/navigation.php',
    '/inc/assets.php',
    '/inc/security.php',
    '/inc/legacy.php',
    '/inc/elementor/bootstrap.php',
    '/inc/migration.php',
];

foreach ($toc_includes as $toc_include) {
    require_once get_template_directory() . $toc_include;
}

unset($toc_include, $toc_includes);
