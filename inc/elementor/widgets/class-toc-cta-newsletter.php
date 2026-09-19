<?php
/**
 * TOC CTA / Newsletter widget for Elementor Free.
 *
 * @package The_Optimize_Code
 */

if (!defined('ABSPATH')) {
    exit;
}

class TOC_CTA_Newsletter_Widget extends \Elementor\Widget_Base
{
    /**
     * Get widget name.
     */
    public function get_name(): string
    {
        return 'toc-cta-newsletter';
    }

    /**
     * Get widget title.
     */
    public function get_title(): string
    {
        return esc_html__('TOC CTA / Newsletter', 'the-optimize-code');
    }

    /**
     * Get widget icon.
     */
    public function get_icon(): string
    {
        return 'eicon-form-horizontal';
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
        return ['cta', 'newsletter', 'form', 'contact', 'subscribe', 'toc'];
    }

    /**
     * Register widget controls.
     */
    protected function register_controls(): void
    {
        // ==========================================
        // CONTENT TAB - COPY
        // ==========================================
        $this->start_controls_section(
            'section_content_copy',
            [
                'label' => esc_html__('CTA Content', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_id',
            [
                'label'       => esc_html__('Section Anchor ID', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'contact',
                'description' => esc_html__('Target ID for navigation and jump links.', 'the-optimize-code'),
            ]
        );

        $this->add_control(
            'eyebrow',
            [
                'label'       => esc_html__('Eyebrow', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Stay curious', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'heading',
            [
                'label'       => esc_html__('Heading', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => __('Build your<br>health literacy.<br><em>One signal at a time.</em>', 'the-optimize-code'),
                'rows'        => 3,
            ]
        );

        $this->add_control(
            'description',
            [
                'label'   => esc_html__('Description', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Get new podcast episodes, educational guides and testing updates in your inbox. No miracle claims. No fear-based wellness.', 'the-optimize-code'),
                'rows'    => 3,
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'feature',
            [
                'label'       => esc_html__('Feature Item', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Evidence-aware education', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'features',
            [
                'label'       => esc_html__('Feature Highlights', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    ['feature' => esc_html__('Evidence-aware education', 'the-optimize-code')],
                    ['feature' => esc_html__('New episode notes', 'the-optimize-code')],
                    ['feature' => esc_html__('Product updates', 'the-optimize-code')],
                ],
                'title_field' => '{{{ feature }}}',
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB - FORM SETTINGS
        // ==========================================
        $this->start_controls_section(
            'section_content_form',
            [
                'label' => esc_html__('Form Integration', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'custom_shortcode',
            [
                'label'       => esc_html__('Form Shortcode', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => '[contact-form-7 id="..."]',
                'description' => esc_html__('Leave empty to use the shortcode configured in Appearance > Theme Settings > Integrations.', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'submit_note',
            [
                'label'   => esc_html__('Submit Note / Privacy Note', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Education, not inbox overload.', 'the-optimize-code'),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'   => esc_html__('Button Label', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Keep me informed →', 'the-optimize-code'),
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB - COLORS
        // ==========================================
        $this->start_controls_section(
            'section_style_colors',
            [
                'label' => esc_html__('Colors & Styling', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label'     => esc_html__('Section Background', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cta' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label'     => esc_html__('Heading Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cta__copy h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'accent_color',
            [
                'label'     => esc_html__('Accent Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cta__copy h2 em' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__('Description Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cta__sub' => 'color: {{VALUE}};',
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

        $section_id  = toc_elementor_sanitize_id($settings['section_id'] ?? '', 'contact');
        $eyebrow     = !empty($settings['eyebrow']) ? trim($settings['eyebrow']) : '';
        $heading     = !empty($settings['heading']) ? trim($settings['heading']) : '';
        $description = !empty($settings['description']) ? trim($settings['description']) : '';
        $features    = !empty($settings['features']) && is_array($settings['features']) ? $settings['features'] : [];
        $submit_note = !empty($settings['submit_note']) ? trim($settings['submit_note']) : '';
        $button_text = !empty($settings['button_text']) ? trim($settings['button_text']) : 'Keep me informed →';

        // Check widget shortcode first, then global Theme Settings option
        $shortcode = !empty($settings['custom_shortcode']) ? trim($settings['custom_shortcode']) : (string) toc_get_theme_option('newsletter_shortcode');
        ?>
        <section class="cta" id="<?php echo esc_attr($section_id); ?>">
            <div class="cta__grid">
                <div class="cta__copy">
                    <?php if ($eyebrow) : ?>
                        <span class="feature__eyebrow"><?php echo esc_html($eyebrow); ?></span>
                    <?php endif; ?>
                    <?php if ($heading) : ?>
                        <h2><?php echo toc_elementor_kses_title($heading); ?></h2>
                    <?php endif; ?>
                    <?php if ($description) : ?>
                        <p class="cta__sub"><?php echo toc_elementor_kses_desc($description); ?></p>
                    <?php endif; ?>
                    <?php if (!empty($features)) : ?>
                        <div class="cta__features">
                            <?php foreach ($features as $item) : ?>
                                <?php if (!empty($item['feature'])) : ?>
                                    <span><?php echo esc_html($item['feature']); ?></span>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="cta__form-wrap">
                    <?php if ($shortcode) : ?>
                        <div class="toc-embedded-form">
                            <?php echo do_shortcode($shortcode); ?>
                        </div>
                    <?php else : ?>
                        <form class="contact-form" action="#" method="post">
                            <div class="form-field">
                                <label for="toc-cta-name"><?php esc_html_e('Your name', 'the-optimize-code'); ?></label>
                                <input id="toc-cta-name" name="name" autocomplete="name" required placeholder="<?php esc_attr_e('Alex Morgan', 'the-optimize-code'); ?>">
                            </div>
                            <div class="form-field">
                                <label for="toc-cta-email"><?php esc_html_e('Email address', 'the-optimize-code'); ?></label>
                                <input id="toc-cta-email" name="email" type="email" autocomplete="email" required placeholder="<?php esc_attr_e('alex@example.com', 'the-optimize-code'); ?>">
                            </div>
                            <div class="form-field">
                                <label for="toc-cta-interest"><?php esc_html_e("I'm interested in", 'the-optimize-code'); ?></label>
                                <select id="toc-cta-interest" name="interest">
                                    <option><?php esc_html_e('Podcast & education', 'the-optimize-code'); ?></option>
                                    <option><?php esc_html_e('Nutrigenomics / wellness testing', 'the-optimize-code'); ?></option>
                                    <option><?php esc_html_e('The Optimize Blueprint', 'the-optimize-code'); ?></option>
                                    <option><?php esc_html_e('PGx testing information', 'the-optimize-code'); ?></option>
                                </select>
                            </div>
                            <div class="form-submit">
                                <?php if ($submit_note) : ?>
                                    <span class="form-submit__note"><?php echo esc_html($submit_note); ?></span>
                                <?php endif; ?>
                                <button class="btn btn--primary" type="submit"><?php echo esc_html($button_text); ?></button>
                            </div>
                            <p class="form-message" aria-live="polite"></p>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
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
        var sectionId   = settings.section_id ? settings.section_id.trim() : 'contact';
        var eyebrow     = settings.eyebrow ? settings.eyebrow.trim() : '';
        var heading     = settings.heading ? settings.heading.trim() : '';
        var description = settings.description ? settings.description.trim() : '';
        var features    = settings.features || [];
        var submitNote  = settings.submit_note ? settings.submit_note.trim() : '';
        var buttonText  = settings.button_text ? settings.button_text.trim() : 'Keep me informed →';
        var shortcode   = settings.custom_shortcode ? settings.custom_shortcode.trim() : '';
        #>
        <section class="cta" id="{{ sectionId }}">
            <div class="cta__grid">
                <div class="cta__copy">
                    <# if (eyebrow) { #>
                        <span class="feature__eyebrow">{{{ eyebrow }}}</span>
                    <# } #>
                    <# if (heading) { #>
                        <h2>{{{ heading }}}</h2>
                    <# } #>
                    <# if (description) { #>
                        <p class="cta__sub">{{{ description }}}</p>
                    <# } #>
                    <# if (features.length) { #>
                        <div class="cta__features">
                            <# _.each(features, function(f) { if (f.feature) { #>
                                <span>{{{ f.feature }}}</span>
                            <# } }); #>
                        </div>
                    <# } #>
                </div>

                <div class="cta__form-wrap">
                    <# if (shortcode) { #>
                        <div class="toc-embedded-form-placeholder" style="padding: 20px; border: 1px dashed var(--line, #26322c); text-align: center;">
                            <p style="font-size: 12px; color: var(--body, #a9b6af); margin: 0;">
                                <strong>{{{ '<?php echo esc_js(__('Embedded Form Shortcode:', 'the-optimize-code')); ?>' }}}</strong> {{{ shortcode }}}
                            </p>
                        </div>
                    <# } else { #>
                        <form class="contact-form" action="#" method="post">
                            <div class="form-field">
                                <label><?php esc_html_e('Your name', 'the-optimize-code'); ?></label>
                                <input placeholder="Alex Morgan">
                            </div>
                            <div class="form-field">
                                <label><?php esc_html_e('Email address', 'the-optimize-code'); ?></label>
                                <input type="email" placeholder="alex@example.com">
                            </div>
                            <div class="form-field">
                                <label><?php esc_html_e("I'm interested in", 'the-optimize-code'); ?></label>
                                <select>
                                    <option><?php esc_html_e('Podcast & education', 'the-optimize-code'); ?></option>
                                    <option><?php esc_html_e('Nutrigenomics / wellness testing', 'the-optimize-code'); ?></option>
                                </select>
                            </div>
                            <div class="form-submit">
                                <# if (submitNote) { #>
                                    <span class="form-submit__note">{{{ submitNote }}}</span>
                                <# } #>
                                <button class="btn btn--primary" type="button">{{{ buttonText }}}</button>
                            </div>
                        </form>
                    <# } #>
                </div>
            </div>
        </section>
        <?php
    }
}
