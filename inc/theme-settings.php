<?php
/**
 * Native, free theme settings and design-token overrides.
 *
 * @package The_Optimize_Code
 */

if (!defined('ABSPATH')) {
    exit;
}

function toc_theme_setting_defaults(): array
{
    return [
        'brand_name'            => 'THE OPTIMIZE CODE',
        'short_brand_name'      => 'TOC',
        'contact_email'         => 'hello@theoptimizecode.com',
        'contact_phone'         => '',
        'contact_address'       => '',
        'organization_name'     => 'The Optimize Code',
        'default_cta_label'     => 'Explore your options',
        'default_cta_url'       => '',
        'global_disclaimer'     => 'Educational content only · Not medical advice · Not a medical clinic',
        'copyright_text'        => '© {year} The Optimize Code',
        'not_found_eyebrow'     => '404 · Signal not found',
        'not_found_title'       => 'PAGE NOT FOUND.',
        'not_found_message'     => 'The page you were looking for is no longer here or may have moved.',
        'not_found_button'      => 'Return home →',
        'logo_light_id'         => 0,
        'logo_dark_id'          => 0,
        'logo_mobile_id'        => 0,
        'header_cta_label'      => 'Explore your options',
        'header_cta_url'        => '',
        'header_cta_new_tab'    => 0,
        'show_theme_toggle'     => 1,
        'announcement_enabled'  => 0,
        'announcement_text'     => '',
        'announcement_url'      => '',
        'loader_enabled'        => 1,
        'loader_brand'          => 'THE OPTIMIZE CODE',
        'loader_established'    => 'EST. 2026',
        'loader_status'         => 'LOADING SIGNAL',
        'loader_message'        => 'EDUCATION BEFORE ACTION',
        'footer_logo_id'        => 0,
        'footer_description'    => 'Personalized health education for people who want context, clarity and better questions.',
        'footer_explore_title'  => 'Explore',
        'footer_services_title' => 'Testing',
        'footer_social_title'   => 'Social Media',
        'footer_legal_text'     => 'Educational content only · Not medical advice · Not a medical clinic',
        'footer_watermark'      => 'OPTIMIZE',
        'footer_watermark_show' => 1,
        'facebook_enabled'      => 1,
        'facebook_label'        => 'Facebook',
        'facebook_url'          => 'https://www.facebook.com/share/14p52fPZgAu/',
        'tiktok_enabled'        => 1,
        'tiktok_label'          => 'TikTok',
        'tiktok_url'            => 'https://www.tiktok.com/@theoptimizecode',
        'instagram_enabled'     => 1,
        'instagram_label'       => 'Instagram',
        'instagram_url'         => 'https://www.instagram.com/theoptimizecode',
        'youtube_enabled'       => 1,
        'youtube_label'         => 'YouTube',
        'youtube_url'           => 'https://www.youtube.com/channel/UC2V08b8hIuP66p6lFf4P1WA',
        'linkedin_enabled'      => 1,
        'linkedin_label'        => 'LinkedIn',
        'linkedin_url'          => 'https://www.linkedin.com/company/theoptimizecode',
        'email_enabled'         => 1,
        'email_label'           => 'Email',
        'social_email'          => 'hello@theoptimizecode.com',
        'light_page'            => '#f7f4ec',
        'light_surface'         => '#ffffff',
        'light_text'            => '#173f36',
        'light_text_muted'      => '#52625b',
        'light_border'          => '#d9ddd3',
        'light_accent'          => '#e8a33b',
        'dark_page'             => '#090d0b',
        'dark_surface'          => '#111713',
        'dark_text'             => '#edf4ef',
        'dark_text_muted'       => '#a9b6af',
        'dark_border'           => '#26322c',
        'dark_accent'           => '#e8a33b',
        'newsletter_shortcode'  => '',
        'pgx_shortcode'         => '',
    ];
}

function toc_theme_settings_schema(): array
{
    return [
        'general' => [
            'brand_name' => ['label' => __('Brand name', 'the-optimize-code'), 'type' => 'text'],
            'short_brand_name' => ['label' => __('Short brand name', 'the-optimize-code'), 'type' => 'text'],
            'contact_email' => ['label' => __('Contact email', 'the-optimize-code'), 'type' => 'email'],
            'contact_phone' => ['label' => __('Contact phone', 'the-optimize-code'), 'type' => 'text'],
            'contact_address' => ['label' => __('Contact address', 'the-optimize-code'), 'type' => 'textarea'],
            'organization_name' => ['label' => __('Legal organization name', 'the-optimize-code'), 'type' => 'text'],
            'default_cta_label' => ['label' => __('Default CTA label', 'the-optimize-code'), 'type' => 'text'],
            'default_cta_url' => ['label' => __('Default CTA URL', 'the-optimize-code'), 'type' => 'url'],
            'global_disclaimer' => ['label' => __('Global disclaimer', 'the-optimize-code'), 'type' => 'textarea'],
            'copyright_text' => ['label' => __('Copyright text', 'the-optimize-code'), 'type' => 'text', 'description' => __('Use {year} for the current year.', 'the-optimize-code')],
            'not_found_eyebrow' => ['label' => __('404 eyebrow', 'the-optimize-code'), 'type' => 'text'],
            'not_found_title' => ['label' => __('404 title', 'the-optimize-code'), 'type' => 'text'],
            'not_found_message' => ['label' => __('404 message', 'the-optimize-code'), 'type' => 'textarea'],
            'not_found_button' => ['label' => __('404 button label', 'the-optimize-code'), 'type' => 'text'],
        ],
        'header' => [
            'logo_light_id' => ['label' => __('Light-background logo', 'the-optimize-code'), 'type' => 'media'],
            'logo_dark_id' => ['label' => __('Dark-background logo', 'the-optimize-code'), 'type' => 'media'],
            'logo_mobile_id' => ['label' => __('Compact/mobile logo', 'the-optimize-code'), 'type' => 'media'],
            'header_cta_label' => ['label' => __('Header CTA label', 'the-optimize-code'), 'type' => 'text'],
            'header_cta_url' => ['label' => __('Header CTA URL', 'the-optimize-code'), 'type' => 'url'],
            'header_cta_new_tab' => ['label' => __('Open header CTA in a new tab', 'the-optimize-code'), 'type' => 'checkbox'],
            'show_theme_toggle' => ['label' => __('Show light/dark switch', 'the-optimize-code'), 'type' => 'checkbox'],
            'announcement_enabled' => ['label' => __('Enable announcement bar', 'the-optimize-code'), 'type' => 'checkbox'],
            'announcement_text' => ['label' => __('Announcement text', 'the-optimize-code'), 'type' => 'text'],
            'announcement_url' => ['label' => __('Announcement URL', 'the-optimize-code'), 'type' => 'url'],
            'loader_enabled' => ['label' => __('Enable loading animation', 'the-optimize-code'), 'type' => 'checkbox'],
            'loader_brand' => ['label' => __('Loader brand', 'the-optimize-code'), 'type' => 'text'],
            'loader_established' => ['label' => __('Loader established text', 'the-optimize-code'), 'type' => 'text'],
            'loader_status' => ['label' => __('Loader status', 'the-optimize-code'), 'type' => 'text'],
            'loader_message' => ['label' => __('Loader message', 'the-optimize-code'), 'type' => 'text'],
        ],
        'footer' => [
            'footer_logo_id' => ['label' => __('Footer logo', 'the-optimize-code'), 'type' => 'media'],
            'footer_description' => ['label' => __('Footer description', 'the-optimize-code'), 'type' => 'textarea'],
            'footer_explore_title' => ['label' => __('Explore column heading', 'the-optimize-code'), 'type' => 'text'],
            'footer_services_title' => ['label' => __('Services column heading', 'the-optimize-code'), 'type' => 'text'],
            'footer_social_title' => ['label' => __('Social column heading', 'the-optimize-code'), 'type' => 'text'],
            'footer_legal_text' => ['label' => __('Footer legal text', 'the-optimize-code'), 'type' => 'textarea'],
            'footer_watermark' => ['label' => __('Footer watermark', 'the-optimize-code'), 'type' => 'text'],
            'footer_watermark_show' => ['label' => __('Show footer watermark', 'the-optimize-code'), 'type' => 'checkbox'],
        ],
        'social' => toc_social_settings_schema(),
        'appearance' => toc_appearance_settings_schema(),
        'integrations' => [
            'newsletter_shortcode' => ['label' => __('Newsletter form shortcode', 'the-optimize-code'), 'type' => 'shortcode', 'description' => __('Use a shortcode from an approved free form plugin.', 'the-optimize-code')],
            'pgx_shortcode' => ['label' => __('PGx contact form shortcode', 'the-optimize-code'), 'type' => 'shortcode', 'description' => __('Collect contact/request details only unless a secure workflow is approved.', 'the-optimize-code')],
        ],
    ];
}

function toc_social_settings_schema(): array
{
    $fields = [];
    foreach (['facebook' => 'Facebook', 'tiktok' => 'TikTok', 'instagram' => 'Instagram', 'youtube' => 'YouTube', 'linkedin' => 'LinkedIn'] as $key => $label) {
        $fields[$key . '_enabled'] = ['label' => sprintf(__('Enable %s', 'the-optimize-code'), $label), 'type' => 'checkbox'];
        $fields[$key . '_label'] = ['label' => sprintf(__('%s label', 'the-optimize-code'), $label), 'type' => 'text'];
        $fields[$key . '_url'] = ['label' => sprintf(__('%s URL', 'the-optimize-code'), $label), 'type' => 'url'];
    }
    $fields['email_enabled'] = ['label' => __('Enable social email link', 'the-optimize-code'), 'type' => 'checkbox'];
    $fields['email_label'] = ['label' => __('Email link label', 'the-optimize-code'), 'type' => 'text'];
    $fields['social_email'] = ['label' => __('Social email address', 'the-optimize-code'), 'type' => 'email'];
    return $fields;
}

function toc_appearance_settings_schema(): array
{
    $fields = [];
    foreach (['light' => __('Light theme', 'the-optimize-code'), 'dark' => __('Dark theme', 'the-optimize-code')] as $prefix => $theme_label) {
        foreach (['page' => __('page background', 'the-optimize-code'), 'surface' => __('surface', 'the-optimize-code'), 'text' => __('primary text', 'the-optimize-code'), 'text_muted' => __('secondary text', 'the-optimize-code'), 'border' => __('border', 'the-optimize-code'), 'accent' => __('accent', 'the-optimize-code')] as $key => $label) {
            $fields[$prefix . '_' . $key] = ['label' => sprintf('%s — %s', $theme_label, $label), 'type' => 'color'];
        }
    }
    return $fields;
}

function toc_get_theme_option(string $key, $fallback = null)
{
    $defaults = toc_theme_setting_defaults();
    $options  = get_option('toc_theme_options', []);
    if (is_array($options) && array_key_exists($key, $options)) { return $options[$key]; }
    if (array_key_exists($key, $defaults)) { return $defaults[$key]; }
    return $fallback;
}

function toc_register_theme_settings(): void
{
    register_setting('toc_theme_settings', 'toc_theme_options', ['sanitize_callback' => 'toc_sanitize_theme_settings']);
}
add_action('admin_init', 'toc_register_theme_settings');

function toc_sanitize_theme_settings($input): array
{
    $output = get_option('toc_theme_options', []);
    $output = is_array($output) ? $output : [];
    $input  = is_array($input) ? $input : [];
    $schema = [];
    foreach (toc_theme_settings_schema() as $fields) { $schema = array_merge($schema, $fields); }
    foreach ($input as $key => $value) {
        if (!isset($schema[$key])) { continue; }
        $type = $schema[$key]['type'];
        if ('checkbox' === $type) { $output[$key] = empty($value) ? 0 : 1; }
        elseif ('media' === $type) { $output[$key] = absint($value); }
        elseif ('email' === $type) { $output[$key] = sanitize_email($value); }
        elseif ('url' === $type) { $output[$key] = esc_url_raw($value); }
        elseif ('textarea' === $type) { $output[$key] = sanitize_textarea_field($value); }
        elseif ('color' === $type) { $output[$key] = sanitize_hex_color($value) ?: toc_theme_setting_defaults()[$key]; }
        else { $output[$key] = sanitize_text_field($value); }
    }
    return $output;
}

function toc_add_theme_settings_page(): void
{
    add_theme_page(__('Theme Settings', 'the-optimize-code'), __('Theme Settings', 'the-optimize-code'), 'manage_options', 'toc-theme-settings', 'toc_render_theme_settings_page');
}
add_action('admin_menu', 'toc_add_theme_settings_page');

function toc_render_theme_settings_page(): void
{
    if (!current_user_can('manage_options')) { return; }
    $schema = toc_theme_settings_schema();
    $tab = isset($_GET['tab']) ? sanitize_key(wp_unslash($_GET['tab'])) : 'general';
    if (!isset($schema[$tab])) { $tab = 'general'; }
    $labels = ['general' => __('General', 'the-optimize-code'), 'header' => __('Header', 'the-optimize-code'), 'footer' => __('Footer', 'the-optimize-code'), 'social' => __('Social Profiles', 'the-optimize-code'), 'appearance' => __('Appearance', 'the-optimize-code'), 'integrations' => __('Integrations', 'the-optimize-code')];
    ?>
    <div class="wrap toc-settings-wrap">
        <h1><?php esc_html_e('The Optimize Code — Theme Settings', 'the-optimize-code'); ?></h1>
        <nav class="nav-tab-wrapper" aria-label="<?php esc_attr_e('Theme settings sections', 'the-optimize-code'); ?>">
            <?php foreach ($labels as $key => $label) : ?>
                <a class="nav-tab <?php echo $tab === $key ? 'nav-tab-active' : ''; ?>" href="<?php echo esc_url(add_query_arg(['page' => 'toc-theme-settings', 'tab' => $key], admin_url('themes.php'))); ?>"><?php echo esc_html($label); ?></a>
            <?php endforeach; ?>
        </nav>
        <form action="options.php" method="post">
            <?php settings_fields('toc_theme_settings'); ?>
            <table class="form-table" role="presentation"><tbody>
            <?php foreach ($schema[$tab] as $key => $field) : toc_render_theme_setting_field($key, $field); endforeach; ?>
            </tbody></table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function toc_render_theme_setting_field(string $key, array $field): void
{
    $value = toc_get_theme_option($key);
    $name = 'toc_theme_options[' . $key . ']';
    ?>
    <tr>
        <th scope="row"><label for="toc-<?php echo esc_attr($key); ?>"><?php echo esc_html($field['label']); ?></label></th>
        <td>
            <?php if ('textarea' === $field['type']) : ?>
                <textarea class="large-text" rows="4" id="toc-<?php echo esc_attr($key); ?>" name="<?php echo esc_attr($name); ?>"><?php echo esc_textarea((string) $value); ?></textarea>
            <?php elseif ('checkbox' === $field['type']) : ?>
                <input type="hidden" name="<?php echo esc_attr($name); ?>" value="0"><label><input id="toc-<?php echo esc_attr($key); ?>" type="checkbox" name="<?php echo esc_attr($name); ?>" value="1" <?php checked((bool) $value); ?>> <?php esc_html_e('Enabled', 'the-optimize-code'); ?></label>
            <?php elseif ('media' === $field['type']) : ?>
                <div class="toc-media-field">
                    <input class="toc-media-id" id="toc-<?php echo esc_attr($key); ?>" type="hidden" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr((string) absint($value)); ?>">
                    <div class="toc-media-preview"><?php echo $value ? wp_get_attachment_image((int) $value, 'thumbnail') : ''; ?></div>
                    <button class="button toc-select-media" type="button"><?php esc_html_e('Choose image', 'the-optimize-code'); ?></button>
                    <button class="button-link-delete toc-remove-media" type="button" <?php echo $value ? '' : 'hidden'; ?>><?php esc_html_e('Remove', 'the-optimize-code'); ?></button>
                </div>
            <?php else : ?>
                <input class="<?php echo 'color' === $field['type'] ? 'toc-color-field' : 'regular-text'; ?>" id="toc-<?php echo esc_attr($key); ?>" type="<?php echo esc_attr(in_array($field['type'], ['email', 'url', 'color'], true) ? $field['type'] : 'text'); ?>" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr((string) $value); ?>">
            <?php endif; ?>
            <?php if (!empty($field['description'])) : ?><p class="description"><?php echo esc_html($field['description']); ?></p><?php endif; ?>
        </td>
    </tr>
    <?php
}

function toc_enqueue_theme_settings_assets(string $hook): void
{
    if ('appearance_page_toc-theme-settings' !== $hook) { return; }
    wp_enqueue_media();
    wp_enqueue_script('toc-theme-settings', get_template_directory_uri() . '/js/theme-settings.js', ['jquery'], toc_asset_version('js/theme-settings.js'), true);
    wp_localize_script('toc-theme-settings', 'tocThemeSettings', ['title' => __('Choose an image', 'the-optimize-code'), 'button' => __('Use this image', 'the-optimize-code')]);
}
add_action('admin_enqueue_scripts', 'toc_enqueue_theme_settings_assets');

function toc_enqueue_dynamic_design_tokens(): void
{
    $light = ['ink' => 'light_page', 'ink-2' => 'light_surface', 'ink-3' => 'light_surface', 'sky' => 'light_text', 'sky-2' => 'light_text', 'sky-dim' => 'light_text_muted', 'line' => 'light_border', 'line-2' => 'light_border', 'body' => 'light_text_muted', 'white' => 'light_text', 'lime' => 'light_accent'];
    $dark  = ['ink' => 'dark_page', 'ink-2' => 'dark_surface', 'ink-3' => 'dark_surface', 'sky' => 'dark_text', 'sky-2' => 'dark_text', 'sky-dim' => 'dark_text_muted', 'line' => 'dark_border', 'line-2' => 'dark_border', 'body' => 'dark_text_muted', 'white' => 'dark_text', 'lime' => 'dark_accent'];
    $css = ':root:not([data-theme="dark"]){';
    foreach ($light as $variable => $setting) { $css .= '--' . $variable . ':' . sanitize_hex_color((string) toc_get_theme_option($setting)) . ';'; }
    $css .= '}html[data-theme="dark"]{';
    foreach ($dark as $variable => $setting) { $css .= '--' . $variable . ':' . sanitize_hex_color((string) toc_get_theme_option($setting)) . ';'; }
    $css .= '}html[data-theme="dark"],html[data-theme="dark"] body{background:var(--ink);color:var(--white)}';
    wp_add_inline_style('toc-wordpress', $css);
}
add_action('wp_enqueue_scripts', 'toc_enqueue_dynamic_design_tokens', 30);
