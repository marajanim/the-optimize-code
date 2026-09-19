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
        } elseif ('sync_prebuilt_templates' === $action) {
            if (!toc_elementor_is_available()) {
                $message = __('Elementor Free is not currently active. Install and activate Elementor Free before syncing templates.', 'the-optimize-code');
                $status_type = 'error';
            } else {
                $force = !empty($_POST['toc_force_sync']);
                $sync_logs = toc_sync_prebuilt_templates($force);
                $dry_run_logs = $sync_logs;
                $message = sprintf(__('Prebuilt templates successfully synced (%d templates processed). They are now available in Elementor > My Templates.', 'the-optimize-code'), count($sync_logs));
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

    $template_status = toc_get_prebuilt_templates_status();
    ?>
    <div class="wrap toc-migration-wrap">
        <h1><?php esc_html_e('The Optimize Code — Migration & Templates', 'the-optimize-code'); ?></h1>
        <p class="description">
            <?php esc_html_e('Safely convert legacy hard-coded pages into Elementor Free editable drafts and import prebuilt sections into any new page.', 'the-optimize-code'); ?>
        </p>

        <?php if ($message) : ?>
            <div class="notice notice-<?php echo esc_attr($status_type); ?> is-dismissible" style="padding: 12px; font-size: 14px;">
                <p style="margin: 0; display: inline-flex; align-items: center;"><?php echo wp_kses_post($message); ?></p>
            </div>
        <?php endif; ?>

        <?php if (!empty($dry_run_logs)) : ?>
            <div class="card" style="margin-top: 15px; background: #fff; border-left: 4px solid #2271b1;">
                <h2><?php esc_html_e('Operation Results / Log', 'the-optimize-code'); ?></h2>
                <ul>
                    <?php foreach ($dry_run_logs as $log) : ?>
                        <li><?php echo esc_html($log); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="card" style="max-width: 860px; margin-top: 20px;">
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

        <div class="card" style="max-width: 860px; margin-top: 20px;">
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

        <div class="card" style="max-width: 860px; margin-top: 20px;">
            <h2><?php esc_html_e('Step 3: Prebuilt Elementor Section Library (1-Click Import)', 'the-optimize-code'); ?></h2>
            <p>
                <?php esc_html_e('Registers all 16 individual theme sections and 3 full-page layouts directly into Elementor\'s "My Templates" library. When creating any new page in Elementor, click the folder icon ("Add Template") &rarr; "My Templates" to insert any section with 1 click!', 'the-optimize-code'); ?>
            </p>
            <form method="post" action="" style="margin-bottom: 20px;">
                <?php wp_nonce_field('toc_migration_action', 'toc_migration_nonce'); ?>
                <input type="hidden" name="toc_action" value="sync_prebuilt_templates">
                <div style="display: flex; gap: 15px; align-items: center;">
                    <button type="submit" class="button button-primary button-large" style="height: 38px; line-height: 36px; padding: 0 18px;" <?php disabled(!toc_elementor_is_available()); ?>>
                        <?php esc_html_e('Sync Prebuilt Templates to Elementor Library', 'the-optimize-code'); ?>
                    </button>
                    <label style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; cursor: pointer;">
                        <input type="checkbox" name="toc_force_sync" value="1">
                        <?php esc_html_e('Force re-sync and overwrite existing saved templates', 'the-optimize-code'); ?>
                    </label>
                </div>
            </form>

            <table class="widefat striped" style="margin-top: 15px;">
                <thead>
                    <tr>
                        <th><?php esc_html_e('Prebuilt Section / Page Template', 'the-optimize-code'); ?></th>
                        <th><?php esc_html_e('Type', 'the-optimize-code'); ?></th>
                        <th><?php esc_html_e('Status in Elementor Library', 'the-optimize-code'); ?></th>
                        <th><?php esc_html_e('Action', 'the-optimize-code'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($template_status as $item) : ?>
                        <tr>
                            <td><strong><?php echo esc_html($item['title']); ?></strong></td>
                            <td><code><?php echo esc_html(ucfirst($item['type'])); ?></code></td>
                            <td>
                                <?php if ($item['installed']) : ?>
                                    <span style="color: #00a32a; font-weight: 600;">&#10003; <?php esc_html_e('Installed (Ready to Insert)', 'the-optimize-code'); ?></span>
                                <?php else : ?>
                                    <span style="color: #d63638;"><?php esc_html_e('Not yet synced', 'the-optimize-code'); ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($item['installed'] && $item['edit_url']) : ?>
                                    <a href="<?php echo esc_url($item['edit_url']); ?>" class="button button-small" target="_blank"><?php esc_html_e('Edit in Elementor &nearr;', 'the-optimize-code'); ?></a>
                                <?php else : ?>
                                    <span class="description"><?php esc_html_e('Click Sync above', 'the-optimize-code'); ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="card" style="max-width: 860px; margin-top: 20px;">
            <h2><?php esc_html_e('Step 4: Export Versioned Template JSON', 'the-optimize-code'); ?></h2>
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

    $catalog = toc_get_prebuilt_templates_catalog();
    $templates = [];

    foreach ($catalog as $slug => $item) {
        $templates[$slug] = [
            'name'     => $item['title'],
            'type'     => $item['type'],
            'elements' => toc_build_elementor_section_data($item['widgets'], $slug),
        ];
    }

    $export = [
        'theme'     => 'The Optimize Code',
        'version'   => wp_get_theme()->get('Version'),
        'exported'  => current_time('mysql'),
        'templates' => $templates,
    ];

    header('Content-Type: application/json; charset=utf-8');
    header('Content-Disposition: attachment; filename="toc-elementor-templates-' . gmdate('Y-m-d') . '.json"');
    echo wp_json_encode($export, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    exit;
}
add_action('admin_init', 'toc_handle_template_export');

/**
 * Return catalog of all 16 prebuilt section templates and 3 full-page layouts.
 *
 * @return array
 */
function toc_get_prebuilt_templates_catalog(): array
{
    return [
        'toc-sec-hero' => [
            'slug'    => 'toc-sec-hero',
            'title'   => __('[TOC] 01 - Hero Section', 'the-optimize-code'),
            'type'    => 'section',
            'widgets' => [['widgetType' => 'toc-hero']],
        ],
        'toc-sec-ticker' => [
            'slug'    => 'toc-sec-ticker',
            'title'   => __('[TOC] 02 - Continuous Ticker Section', 'the-optimize-code'),
            'type'    => 'section',
            'widgets' => [['widgetType' => 'toc-ticker']],
        ],
        'toc-sec-featured-podcast' => [
            'slug'    => 'toc-sec-featured-podcast',
            'title'   => __('[TOC] 03 - Featured Podcast Section', 'the-optimize-code'),
            'type'    => 'section',
            'widgets' => [['widgetType' => 'toc-featured-podcast']],
        ],
        'toc-sec-feature-cards' => [
            'slug'    => 'toc-sec-feature-cards',
            'title'   => __('[TOC] 04 - Feature Cards (Receipts) Section', 'the-optimize-code'),
            'type'    => 'section',
            'widgets' => [['widgetType' => 'toc-feature-cards']],
        ],
        'toc-sec-blueprint-story' => [
            'slug'    => 'toc-sec-blueprint-story',
            'title'   => __('[TOC] 05 - Blueprint Story Section', 'the-optimize-code'),
            'type'    => 'section',
            'widgets' => [['widgetType' => 'toc-blueprint-story']],
        ],
        'toc-sec-process-steps' => [
            'slug'    => 'toc-sec-process-steps',
            'title'   => __('[TOC] 06 - Process Steps Section', 'the-optimize-code'),
            'type'    => 'section',
            'widgets' => [['widgetType' => 'toc-process-steps']],
        ],
        'toc-sec-education-grid' => [
            'slug'    => 'toc-sec-education-grid',
            'title'   => __('[TOC] 07 - Education Grid Section', 'the-optimize-code'),
            'type'    => 'section',
            'widgets' => [['widgetType' => 'toc-education-grid']],
        ],
        'toc-sec-cta-newsletter' => [
            'slug'    => 'toc-sec-cta-newsletter',
            'title'   => __('[TOC] 08 - Newsletter & Contact CTA Section', 'the-optimize-code'),
            'type'    => 'section',
            'widgets' => [['widgetType' => 'toc-cta-newsletter']],
        ],
        'toc-sec-section-header-split' => [
            'slug'    => 'toc-sec-section-header-split',
            'title'   => __('[TOC] 09 - Section Header (Split Layout)', 'the-optimize-code'),
            'type'    => 'section',
            'widgets' => [
                [
                    'widgetType' => 'toc-section-header',
                    'settings'   => [
                        'layout'  => 'split',
                        'eyebrow' => __('Stay Curious', 'the-optimize-code'),
                        'title'   => __('Read. Watch.<br>Question. Repeat.', 'the-optimize-code'),
                    ],
                ],
            ],
        ],
        'toc-sec-section-header-stacked' => [
            'slug'    => 'toc-sec-section-header-stacked',
            'title'   => __('[TOC] 10 - Section Header (Stacked Layout)', 'the-optimize-code'),
            'type'    => 'section',
            'widgets' => [
                [
                    'widgetType' => 'toc-section-header',
                    'settings'   => [
                        'layout'      => 'stacked',
                        'eyebrow'     => __('02 / Core Pillars', 'the-optimize-code'),
                        'title'       => __('The receipts', 'the-optimize-code'),
                        'description' => __('Four foundational lenses through which we examine human biology, preventive genomics, and long-term health literacy.', 'the-optimize-code'),
                    ],
                ],
            ],
        ],
        'toc-sec-testing-hero' => [
            'slug'    => 'toc-sec-testing-hero',
            'title'   => __('[TOC] 11 - Testing Hero Section', 'the-optimize-code'),
            'type'    => 'section',
            'widgets' => [['widgetType' => 'toc-testing-hero']],
        ],
        'toc-sec-testing-pathways' => [
            'slug'    => 'toc-sec-testing-pathways',
            'title'   => __('[TOC] 12 - Testing Pathways Section', 'the-optimize-code'),
            'type'    => 'section',
            'widgets' => [['widgetType' => 'toc-testing-pathways']],
        ],
        'toc-sec-notice-disclaimer' => [
            'slug'    => 'toc-sec-notice-disclaimer',
            'title'   => __('[TOC] 13 - Notice & Medical Disclaimer Section', 'the-optimize-code'),
            'type'    => 'section',
            'widgets' => [['widgetType' => 'toc-notice-disclaimer']],
        ],
        'toc-sec-pgx-request' => [
            'slug'    => 'toc-sec-pgx-request',
            'title'   => __('[TOC] 14 - PGx Request Section', 'the-optimize-code'),
            'type'    => 'section',
            'widgets' => [['widgetType' => 'toc-pgx-request']],
        ],
        'toc-sec-gallery-hero' => [
            'slug'    => 'toc-sec-gallery-hero',
            'title'   => __('[TOC] 15 - Gallery Hero Section', 'the-optimize-code'),
            'type'    => 'section',
            'widgets' => [['widgetType' => 'toc-gallery-hero']],
        ],
        'toc-sec-gallery-wall' => [
            'slug'    => 'toc-sec-gallery-wall',
            'title'   => __('[TOC] 16 - Gallery Wall Section', 'the-optimize-code'),
            'type'    => 'section',
            'widgets' => [['widgetType' => 'toc-gallery']],
        ],
        'toc-page-home' => [
            'slug'    => 'toc-page-home',
            'title'   => __('[TOC Page] Full Home Page', 'the-optimize-code'),
            'type'    => 'page',
            'widgets' => [
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
        'toc-page-testing' => [
            'slug'    => 'toc-page-testing',
            'title'   => __('[TOC Page] Full Testing Page', 'the-optimize-code'),
            'type'    => 'page',
            'widgets' => [
                ['widgetType' => 'toc-testing-hero'],
                ['widgetType' => 'toc-testing-pathways'],
                ['widgetType' => 'toc-notice-disclaimer'],
                ['widgetType' => 'toc-pgx-request'],
            ],
        ],
        'toc-page-gallery' => [
            'slug'    => 'toc-page-gallery',
            'title'   => __('[TOC Page] Full Gallery Page', 'the-optimize-code'),
            'type'    => 'page',
            'widgets' => [
                ['widgetType' => 'toc-gallery-hero'],
                ['widgetType' => 'toc-gallery'],
            ],
        ],
    ];
}

/**
 * Build Elementor section data structure with full-width zero-gap container.
 *
 * @param array  $widgets List of widget type and settings arrays.
 * @param string $prefix  Identifier prefix for element IDs.
 * @return array
 */
function toc_build_elementor_section_data(array $widgets, string $prefix = 'sec'): array
{
    $sections = [];
    foreach ($widgets as $idx => $w_info) {
        $sec_id = 'sec_' . substr(md5($prefix . '_' . $idx . '_' . $w_info['widgetType']), 0, 7);
        $col_id = 'col_' . substr(md5($prefix . '_' . $idx . '_' . $w_info['widgetType']), 0, 7);
        $wgt_id = 'toc_' . substr(md5($prefix . '_' . $idx . '_' . $w_info['widgetType']), 0, 7);

        $sections[] = [
            'id'       => $sec_id,
            'elType'   => 'section',
            'isInner'  => false,
            'settings' => [
                'layout'  => 'full_width',
                'gap'     => 'no',
                'padding' => [
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
                    'isInner'  => false,
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
                            'settings'   => $w_info['settings'] ?? [],
                        ],
                    ],
                ],
            ],
        ];
    }
    return $sections;
}

/**
 * Synchronize prebuilt section and page templates into elementor_library.
 *
 * @param bool $force Whether to force update existing templates.
 * @return array Log messages describing actions performed.
 */
function toc_sync_prebuilt_templates(bool $force = false): array
{
    $catalog = toc_get_prebuilt_templates_catalog();
    $logs    = [];

    // Ensure taxonomy exists
    if (!taxonomy_exists('elementor_library_type')) {
        register_taxonomy('elementor_library_type', 'elementor_library', [
            'public'       => false,
            'hierarchical' => false,
        ]);
    }

    foreach ($catalog as $slug => $item) {
        $title = $item['title'];
        $type  = $item['type']; // 'section' or 'page'

        $existing = get_posts([
            'post_type'      => 'elementor_library',
            'post_status'    => 'any',
            'posts_per_page' => 1,
            'meta_key'       => '_toc_prebuilt_slug',
            'meta_value'     => $slug,
            'fields'         => 'ids',
        ]);

        $post_id = !empty($existing) ? (int) $existing[0] : 0;

        if ($post_id > 0 && !$force) {
            $logs[] = sprintf(__('Template "%s" is already synced (ID %d).', 'the-optimize-code'), $title, $post_id);
            continue;
        }

        $elementor_data = toc_build_elementor_section_data($item['widgets'], $slug);

        if ($post_id > 0) {
            wp_update_post([
                'ID'          => $post_id,
                'post_title'  => $title,
                'post_status' => 'publish',
            ]);
        } else {
            $post_id = wp_insert_post([
                'post_title'  => $title,
                'post_type'   => 'elementor_library',
                'post_status' => 'publish',
            ]);
        }

        if ($post_id && !is_wp_error($post_id)) {
            wp_set_object_terms($post_id, $type, 'elementor_library_type');
            update_post_meta($post_id, '_elementor_template_type', $type);
            update_post_meta($post_id, '_elementor_edit_mode', 'builder');
            update_post_meta($post_id, '_elementor_version', defined('ELEMENTOR_VERSION') ? ELEMENTOR_VERSION : '3.0.0');
            update_post_meta($post_id, '_elementor_data', wp_slash(wp_json_encode($elementor_data)));
            update_post_meta($post_id, '_toc_prebuilt_slug', $slug);
            delete_post_meta($post_id, '_elementor_css');

            $logs[] = sprintf(__('Successfully registered "%s" as an Elementor %s template (ID %d).', 'the-optimize-code'), $title, $type, $post_id);
        }
    }

    if (class_exists('\\Elementor\\Plugin')) {
        \Elementor\Plugin::$instance->files_manager->clear_cache();
    }

    return $logs;
}

/**
 * Get the status of all prebuilt templates for the admin dashboard.
 *
 * @return array
 */
function toc_get_prebuilt_templates_status(): array
{
    $catalog = toc_get_prebuilt_templates_catalog();
    $status  = [];

    foreach ($catalog as $slug => $item) {
        $existing = get_posts([
            'post_type'      => 'elementor_library',
            'post_status'    => 'any',
            'posts_per_page' => 1,
            'meta_key'       => '_toc_prebuilt_slug',
            'meta_value'     => $slug,
            'fields'         => 'ids',
        ]);

        $post_id  = !empty($existing) ? (int) $existing[0] : 0;
        $edit_url = $post_id ? admin_url('post.php?post=' . $post_id . '&action=elementor') : '';

        $status[] = [
            'slug'      => $slug,
            'title'     => $item['title'],
            'type'      => $item['type'],
            'installed' => ($post_id > 0),
            'post_id'   => $post_id,
            'edit_url'  => $edit_url,
        ];
    }

    return $status;
}

/**
 * Automatically sync prebuilt templates on initialization if not yet done.
 */
function toc_auto_sync_prebuilt_templates_check(): void
{
    if (!toc_elementor_is_available()) {
        return;
    }

    $current_version = '1.1.0';
    $synced_version  = get_option('toc_prebuilt_templates_version', '');

    if ($synced_version !== $current_version) {
        toc_sync_prebuilt_templates(false);
        update_option('toc_prebuilt_templates_version', $current_version);
    }
}
add_action('init', 'toc_auto_sync_prebuilt_templates_check');

