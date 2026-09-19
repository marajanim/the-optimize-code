<?php
/**
 * TOC Testing Hero widget for Elementor Free.
 *
 * @package The_Optimize_Code
 */

if (!defined('ABSPATH')) {
    exit;
}

class TOC_Testing_Hero_Widget extends \Elementor\Widget_Base
{
    /**
     * Get widget name.
     */
    public function get_name(): string
    {
        return 'toc-testing-hero';
    }

    /**
     * Get widget title.
     */
    public function get_title(): string
    {
        return esc_html__('TOC Testing Hero', 'the-optimize-code');
    }

    /**
     * Get widget icon.
     */
    public function get_icon(): string
    {
        return 'eicon-header';
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
        return ['testing', 'hero', 'banner', 'pathways', 'toc'];
    }

    /**
     * Register widget controls.
     */
    protected function register_controls(): void
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Hero Content', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_id',
            [
                'label'   => esc_html__('Section Anchor ID', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'testing-hero',
            ]
        );

        $this->add_control(
            'eyebrow',
            [
                'label'       => esc_html__('Eyebrow', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Personalized testing · Education before action', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__('Title', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => __('THE RIGHT TEST.<br><em>THE RIGHT PATH.</em>', 'the-optimize-code'),
                'rows'        => 2,
            ]
        );

        $this->add_control(
            'intro',
            [
                'label'   => esc_html__('Intro Paragraph', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Testing should create useful context—not confusion. Explore two clearly separated pathways designed around the type of information each test provides.', 'the-optimize-code'),
                'rows'    => 3,
            ]
        );

        $this->add_control(
            'cta_text',
            [
                'label'   => esc_html__('CTA Button Label', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Compare pathways →', 'the-optimize-code'),
            ]
        );

        $this->add_control(
            'cta_url',
            [
                'label'         => esc_html__('CTA Button URL', 'the-optimize-code'),
                'type'          => \Elementor\Controls_Manager::URL,
                'show_external' => true,
                'default'       => [
                    'url'         => '#testing-options',
                    'is_external' => false,
                    'nofollow'    => false,
                ],
            ]
        );

        $this->end_controls_section();

        // Style section
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
                    '{{WRAPPER}} .testing-hero' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Title Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testing-hero h1' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'accent_color',
            [
                'label'     => esc_html__('Accent Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testing-hero h1 em' => 'color: {{VALUE}};',
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

        $section_id = toc_elementor_sanitize_id($settings['section_id'] ?? '', 'testing-hero');
        $eyebrow    = !empty($settings['eyebrow']) ? trim($settings['eyebrow']) : '';
        $title      = !empty($settings['title']) ? trim($settings['title']) : '';
        $intro      = !empty($settings['intro']) ? trim($settings['intro']) : '';
        $cta_text   = !empty($settings['cta_text']) ? trim($settings['cta_text']) : '';
        $cta_url    = !empty($settings['cta_url']) ? $settings['cta_url'] : [];

        if (empty($title) && empty($intro)) {
            toc_elementor_editor_empty_state($this->get_title());
            return;
        }
        ?>
        <section class="testing-hero" id="<?php echo esc_attr($section_id); ?>">
            <div class="testing-hero__inner">
                <?php if ($eyebrow) : ?>
                    <span class="feature__eyebrow"><?php echo esc_html($eyebrow); ?></span>
                <?php endif; ?>
                <?php if ($title) : ?>
                    <h1><?php echo toc_elementor_kses_title($title); ?></h1>
                <?php endif; ?>
                <div class="testing-hero__intro">
                    <?php if ($intro) : ?>
                        <p><?php echo toc_elementor_kses_desc($intro); ?></p>
                    <?php endif; ?>
                    <?php if ($cta_text && !empty($cta_url['url'])) : ?>
                        <a class="btn btn--primary" <?php echo toc_elementor_render_link_attrs($cta_url); ?>><?php echo esc_html($cta_text); ?></a>
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
        var sectionId = settings.section_id ? settings.section_id.trim() : 'testing-hero';
        var eyebrow   = settings.eyebrow ? settings.eyebrow.trim() : '';
        var title     = settings.title ? settings.title.trim() : '';
        var intro     = settings.intro ? settings.intro.trim() : '';
        var ctaText   = settings.cta_text ? settings.cta_text.trim() : '';
        var ctaUrl    = settings.cta_url && settings.cta_url.url ? settings.cta_url.url : '';
        #>
        <section class="testing-hero" id="{{ sectionId }}">
            <div class="testing-hero__inner">
                <# if (eyebrow) { #>
                    <span class="feature__eyebrow">{{{ eyebrow }}}</span>
                <# } #>
                <# if (title) { #>
                    <h1>{{{ title }}}</h1>
                <# } #>
                <div class="testing-hero__intro">
                    <# if (intro) { #>
                        <p>{{{ intro }}}</p>
                    <# } #>
                    <# if (ctaText && ctaUrl) { #>
                        <a class="btn btn--primary" href="{{ ctaUrl }}">{{{ ctaText }}}</a>
                    <# } #>
                </div>
            </div>
        </section>
        <?php
    }
}
