<?php
/**
 * TOC Gallery Hero widget for Elementor Free.
 *
 * @package The_Optimize_Code
 */

if (!defined('ABSPATH')) {
    exit;
}

class TOC_Gallery_Hero_Widget extends \Elementor\Widget_Base
{
    /**
     * Get widget name.
     */
    public function get_name(): string
    {
        return 'toc-gallery-hero';
    }

    /**
     * Get widget title.
     */
    public function get_title(): string
    {
        return esc_html__('TOC Gallery Hero', 'the-optimize-code');
    }

    /**
     * Get widget icon.
     */
    public function get_icon(): string
    {
        return 'eicon-image-bold';
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
        return ['gallery', 'hero', 'archive', 'photos', 'toc'];
    }

    /**
     * Register widget controls.
     */
    protected function register_controls(): void
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Gallery Hero Content', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_id',
            [
                'label'   => esc_html__('Section Anchor ID', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'gallery-hero',
            ]
        );

        $this->add_control(
            'eyebrow',
            [
                'label'       => esc_html__('Eyebrow', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Visual archive · People, places, conversations', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'   => esc_html__('Title', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('IN THE ROOM.<br><em>OUT IN THE WORLD.</em>', 'the-optimize-code'),
                'rows'    => 2,
            ]
        );

        $this->add_control(
            'description',
            [
                'label'   => esc_html__('Description', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('A collection of conversations, stages, adventures and moments behind The Optimize Code.', 'the-optimize-code'),
                'rows'    => 3,
            ]
        );

        $this->add_control(
            'meta_text',
            [
                'label'       => esc_html__('Meta Info Line', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('18 photographs · Updated 2026', 'the-optimize-code'),
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
                    '{{WRAPPER}} .gallery-hero' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Title Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gallery-hero h1' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'accent_color',
            [
                'label'     => esc_html__('Accent Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gallery-hero h1 em' => 'color: {{VALUE}};',
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

        $section_id  = toc_elementor_sanitize_id($settings['section_id'] ?? '', 'gallery-hero');
        $eyebrow     = !empty($settings['eyebrow']) ? trim($settings['eyebrow']) : '';
        $title       = !empty($settings['title']) ? trim($settings['title']) : '';
        $description = !empty($settings['description']) ? trim($settings['description']) : '';
        $meta_text   = !empty($settings['meta_text']) ? trim($settings['meta_text']) : '';

        if (empty($title) && empty($description)) {
            toc_elementor_editor_empty_state($this->get_title());
            return;
        }
        ?>
        <section class="gallery-hero" id="<?php echo esc_attr($section_id); ?>">
            <?php if ($eyebrow) : ?>
                <span class="feature__eyebrow"><?php echo esc_html($eyebrow); ?></span>
            <?php endif; ?>
            <?php if ($title) : ?>
                <h1><?php echo toc_elementor_kses_title($title); ?></h1>
            <?php endif; ?>
            <div class="gallery-hero__meta">
                <?php if ($description) : ?>
                    <p><?php echo toc_elementor_kses_desc($description); ?></p>
                <?php endif; ?>
                <?php if ($meta_text) : ?>
                    <span><?php echo esc_html($meta_text); ?></span>
                <?php endif; ?>
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
        var sectionId   = settings.section_id ? settings.section_id.trim() : 'gallery-hero';
        var eyebrow     = settings.eyebrow ? settings.eyebrow.trim() : '';
        var title       = settings.title ? settings.title.trim() : '';
        var description = settings.description ? settings.description.trim() : '';
        var metaText    = settings.meta_text ? settings.meta_text.trim() : '';
        #>
        <section class="gallery-hero" id="{{ sectionId }}">
            <# if (eyebrow) { #>
                <span class="feature__eyebrow">{{{ eyebrow }}}</span>
            <# } #>
            <# if (title) { #>
                <h1>{{{ title }}}</h1>
            <# } #>
            <div class="gallery-hero__meta">
                <# if (description) { #>
                    <p>{{{ description }}}</p>
                <# } #>
                <# if (metaText) { #>
                    <span>{{{ metaText }}}</span>
                <# } #>
            </div>
        </section>
        <?php
    }
}
