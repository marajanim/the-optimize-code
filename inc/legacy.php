<?php
/** Temporary legacy-page compatibility. @package The_Optimize_Code */
if (!defined('ABSPATH')) { exit; }

function toc_get_legacy_page_suggestions(): array
{
    return ['testing' => __('Testing', 'the-optimize-code'), 'gallery' => __('Gallery', 'the-optimize-code')];
}

function toc_body_classes(array $classes): array
{
    if (is_page('testing')) { $classes[] = 'testing-page'; }
    if (is_page('gallery')) { $classes[] = 'gallery-page'; }
    if (toc_is_elementor_page()) { $classes[] = 'toc-elementor-page'; }
    return array_values(array_unique($classes));
}
add_filter('body_class', 'toc_body_classes');
