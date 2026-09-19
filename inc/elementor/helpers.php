<?php
/**
 * Elementor shared helpers and rendering utilities.
 *
 * @package The_Optimize_Code
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Safely render link attributes for an Elementor URL control.
 *
 * @param array $url_control Elementor URL control value.
 * @param array $default_attrs Additional attributes to append.
 * @return string Safe HTML attributes string.
 */
function toc_elementor_render_link_attrs(array $url_control, array $default_attrs = []): string
{
    if (empty($url_control['url'])) {
        return '';
    }

    $attrs = array_merge([
        'href' => esc_url($url_control['url']),
    ], $default_attrs);

    if (!empty($url_control['is_external'])) {
        $attrs['target'] = '_blank';
        $attrs['rel']    = 'noopener noreferrer';
    }

    if (!empty($url_control['nofollow'])) {
        $existing_rel = $attrs['rel'] ?? '';
        $attrs['rel']  = trim($existing_rel . ' nofollow');
    }

    if (!empty($url_control['custom_attributes'])) {
        $custom_entries = explode(',', $url_control['custom_attributes']);
        foreach ($custom_entries as $entry) {
            $parts = explode('|', $entry, 2);
            if (count($parts) === 2) {
                $attr_key = sanitize_key(trim($parts[0]));
                $attr_val = esc_attr(trim($parts[1]));
                if ($attr_key && !in_array($attr_key, ['href', 'onclick', 'onload'], true)) {
                    $attrs[$attr_key] = $attr_val;
                }
            }
        }
    }

    $rendered = [];
    foreach ($attrs as $key => $val) {
        $rendered[] = esc_attr($key) . '="' . esc_attr($val) . '"';
    }

    return implode(' ', $rendered);
}

/**
 * Render a responsive image from an Elementor media control.
 *
 * @param array  $media_control Media control value.
 * @param string $size          Image size.
 * @param array  $attr          HTML attributes.
 * @return string Safe HTML image tag.
 */
function toc_elementor_render_image(array $media_control, string $size = 'full', array $attr = []): string
{
    $attachment_id = !empty($media_control['id']) ? (int) $media_control['id'] : 0;

    if ($attachment_id > 0) {
        $image_html = wp_get_attachment_image($attachment_id, $size, false, $attr);
        if ($image_html) {
            return $image_html;
        }
    }

    if (!empty($media_control['url'])) {
        $alt = !empty($attr['alt']) ? $attr['alt'] : '';
        $class = !empty($attr['class']) ? ' class="' . esc_attr($attr['class']) . '"' : '';
        return '<img src="' . esc_url($media_control['url']) . '" alt="' . esc_attr($alt) . '"' . $class . ' loading="lazy" />';
    }

    return '';
}

/**
 * Sanitize heading / display title HTML, permitting harmless inline formatting.
 *
 * @param string $content Raw title content.
 * @return string Sanitized title string.
 */
function toc_elementor_kses_title(string $content): string
{
    $content = preg_replace('/&lt;(\/?(?:br|em|strong|span|i)(?:\s+[^&]*)?)&gt;/i', '<$1>', $content);
    return wp_kses($content, [
        'br'     => [],
        'em'     => ['class' => []],
        'strong' => ['class' => []],
        'span'   => ['class' => []],
        'i'      => ['class' => []],
    ]);
}

/**
 * Sanitize description HTML, permitting standard inline tags and safe links.
 *
 * @param string $content Raw description content.
 * @return string Sanitized description string.
 */
function toc_elementor_kses_desc(string $content): string
{
    $content = preg_replace('/&lt;(\/?(?:br|em|strong|span|p|a)(?:\s+[^&]*)?)&gt;/i', '<$1>', $content);
    return wp_kses($content, [
        'br'     => [],
        'em'     => ['class' => []],
        'strong' => ['class' => []],
        'span'   => ['class' => []],
        'p'      => ['class' => []],
        'a'      => [
            'href'   => [],
            'target' => [],
            'rel'    => [],
            'class'  => [],
        ],
    ]);
}

/**
 * Validate an HTML tag against an allowlist.
 *
 * @param string $tag     Requested tag name.
 * @param string $default Fallback tag name.
 * @return string Validated tag.
 */
function toc_elementor_validate_tag(string $tag, string $default = 'h2'): string
{
    $allowed = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'p', 'span'];
    $tag = strtolower(trim($tag));
    return in_array($tag, $allowed, true) ? $tag : $default;
}

/**
 * Sanitize a section anchor ID.
 *
 * @param string $id       Input ID.
 * @param string $fallback Fallback string if sanitized is empty.
 * @return string Sanitized ID.
 */
function toc_elementor_sanitize_id(string $id, string $fallback = ''): string
{
    $clean = preg_replace('/[^a-zA-Z0-9_\-]/', '', $id);
    return !empty($clean) ? $clean : $fallback;
}

/**
 * Render an editor empty state message if in Elementor edit mode.
 *
 * @param string $title   Widget title.
 * @param string $message Actionable prompt for editor.
 */
function toc_elementor_editor_empty_state(string $title, string $message = ''): void
{
    if (!class_exists('\\Elementor\\Plugin')) {
        return;
    }

    if (!\Elementor\Plugin::$instance->editor->is_edit_mode()) {
        return;
    }

    $message = $message ?: __('Click here to configure this widget in the Elementor panel.', 'the-optimize-code');
    ?>
    <div class="toc-elementor-empty-state" style="padding: 30px; border: 1px dashed var(--line, #26322c); text-align: center; background: rgba(255,255,255,0.03); border-radius: 4px; margin: 10px 0;">
        <p style="font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--sky, #edf4ef); margin-bottom: 6px;">
            <?php echo esc_html($title); ?>
        </p>
        <p style="font-size: 12px; color: var(--body, #a9b6af); margin: 0;">
            <?php echo esc_html($message); ?>
        </p>
    </div>
    <?php
}
