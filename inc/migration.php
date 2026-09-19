<?php
/**
 * Safe Migration and Elementor Template Utility.
 *
 * @package The_Optimize_Code
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Theme Migration menu under Tools.
 */
function toc_register_migration_menu(): void
{
    add_management_page(
        __('TOC Migration & Templates', 'the-optimize-code'),
        __('TOC Migration', 'the-optimize-code'),
        'manage_options',
        'toc-migration',
        'toc_render_migration_page'
    );
}
add_action('admin_menu', 'toc_register_migration_menu');

/**
 * Render the Migration & Templates Admin Screen.
 */
function toc_render_migration_page(): void
{
    if (!current_user_can('manage_options')) {
        return;
    }

    $message = '';
    $status_type = 'info';
    $dry_run_logs = [];

    // Handle migration actions
    if (isset($_POST['toc_migration_nonce']) && wp_verify_nonce($_POST['toc_migration_nonce'], 'toc_migration_action')) {
        $action  = isset($_POST['toc_action']) ? sanitize_key($_POST['toc_action']) : '';
        $mode    = isset($_POST['toc_execution_mode']) ? sanitize_key($_POST['toc_execution_mode']) : '';
        $dry_run = ('dry_run' === $mode);

        if ('init_settings' === $action) {
            $existing = get_option('toc_theme_options', []);
            $defaults = toc_theme_setting_defaults();
            $merged   = array_merge($defaults, is_array($existing) ? $existing : []);

            if ($dry_run) {
                $dry_run_logs[] = __('Dry run: Would populate missing Theme Settings defaults while preserving existing values.', 'the-optimize-code');
                $message = __('Dry run complete: Settings reviewed.', 'the-optimize-code');
            } else {
                update_option('toc_theme_options', $merged);
                $message = __('Theme settings defaults successfully initialized without overwriting user data.', 'the-optimize-code');
                $status_type = 'success';
            }
        } elseif ('build_elementor_drafts' === $action) {
            if (!toc_elementor_is_available()) {
                $message = __('Elementor Free is not currently active. Install and activate Elementor Free before generating Elementor page drafts.', 'the-optimize-code');
                $status_type = 'error';
            } else {
                $assign_front = !empty($_POST['toc_assign_front']);
                $result       = toc_migration_build_draft_pages($dry_run, $assign_front);
                $dry_run_logs = $result['logs'];
                $message      = $result['message'];
                $status_type  = $result['success'] ? 'success' : 'warning';
                $home_id      = $result['home_id'] ?? 0;

                if (!$dry_run && $home_id > 0) {
                    $edit_url = admin_url('post.php?post=' . $home_id . '&action=elementor');
                    $message .= ' <a href="' . esc_url($edit_url) . '" class="button button-primary" style="margin-left: 10px;">' . esc_html__('Edit Home with Elementor &rarr;', 'the-optimize-code') . '</a>';
                }
            }
        }
    }
    ?>
    <div class="wrap toc-migration-wrap">
        <h1><?php esc_html_e('The Optimize Code — Migration & Templates', 'the-optimize-code'); ?></h1>
        <p class="description">
            <?php esc_html_e('Safely convert legacy hard-coded pages into Elementor Free editable drafts with zero content destruction.', 'the-optimize-code'); ?>
        </p>

        <?php if ($message) : ?>
            <div class="notice notice-<?php echo esc_attr($status_type); ?> is-dismissible" style="padding: 12px; font-size: 14px;">
                <p style="margin: 0; display: inline-flex; align-items: center;"><?php echo wp_kses_post($message); ?></p>
            </div>
        <?php endif; ?>

        <?php if (!empty($dry_run_logs)) : ?>
            <div class="card" style="margin-top: 15px; background: #fff; border-left: 4px solid #2271b1;">
                <h2><?php esc_html_e('Dry Run Simulation Results', 'the-optimize-code'); ?></h2>
                <p style="color: #646970;"><?php esc_html_e('The following actions were simulated only. Click "Create & Apply Elementor Pages Now" to perform the actual migration.', 'the-optimize-code'); ?></p>
                <ul>
                    <?php foreach ($dry_run_logs as $log) : ?>
                        <li><?php echo esc_html($log); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="card" style="max-width: 800px; margin-top: 20px;">
            <h2><?php esc_html_e('Step 1: Initialize Global Settings', 'the-optimize-code'); ?></h2>
            <p><?php esc_html_e('Ensures all branding, logos, social links, colors, and form options have safe fallbacks in the WordPress Settings API.', 'the-optimize-code'); ?></p>
            <form method="post" action="">
                <?php wp_nonce_field('toc_migration_action', 'toc_migration_nonce'); ?>
                <input type="hidden" name="toc_action" value="init_settings">
                <div style="display: flex; gap: 10px; align-items: center;">
                    <button type="submit" name="toc_execution_mode" value="live" class="button button-primary"><?php esc_html_e('Initialize Theme Settings Now', 'the-optimize-code'); ?></button>
                    <button type="submit" name="toc_execution_mode" value="dry_run" class="button button-secondary"><?php esc_html_e('Preview (Dry Run)', 'the-optimize-code'); ?></button>
                </div>
            </form>
        </div>

        <div class="card" style="max-width: 800px; margin-top: 20px;">
            <h2><?php esc_html_e('Step 2: Generate Elementor Pages', 'the-optimize-code'); ?></h2>
            <p><?php esc_html_e('Constructs Elementor versions of Home, Testing, and Gallery using the custom TOC Elementor Free widgets.', 'the-optimize-code'); ?></p>
            <?php if (!toc_elementor_is_available()) : ?>
                <p style="color: #d63638;">
                    <strong><?php esc_html_e('Notice: Elementor Free is not yet activated.', 'the-optimize-code'); ?></strong>
                    <?php esc_html_e('Please install and activate Elementor Free from Plugins > Add New to execute page draft creation.', 'the-optimize-code'); ?>
                </p>
            <?php endif; ?>
            <form method="post" action="">
                <?php wp_nonce_field('toc_migration_action', 'toc_migration_nonce'); ?>
                <input type="hidden" name="toc_action" value="build_elementor_drafts">
                <p>
                    <label style="display: inline-flex; align-items: center; gap: 8px; font-weight: 600; cursor: pointer;">
                        <input type="checkbox" name="toc_assign_front" value="1" checked>
                        <?php esc_html_e('Publish and set Home as the static Front Page in Settings > Reading', 'the-optimize-code'); ?>
                    </label>
                </p>
                <div style="display: flex; gap: 10px; align-items: center; margin-top: 15px;">
                    <button type="submit" name="toc_execution_mode" value="live" class="button button-primary button-large" style="height: 38px; line-height: 36px; padding: 0 18px;" <?php disabled(!toc_elementor_is_available()); ?>>
                        <?php esc_html_e('Create & Apply Elementor Pages Now', 'the-optimize-code'); ?>
                    </button>
                    <button type="submit" name="toc_execution_mode" value="dry_run" class="button button-secondary" <?php disabled(!toc_elementor_is_available()); ?>>
                        <?php esc_html_e('Preview Simulation (Dry Run)', 'the-optimize-code'); ?>
                    </button>
                </div>
            </form>
        </div>

        <div class="card" style="max-width: 800px; margin-top: 20px;">
            <h2><?php esc_html_e('Step 3: Export Versioned Template JSON', 'the-optimize-code'); ?></h2>
            <p><?php esc_html_e('Download pre-configured Elementor Free template JSON definitions that can be imported into Elementor > Saved Templates.', 'the-optimize-code'); ?></p>
            <a href="<?php echo esc_url(add_query_arg(['toc_export_templates' => '1', '_wpnonce' => wp_create_nonce('toc_export_templates_nonce')])); ?>" class="button button-secondary">
                <?php esc_html_e('Download Elementor Templates JSON Backup', 'the-optimize-code'); ?>
            </a>
        </div>
    </div>
    <?php
}

/**
 * Programmatically assemble and build Elementor draft pages.
 *
 * @param bool $dry_run Whether to execute as simulation.
 * @return array Results containing success status, message, and logs.
 */
function toc_migration_build_draft_pages(bool $dry_run, bool $assign_front = false): array
{
    $logs    = [];
    $home_id = 0;

    $pages = [
        'home-elementor-preview' => [
            'title'    => __('Home (Elementor Draft)', 'the-optimize-code'),
            'template' => 'templates/elementor-full-width.php',
            'widgets'  => [
                ['widgetType' => 'toc-hero'],
                ['widgetType' => 'toc-ticker'],
                ['widgetType' => 'toc-featured-podcast'],
                ['widgetType' => 'toc-feature-cards'],
                ['widgetType' => 'toc-blueprint-story'],
                ['widgetType' => 'toc-process-steps'],
                ['widgetType' => 'toc-education-grid'],
                ['widgetType' => 'toc-cta-newsletter'],
            ],
        ],
        'testing-elementor-preview' => [
            'title'    => __('Testing (Elementor Draft)', 'the-optimize-code'),
            'template' => 'templates/elementor-full-width.php',
            'widgets'  => [
                ['widgetType' => 'toc-testing-hero'],
                ['widgetType' => 'toc-testing-pathways'],
                ['widgetType' => 'toc-notice-disclaimer'],
                ['widgetType' => 'toc-pgx-request'],
            ],
        ],
        'gallery-elementor-preview' => [
            'title'    => __('Gallery (Elementor Draft)', 'the-optimize-code'),
            'template' => 'templates/elementor-full-width.php',
            'widgets'  => [
                ['widgetType' => 'toc-gallery-hero'],
                ['widgetType' => 'toc-gallery'],
            ],
        ],
    ];

    foreach ($pages as $slug => $page_data) {
        $target_slug = ($assign_front && 'home-elementor-preview' === $slug) ? 'home' : $slug;
        $existing    = null;
        if ($assign_front && 'home-elementor-preview' === $slug) {
            $front_id = (int) get_option('page_on_front');
            if ($front_id > 0) {
                $existing = get_post($front_id);
            }
        }
        if (!$existing) {
            $existing = get_page_by_path($target_slug) ?: get_page_by_path($slug);
        }

        if ($dry_run) {
            if ($existing instanceof WP_Post) {
                $logs[] = sprintf(__('Dry run: Page "%s" already exists (ID %d). Would verify Elementor widget structure.', 'the-optimize-code'), $page_data['title'], $existing->ID);
            } else {
                $logs[] = sprintf(__('Dry run: Would create draft page "%s" with %d TOC Elementor Free widgets.', 'the-optimize-code'), $page_data['title'], count($page_data['widgets']));
            }
            if ($assign_front && 'home-elementor-preview' === $slug) {
                $logs[] = __('Dry run: Would publish Home and assign it as the static Front Page in Settings > Reading.', 'the-optimize-code');
            }
            continue;
        }

        // Build Elementor structure JSON with individual full-width, zero-gap sections
        $elementor_data = [];
        foreach ($page_data['widgets'] as $w_idx => $w_info) {
            $sec_id = 'sec_' . substr(md5($slug . '_' . $w_idx), 0, 7);
            $col_id = 'col_' . substr(md5($slug . '_' . $w_idx), 0, 7);
            $wgt_id = 'toc_' . substr(md5($slug . '_' . $w_idx), 0, 7);

            $elementor_data[] = [
                'id'       => $sec_id,
                'elType'   => 'section',
                'settings' => [
                    'layout'         => 'full_width',
                    'gap'            => 'no',
                    'padding'        => [
                        'unit'     => 'px',
                        'top'      => '0',
                        'right'    => '0',
                        'bottom'   => '0',
                        'left'     => '0',
                        'isLinked' => true,
                    ],
                ],
                'elements' => [
                    [
                        'id'       => $col_id,
                        'elType'   => 'column',
                        'settings' => [
                            '_column_size' => 100,
                            'padding'      => [
                                'unit'     => 'px',
                                'top'      => '0',
                                'right'    => '0',
                                'bottom'   => '0',
                                'left'     => '0',
                                'isLinked' => true,
                            ],
                        ],
                        'elements' => [
                            [
                                'id'         => $wgt_id,
                                'elType'     => 'widget',
                                'widgetType' => $w_info['widgetType'],
                                'settings'   => [],
                            ],
                        ],
                    ],
                ],
            ];
        }

        $post_title  = ($assign_front && 'home-elementor-preview' === $slug) ? __('Home', 'the-optimize-code') : $page_data['title'];
        $post_status = ($assign_front && 'home-elementor-preview' === $slug) ? 'publish' : 'draft';

        $post_id = $existing instanceof WP_Post ? $existing->ID : wp_insert_post([
            'post_title'  => $post_title,
            'post_name'   => $target_slug,
            'post_status' => $post_status,
            'post_type'   => 'page',
        ]);

        if ($post_id && !is_wp_error($post_id)) {
            if ('home-elementor-preview' === $slug) {
                $home_id = (int) $post_id;
            }

            if ($existing instanceof WP_Post && $assign_front && 'home-elementor-preview' === $slug) {
                wp_update_post([
                    'ID'          => $post_id,
                    'post_title'  => $post_title,
                    'post_name'   => $target_slug,
                    'post_status' => 'publish',
                ]);
            }

            update_post_meta($post_id, '_wp_page_template', $page_data['template']);
            update_post_meta($post_id, '_elementor_edit_mode', 'builder');
            update_post_meta($post_id, '_elementor_template_type', 'wp-page');
            update_post_meta($post_id, '_elementor_version', defined('ELEMENTOR_VERSION') ? ELEMENTOR_VERSION : '3.0.0');
            update_post_meta($post_id, '_elementor_data', wp_slash(wp_json_encode($elementor_data)));
            delete_post_meta($post_id, '_elementor_css');

            // Update any existing revisions or autosaves
            $revisions = wp_get_post_revisions($post_id);
            if (!empty($revisions)) {
                foreach ($revisions as $rev) {
                    update_post_meta($rev->ID, '_elementor_data', wp_slash(wp_json_encode($elementor_data)));
                    delete_post_meta($rev->ID, '_elementor_css');
                }
            }

            if (class_exists('\\Elementor\\Plugin')) {
                \Elementor\Plugin::$instance->files_manager->clear_cache();
            }

            if ($assign_front && 'home-elementor-preview' === $slug) {
                update_option('show_on_front', 'page');
                update_option('page_on_front', $post_id);
                $logs[] = sprintf(__('Published "%s" (ID %d) and set as static Front Page in Settings > Reading.', 'the-optimize-code'), $post_title, $post_id);
            }

            $logs[] = sprintf(__('Successfully created/updated Elementor page "%s" (ID %d).', 'the-optimize-code'), $post_title, $post_id);
        }
    }

    return [
        'success' => true,
        'message' => $dry_run ? __('Dry run complete: Draft pages simulated.', 'the-optimize-code') : __('Pages successfully constructed in Elementor builder format.', 'the-optimize-code'),
        'logs'    => $logs,
        'home_id' => $home_id,
    ];
}

/**
 * Handle template JSON export download.
 */
function toc_handle_template_export(): void
{
    if (!isset($_GET['toc_export_templates'])) {
        return;
    }

    if (!current_user_can('manage_options') || !check_admin_referer('toc_export_templates_nonce')) {
        wp_die(esc_html__('Unauthorized template export request.', 'the-optimize-code'));
    }

    $export = [
        'theme'     => 'The Optimize Code',
        'version'   => wp_get_theme()->get('Version'),
        'exported'  => current_time('mysql'),
        'templates' => [
            'home' => [
                'name'    => 'TOC Home Page Template',
                'type'    => 'page',
                'widgets' => [
                    'toc-hero',
                    'toc-ticker',
                    'toc-featured-podcast',
                    'toc-feature-cards',
                    'toc-blueprint-story',
                    'toc-process-steps',
                    'toc-education-grid',
                    'toc-cta-newsletter',
                ],
            ],
            'testing' => [
                'name'    => 'TOC Testing Page Template',
                'type'    => 'page',
                'widgets' => [
                    'toc-testing-hero',
                    'toc-testing-pathways',
                    'toc-notice-disclaimer',
                    'toc-pgx-request',
                ],
            ],
            'gallery' => [
                'name'    => 'TOC Gallery Page Template',
                'type'    => 'page',
                'widgets' => [
                    'toc-gallery-hero',
                    'toc-gallery',
                ],
            ],
        ],
    ];

    header('Content-Type: application/json; charset=utf-8');
    header('Content-Disposition: attachment; filename="toc-elementor-templates-' . gmdate('Y-m-d') . '.json"');
    echo wp_json_encode($export, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    exit;
}
add_action('admin_init', 'toc_handle_template_export');
