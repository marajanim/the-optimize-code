<?php
/**
 * Plugin Name: The Optimize Code — Core
 * Plugin URI:  https://theoptimizecode.com
 * Description: Free companion plugin registering reusable Podcast and Educational Resource content types, custom taxonomies, and post metadata for The Optimize Code.
 * Version:     1.0.0
 * Author:      The Optimize Code
 * Author URI:  https://theoptimizecode.com
 * License:     GPL-2.0-or-later
 * Text Domain: toc-core
 * Domain Path: /languages
 *
 * @package TOC_Core
 */

if (!defined('ABSPATH')) {
    exit;
}

define('TOC_CORE_VERSION', '1.0.0');
define('TOC_CORE_PATH', plugin_dir_path(__FILE__));
define('TOC_CORE_URL', plugin_dir_url(__FILE__));

/**
 * Register Custom Post Types: toc_podcast and toc_resource.
 */
function toc_core_register_post_types(): void
{
    // Podcast Custom Post Type
    register_post_type('toc_podcast', [
        'labels' => [
            'name'               => __('Podcasts', 'toc-core'),
            'singular_name'      => __('Podcast Episode', 'toc-core'),
            'add_new'            => __('Add New Episode', 'toc-core'),
            'add_new_item'       => __('Add New Podcast Episode', 'toc-core'),
            'edit_item'          => __('Edit Podcast Episode', 'toc-core'),
            'new_item'           => __('New Podcast Episode', 'toc-core'),
            'view_item'          => __('View Episode', 'toc-core'),
            'search_items'       => __('Search Podcast Episodes', 'toc-core'),
            'not_found'          => __('No episodes found', 'toc-core'),
            'not_found_in_trash' => __('No episodes found in Trash', 'toc-core'),
            'all_items'          => __('All Episodes', 'toc-core'),
            'menu_name'          => __('Podcasts', 'toc-core'),
        ],
        'public'              => true,
        'has_archive'         => true,
        'rewrite'             => ['slug' => 'podcasts', 'with_front' => false],
        'menu_icon'           => 'dashicons-microphone',
        'supports'            => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions'],
        'show_in_rest'        => true,
        'capability_type'     => 'post',
        'map_meta_cap'        => true,
    ]);

    // Educational Resource Custom Post Type
    register_post_type('toc_resource', [
        'labels' => [
            'name'               => __('Resources', 'toc-core'),
            'singular_name'      => __('Resource', 'toc-core'),
            'add_new'            => __('Add New Resource', 'toc-core'),
            'add_new_item'       => __('Add New Educational Resource', 'toc-core'),
            'edit_item'          => __('Edit Resource', 'toc-core'),
            'new_item'           => __('New Resource', 'toc-core'),
            'view_item'          => __('View Resource', 'toc-core'),
            'search_items'       => __('Search Resources', 'toc-core'),
            'not_found'          => __('No resources found', 'toc-core'),
            'not_found_in_trash' => __('No resources found in Trash', 'toc-core'),
            'all_items'          => __('All Resources', 'toc-core'),
            'menu_name'          => __('Education Hub', 'toc-core'),
        ],
        'public'              => true,
        'has_archive'         => true,
        'rewrite'             => ['slug' => 'resources', 'with_front' => false],
        'menu_icon'           => 'dashicons-welcome-learn-more',
        'supports'            => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions'],
        'show_in_rest'        => true,
        'capability_type'     => 'post',
        'map_meta_cap'        => true,
    ]);
}
add_action('init', 'toc_core_register_post_types');

/**
 * Register Custom Taxonomies: toc_topic and toc_resource_type.
 */
function toc_core_register_taxonomies(): void
{
    // Topics (hierarchical)
    register_taxonomy('toc_topic', ['toc_podcast', 'toc_resource'], [
        'labels' => [
            'name'          => __('Topics', 'toc-core'),
            'singular_name' => __('Topic', 'toc-core'),
            'search_items'  => __('Search Topics', 'toc-core'),
            'all_items'     => __('All Topics', 'toc-core'),
            'edit_item'     => __('Edit Topic', 'toc-core'),
            'update_item'   => __('Update Topic', 'toc-core'),
            'add_new_item'  => __('Add New Topic', 'toc-core'),
            'new_item_name' => __('New Topic Name', 'toc-core'),
            'menu_name'     => __('Topics', 'toc-core'),
        ],
        'hierarchical'      => true,
        'public'            => true,
        'show_in_rest'      => true,
        'rewrite'           => ['slug' => 'topics', 'with_front' => false],
    ]);

    // Resource Types (e.g. Guide, Video, Article, Audio)
    register_taxonomy('toc_resource_type', ['toc_resource'], [
        'labels' => [
            'name'          => __('Resource Types', 'toc-core'),
            'singular_name' => __('Resource Type', 'toc-core'),
            'search_items'  => __('Search Resource Types', 'toc-core'),
            'all_items'     => __('All Resource Types', 'toc-core'),
            'edit_item'     => __('Edit Resource Type', 'toc-core'),
            'update_item'   => __('Update Resource Type', 'toc-core'),
            'add_new_item'  => __('Add New Resource Type', 'toc-core'),
            'new_item_name' => __('New Resource Type Name', 'toc-core'),
            'menu_name'     => __('Resource Types', 'toc-core'),
        ],
        'hierarchical'      => false,
        'public'            => true,
        'show_in_rest'      => true,
        'rewrite'           => ['slug' => 'resource-types', 'with_front' => false],
    ]);
}
add_action('init', 'toc_core_register_taxonomies');

/**
 * Register Post Metadata with safe sanitization and REST support.
 */
function toc_core_register_post_meta(): void
{
    // Podcast Meta
    register_post_meta('toc_podcast', '_toc_podcast_episode_number', [
        'show_in_rest'      => true,
        'single'            => true,
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback'     => function () {
            return current_user_can('edit_posts');
        },
    ]);

    register_post_meta('toc_podcast', '_toc_podcast_duration', [
        'show_in_rest'      => true,
        'single'            => true,
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback'     => function () {
            return current_user_can('edit_posts');
        },
    ]);

    register_post_meta('toc_podcast', '_toc_podcast_audio_url', [
        'show_in_rest'      => true,
        'single'            => true,
        'type'              => 'string',
        'sanitize_callback' => 'esc_url_raw',
        'auth_callback'     => function () {
            return current_user_can('edit_posts');
        },
    ]);

    register_post_meta('toc_podcast', '_toc_podcast_tags', [
        'show_in_rest'      => true,
        'single'            => true,
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback'     => function () {
            return current_user_can('edit_posts');
        },
    ]);

    // Resource Meta
    register_post_meta('toc_resource', '_toc_resource_badge', [
        'show_in_rest'      => true,
        'single'            => true,
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback'     => function () {
            return current_user_can('edit_posts');
        },
    ]);

    register_post_meta('toc_resource', '_toc_resource_duration', [
        'show_in_rest'      => true,
        'single'            => true,
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback'     => function () {
            return current_user_can('edit_posts');
        },
    ]);

    register_post_meta('toc_resource', '_toc_resource_media_url', [
        'show_in_rest'      => true,
        'single'            => true,
        'type'              => 'string',
        'sanitize_callback' => 'esc_url_raw',
        'auth_callback'     => function () {
            return current_user_can('edit_posts');
        },
    ]);
}
add_action('init', 'toc_core_register_post_meta');

/**
 * Add nonced meta boxes for Podcast and Resource details.
 */
function toc_core_add_meta_boxes(): void
{
    add_meta_box(
        'toc_podcast_details',
        __('Podcast Episode Details', 'toc-core'),
        'toc_core_render_podcast_meta_box',
        'toc_podcast',
        'normal',
        'high'
    );

    add_meta_box(
        'toc_resource_details',
        __('Educational Resource Details', 'toc-core'),
        'toc_core_render_resource_meta_box',
        'toc_resource',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'toc_core_add_meta_boxes');

/**
 * Render Podcast Meta Box.
 *
 * @param WP_Post $post Current post object.
 */
function toc_core_render_podcast_meta_box($post): void
{
    wp_nonce_field('toc_podcast_meta_save', 'toc_podcast_meta_nonce');

    $ep_num   = get_post_meta($post->ID, '_toc_podcast_episode_number', true);
    $duration = get_post_meta($post->ID, '_toc_podcast_duration', true);
    $audio    = get_post_meta($post->ID, '_toc_podcast_audio_url', true);
    $tags     = get_post_meta($post->ID, '_toc_podcast_tags', true);
    ?>
    <table class="form-table" role="presentation">
        <tbody>
            <tr>
                <th scope="row"><label for="toc_ep_num"><?php esc_html_e('Episode Label / Number', 'toc-core'); ?></label></th>
                <td>
                    <input type="text" id="toc_ep_num" name="toc_podcast_episode_number" value="<?php echo esc_attr($ep_num); ?>" class="regular-text" placeholder="<?php esc_attr_e('e.g. EP / 018', 'toc-core'); ?>">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="toc_duration"><?php esc_html_e('Duration', 'toc-core'); ?></label></th>
                <td>
                    <input type="text" id="toc_duration" name="toc_podcast_duration" value="<?php echo esc_attr($duration); ?>" class="regular-text" placeholder="<?php esc_attr_e('e.g. 42 min', 'toc-core'); ?>">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="toc_audio"><?php esc_html_e('Audio File URL', 'toc-core'); ?></label></th>
                <td>
                    <input type="url" id="toc_audio" name="toc_podcast_audio_url" value="<?php echo esc_url($audio); ?>" class="large-text" placeholder="<?php esc_attr_e('https://.../episode.mp3', 'toc-core'); ?>">
                    <p class="description"><?php esc_html_e('Direct URL to MP3, WAV, or OGG audio file for the interactive player.', 'toc-core'); ?></p>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="toc_tags"><?php esc_html_e('Highlight Tags', 'toc-core'); ?></label></th>
                <td>
                    <input type="text" id="toc_tags" name="toc_podcast_tags" value="<?php echo esc_attr($tags); ?>" class="large-text" placeholder="<?php esc_attr_e('e.g. Nutrigenomics, 42 min', 'toc-core'); ?>">
                    <p class="description"><?php esc_html_e('Comma-separated list of badges to show on the episode card.', 'toc-core'); ?></p>
                </td>
            </tr>
        </tbody>
    </table>
    <?php
}

/**
 * Render Resource Meta Box.
 *
 * @param WP_Post $post Current post object.
 */
function toc_core_render_resource_meta_box($post): void
{
    wp_nonce_field('toc_resource_meta_save', 'toc_resource_meta_nonce');

    $badge    = get_post_meta($post->ID, '_toc_resource_badge', true);
    $duration = get_post_meta($post->ID, '_toc_resource_duration', true);
    $media    = get_post_meta($post->ID, '_toc_resource_media_url', true);
    ?>
    <table class="form-table" role="presentation">
        <tbody>
            <tr>
                <th scope="row"><label for="toc_badge"><?php esc_html_e('Header Badge / Category', 'toc-core'); ?></label></th>
                <td>
                    <input type="text" id="toc_badge" name="toc_resource_badge" value="<?php echo esc_attr($badge); ?>" class="regular-text" placeholder="<?php esc_attr_e('e.g. FEATURED GUIDE · 8 MIN', 'toc-core'); ?>">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="toc_res_duration"><?php esc_html_e('Read / Watch Duration', 'toc-core'); ?></label></th>
                <td>
                    <input type="text" id="toc_res_duration" name="toc_resource_duration" value="<?php echo esc_attr($duration); ?>" class="regular-text" placeholder="<?php esc_attr_e('e.g. 06:20 or 8 MIN', 'toc-core'); ?>">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="toc_res_media"><?php esc_html_e('External Video / Media URL', 'toc-core'); ?></label></th>
                <td>
                    <input type="url" id="toc_res_media" name="toc_resource_media_url" value="<?php echo esc_url($media); ?>" class="large-text" placeholder="<?php esc_attr_e('https://...', 'toc-core'); ?>">
                </td>
            </tr>
        </tbody>
    </table>
    <?php
}

/**
 * Save Post Meta with Nonce and Capability verification.
 *
 * @param int $post_id Post ID.
 */
function toc_core_save_post_meta(int $post_id): void
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save Podcast Meta
    if (isset($_POST['toc_podcast_meta_nonce']) && wp_verify_nonce($_POST['toc_podcast_meta_nonce'], 'toc_podcast_meta_save')) {
        if (isset($_POST['toc_podcast_episode_number'])) {
            update_post_meta($post_id, '_toc_podcast_episode_number', sanitize_text_field(wp_unslash($_POST['toc_podcast_episode_number'])));
        }
        if (isset($_POST['toc_podcast_duration'])) {
            update_post_meta($post_id, '_toc_podcast_duration', sanitize_text_field(wp_unslash($_POST['toc_podcast_duration'])));
        }
        if (isset($_POST['toc_podcast_audio_url'])) {
            update_post_meta($post_id, '_toc_podcast_audio_url', esc_url_raw(wp_unslash($_POST['toc_podcast_audio_url'])));
        }
        if (isset($_POST['toc_podcast_tags'])) {
            update_post_meta($post_id, '_toc_podcast_tags', sanitize_text_field(wp_unslash($_POST['toc_podcast_tags'])));
        }
    }

    // Save Resource Meta
    if (isset($_POST['toc_resource_meta_nonce']) && wp_verify_nonce($_POST['toc_resource_meta_nonce'], 'toc_resource_meta_save')) {
        if (isset($_POST['toc_resource_badge'])) {
            update_post_meta($post_id, '_toc_resource_badge', sanitize_text_field(wp_unslash($_POST['toc_resource_badge'])));
        }
        if (isset($_POST['toc_resource_duration'])) {
            update_post_meta($post_id, '_toc_resource_duration', sanitize_text_field(wp_unslash($_POST['toc_resource_duration'])));
        }
        if (isset($_POST['toc_resource_media_url'])) {
            update_post_meta($post_id, '_toc_resource_media_url', esc_url_raw(wp_unslash($_POST['toc_resource_media_url'])));
        }
    }
}
add_action('save_post', 'toc_core_save_post_meta');

/**
 * Activation Hook: flush rewrites.
 */
function toc_core_activate(): void
{
    toc_core_register_post_types();
    toc_core_register_taxonomies();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'toc_core_activate');

/**
 * Deactivation Hook: flush rewrites.
 */
function toc_core_deactivate(): void
{
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'toc_core_deactivate');
