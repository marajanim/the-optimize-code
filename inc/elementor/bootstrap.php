<?php
/**
 * Elementor Free compatibility layer and widget registration.
 *
 * @package The_Optimize_Code
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/helpers.php';

function toc_elementor_is_available(): bool
{
    return did_action('elementor/loaded') > 0 || class_exists('\\Elementor\\Plugin');
}

function toc_elementor_missing_notice(): void
{
    if (!current_user_can('manage_options') || toc_elementor_is_available()) {
        return;
    }
    ?>
    <div class="notice notice-warning is-dismissible">
        <p><?php esc_html_e('The Optimize Code: install and activate Elementor Free to edit the custom page sections. Legacy public pages remain available until migration.', 'the-optimize-code'); ?></p>
    </div>
    <?php
}
add_action('admin_notices', 'toc_elementor_missing_notice');

function toc_register_elementor_category($elements_manager): void
{
    $elements_manager->add_category('the-optimize-code', [
        'title' => esc_html__('The Optimize Code', 'the-optimize-code'),
        'icon'  => 'eicon-site-identity',
    ]);
}
add_action('elementor/elements/categories_registered', 'toc_register_elementor_category');

function toc_register_elementor_widgets($widgets_manager): void
{
    require_once __DIR__ . '/widgets/class-toc-section-header.php';
    require_once __DIR__ . '/widgets/class-toc-hero.php';
    require_once __DIR__ . '/widgets/class-toc-ticker.php';
    require_once __DIR__ . '/widgets/class-toc-featured-podcast.php';
    require_once __DIR__ . '/widgets/class-toc-feature-cards.php';
    require_once __DIR__ . '/widgets/class-toc-blueprint-story.php';
    require_once __DIR__ . '/widgets/class-toc-process-steps.php';
    require_once __DIR__ . '/widgets/class-toc-education-grid.php';
    require_once __DIR__ . '/widgets/class-toc-cta-newsletter.php';
    require_once __DIR__ . '/widgets/class-toc-testing-hero.php';
    require_once __DIR__ . '/widgets/class-toc-testing-pathways.php';
    require_once __DIR__ . '/widgets/class-toc-notice-disclaimer.php';
    require_once __DIR__ . '/widgets/class-toc-pgx-request.php';
    require_once __DIR__ . '/widgets/class-toc-gallery-hero.php';
    require_once __DIR__ . '/widgets/class-toc-gallery.php';

    $widgets_manager->register(new \TOC_Section_Header_Widget());
    $widgets_manager->register(new \TOC_Hero_Widget());
    $widgets_manager->register(new \TOC_Ticker_Widget());
    $widgets_manager->register(new \TOC_Featured_Podcast_Widget());
    $widgets_manager->register(new \TOC_Feature_Cards_Widget());
    $widgets_manager->register(new \TOC_Blueprint_Story_Widget());
    $widgets_manager->register(new \TOC_Process_Steps_Widget());
    $widgets_manager->register(new \TOC_Education_Grid_Widget());
    $widgets_manager->register(new \TOC_CTA_Newsletter_Widget());
    $widgets_manager->register(new \TOC_Testing_Hero_Widget());
    $widgets_manager->register(new \TOC_Testing_Pathways_Widget());
    $widgets_manager->register(new \TOC_Notice_Disclaimer_Widget());
    $widgets_manager->register(new \TOC_PGX_Request_Widget());
    $widgets_manager->register(new \TOC_Gallery_Hero_Widget());
    $widgets_manager->register(new \TOC_Gallery_Widget());
}
add_action('elementor/widgets/register', 'toc_register_elementor_widgets');

function toc_enqueue_elementor_preview_scripts(): void
{
    wp_enqueue_script(
        'toc-elementor-preview',
        get_template_directory_uri() . '/js/elementor-preview.js',
        ['jquery'],
        toc_asset_version('js/elementor-preview.js'),
        true
    );
}
add_action('elementor/preview/enqueue_scripts', 'toc_enqueue_elementor_preview_scripts');
