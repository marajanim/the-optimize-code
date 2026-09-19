<?php
/**
 * TOC PGx Request CTA widget for Elementor Free.
 *
 * @package The_Optimize_Code
 */

if (!defined('ABSPATH')) {
    exit;
}

class TOC_PGX_Request_Widget extends \Elementor\Widget_Base
{
    /**
     * Get widget name.
     */
    public function get_name(): string
    {
        return 'toc-pgx-request';
    }

    /**
     * Get widget title.
     */
    public function get_title(): string
    {
        return esc_html__('TOC PGx Request CTA', 'the-optimize-code');
    }

    /**
     * Get widget icon.
     */
    public function get_icon(): string
    {
        return 'eicon-call-to-action';
    }

    /**
     * Get widget categories.
     */
    public function get_categories(): array
    {
        return ['the-optimize-code'];
    }

    /**
     * Get widget keywords.
     */
    public function get_keywords(): array
    {
        return ['pgx', 'request', 'testing', 'cta', 'clinician', 'toc'];
    }

    /**
     * Register widget controls.
     */
    protected function register_controls(): void
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('PGx Request Content', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_id',
            [
                'label'   => esc_html__('Section Anchor ID', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'pgx-request',
            ]
        );

        $this->add_control(
            'eyebrow',
            [
                'label'       => esc_html__('Eyebrow', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Clinician-connected pathway', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'   => esc_html__('Title', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Interested in PGx?', 'the-optimize-code'),
                'rows'    => 2,
            ]
        );

        $this->add_control(
            'description',
            [
                'label'   => esc_html__('Description', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Start with a secure request. A licensed provider must review and authorize testing before sample collection is arranged.', 'the-optimize-code'),
                'rows'    => 3,
            ]
        );

        $this->add_control(
            'cta_text',
            [
                'label'   => esc_html__('Button Label', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Begin a PGx request →', 'the-optimize-code'),
            ]
        );

        $default_email = sanitize_email((string) toc_get_theme_option('contact_email', 'hello@theoptimizecode.com'));
        $this->add_control(
            'cta_url',
            [
                'label'         => esc_html__('Button Destination URL', 'the-optimize-code'),
                'type'          => \Elementor\Controls_Manager::URL,
                'show_external' => true,
                'default'       => [
                    'url'         => 'mailto:' . $default_email . '?subject=PGx%20testing%20request',
                    'is_external' => false,
                    'nofollow'    => false,
                ],
            ]
        );

        $this->add_control(
            'custom_shortcode',
            [
                'label'       => esc_html__('Optional Form Shortcode', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => '[contact-form-7 id="..."]',
                'description' => esc_html__('If a secure PGx form shortcode is provided, it replaces the email button. Or configure in Theme Settings > Integrations.', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Colors & Styling', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label'     => esc_html__('Background Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pgx-request' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Title Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pgx-request h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend.
     */
    protected function render(): void
    {
        $settings = $this->get_settings_for_display();

        $section_id  = toc_elementor_sanitize_id($settings['section_id'] ?? '', 'pgx-request');
        $eyebrow     = !empty($settings['eyebrow']) ? trim($settings['eyebrow']) : '';
        $title       = !empty($settings['title']) ? trim($settings['title']) : '';
        $description = !empty($settings['description']) ? trim($settings['description']) : '';
        $cta_text    = !empty($settings['cta_text']) ? trim($settings['cta_text']) : '';
        $cta_url     = !empty($settings['cta_url']) ? $settings['cta_url'] : [];

        $shortcode   = !empty($settings['custom_shortcode']) ? trim($settings['custom_shortcode']) : (string) toc_get_theme_option('pgx_shortcode');

        if (empty($title) && empty($description)) {
            toc_elementor_editor_empty_state($this->get_title());
            return;
        }
        ?>
        <section class="pgx-request" id="<?php echo esc_attr($section_id); ?>">
            <div>
                <?php if ($eyebrow) : ?>
                    <span class="feature__eyebrow"><?php echo esc_html($eyebrow); ?></span>
                <?php endif; ?>
                <?php if ($title) : ?>
                    <h2 class="display"><?php echo toc_elementor_kses_title($title); ?></h2>
                <?php endif; ?>
                <?php if ($description) : ?>
                    <p><?php echo toc_elementor_kses_desc($description); ?></p>
                <?php endif; ?>
            </div>

            <?php if ($shortcode) : ?>
                <div class="pgx-request__form-wrap">
                    <?php echo do_shortcode($shortcode); ?>
                </div>
            <?php elseif ($cta_text && !empty($cta_url['url'])) : ?>
                <a class="btn btn--outline-lime" <?php echo toc_elementor_render_link_attrs($cta_url); ?>><?php echo esc_html($cta_text); ?></a>
            <?php endif; ?>
        </section>
        <?php
    }

    /**
     * Render widget output in the editor (Underscore.js template).
     */
    protected function content_template(): void
    {
        ?>
        <#
        var sectionId   = settings.section_id ? settings.section_id.trim() : 'pgx-request';
        var eyebrow     = settings.eyebrow ? settings.eyebrow.trim() : '';
        var title       = settings.title ? settings.title.trim() : '';
        var description = settings.description ? settings.description.trim() : '';
        var ctaText     = settings.cta_text ? settings.cta_text.trim() : '';
        var ctaUrl      = settings.cta_url && settings.cta_url.url ? settings.cta_url.url : '';
        var shortcode   = settings.custom_shortcode ? settings.custom_shortcode.trim() : '';
        #>
        <section class="pgx-request" id="{{ sectionId }}">
            <div>
                <# if (eyebrow) { #>
                    <span class="feature__eyebrow">{{{ eyebrow }}}</span>
                <# } #>
                <# if (title) { #>
                    <h2 class="display">{{{ title }}}</h2>
                <# } #>
                <# if (description) { #>
                    <p>{{{ description }}}</p>
                <# } #>
            </div>

            <# if (shortcode) { #>
                <div class="pgx-request__form-placeholder" style="padding: 15px; border: 1px dashed var(--line, #26322c);">
                    <p style="font-size: 12px; color: var(--body, #a9b6af); margin: 0;">
                        <strong>{{{ '<?php echo esc_js(__('PGx Form Shortcode:', 'the-optimize-code')); ?>' }}}</strong> {{{ shortcode }}}
                    </p>
                </div>
            <# } else if (ctaText && ctaUrl) { #>
                <a class="btn btn--outline-lime" href="{{ ctaUrl }}">{{{ ctaText }}}</a>
            <# } #>
        </section>
        <?php
    }
}
