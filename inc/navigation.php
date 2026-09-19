<?php
/** Native menu fallbacks and global navigation helpers. @package The_Optimize_Code */
if (!defined('ABSPATH')) { exit; }

function toc_primary_menu_fallback($args): void
{
    $menu_class = is_object($args) ? $args->menu_class : ($args['menu_class'] ?? 'nav__links');
    $links = [
        ['label' => __('Learn', 'the-optimize-code'), 'url' => toc_home_anchor('#learn')],
        ['label' => __('Testing', 'the-optimize-code'), 'url' => toc_page_url('testing')],
        ['label' => __('Podcast', 'the-optimize-code'), 'url' => toc_home_anchor('#podcast')],
        ['label' => __('Gallery', 'the-optimize-code'), 'url' => toc_page_url('gallery')],
        ['label' => __('Blueprint', 'the-optimize-code'), 'url' => toc_home_anchor('#blueprint')],
    ];
    echo '<ul class="' . esc_attr($menu_class) . '">';
    foreach ($links as $link) {
        echo '<li class="menu-item"><a href="' . esc_url($link['url']) . '">' . esc_html($link['label']) . '</a></li>';
    }
    echo '</ul>';
}

function toc_footer_fallback_links(array $links): void
{
    echo '<ul class="footer-menu">';
    foreach ($links as $link) {
        echo '<li><a href="' . esc_url($link['url']) . '">' . esc_html($link['label']) . '</a></li>';
    }
    echo '</ul>';
}

function toc_copyright_text(): string
{
    return str_replace('{year}', wp_date('Y'), (string) toc_get_theme_option('copyright_text'));
}
