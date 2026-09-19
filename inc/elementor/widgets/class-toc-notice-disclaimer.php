<?php
/**
 * TOC Notice / Disclaimer widget for Elementor Free.
 *
 * @package The_Optimize_Code
 */

if (!defined('ABSPATH')) {
    exit;
}

class TOC_Notice_Disclaimer_Widget extends \Elementor\Widget_Base
{
    /**
     * Get widget name.
     */
    public function get_name(): string
    {
        return 'toc-notice-disclaimer';
    }

    /**
     * Get widget title.
     */
    public function get_title(): string
    {
        return esc_html__('TOC Notice / Disclaimer', 'the-optimize-code');
    }

    /**
     * Get widget icon.
     */
    public function get_icon(): string
    {
        return 'eicon-alert';
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
        return ['notice', 'disclaimer', 'legal', 'medical', 'toc'];
    }

    /**
     * Register widget controls.
     */
    protected function register_controls(): void
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Notice Content', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_id',
            [
                'label'       => esc_html__('Section Anchor ID', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => 'disclaimer',
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__('Notice Heading / Lead', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Educational use & important notice', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'text',
            [
                'label'       => esc_html__('Disclaimer Body', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__('The Optimize Code is a health education and personalized testing brand—not a medical clinic. Content and wellness results are for educational purposes and are not medical advice, diagnosis or treatment. PGx requests and results follow provider review; never start, stop or change medication without consulting a qualified clinician.', 'the-optimize-code'),
                'rows'        => 4,
                'description' => esc_html__('Important legal and educational disclaimer.', 'the-optimize-code'),
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
                    '{{WRAPPER}} .disclaimer' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label'     => esc_html__('Border Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .disclaimer' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'     => esc_html__('Text Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .disclaimer, {{WRAPPER}} .disclaimer p, {{WRAPPER}} .disclaimer strong' => 'color: {{VALUE}};',
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

        $section_id = !empty($settings['section_id']) ? toc_elementor_sanitize_id($settings['section_id']) : '';
        $title      = !empty($settings['title']) ? trim($settings['title']) : '';
        $text       = !empty($settings['text']) ? trim($settings['text']) : '';

        if (empty($title) && empty($text)) {
            toc_elementor_editor_empty_state($this->get_title());
            return;
        }

        $id_attr = $section_id ? ' id="' . esc_attr($section_id) . '"' : '';
        ?>
        <aside class="disclaimer" role="note"<?php echo $id_attr; ?>>
            <?php if ($title) : ?>
                <strong><?php echo esc_html($title); ?></strong>
            <?php endif; ?>
            <?php if ($text) : ?>
                <p><?php echo toc_elementor_kses_desc($text); ?></p>
            <?php endif; ?>
        </aside>
        <?php
    }

    /**
     * Render widget output in the editor (Underscore.js template).
     */
    protected function content_template(): void
    {
        ?>
        <#
        var sectionId = settings.section_id ? settings.section_id.trim() : '';
        var title     = settings.title ? settings.title.trim() : '';
        var text      = settings.text ? settings.text.trim() : '';
        var idAttr    = sectionId ? ' id="' + _.escape(sectionId) + '"' : '';
        #>
        <aside class="disclaimer" role="note"{{{ idAttr }}}>
            <# if (title) { #>
                <strong>{{{ title }}}</strong>
            <# } #>
            <# if (text) { #>
                <p>{{{ text }}}</p>
            <# } #>
        </aside>
        <?php
    }
}
