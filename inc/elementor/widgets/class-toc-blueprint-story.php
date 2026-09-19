<?php
/**
 * TOC Blueprint Story widget for Elementor Free.
 *
 * @package The_Optimize_Code
 */

if (!defined('ABSPATH')) {
    exit;
}

class TOC_Blueprint_Story_Widget extends \Elementor\Widget_Base
{
    /**
     * Get widget name.
     */
    public function get_name(): string
    {
        return 'toc-blueprint-story';
    }

    /**
     * Get widget title.
     */
    public function get_title(): string
    {
        return esc_html__('TOC Blueprint Story', 'the-optimize-code');
    }

    /**
     * Get widget icon.
     */
    public function get_icon(): string
    {
        return 'eicon-history';
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
        return ['blueprint', 'story', 'orbit', 'about', 'diagram', 'toc'];
    }

    /**
     * Register widget controls.
     */
    protected function register_controls(): void
    {
        // ==========================================
        // CONTENT TAB - STORY CONTENT
        // ==========================================
        $this->start_controls_section(
            'section_content_story',
            [
                'label' => esc_html__('Story Content', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_id',
            [
                'label'       => esc_html__('Section Anchor ID', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'blueprint',
                'description' => esc_html__('Target ID for navigation and jump links.', 'the-optimize-code'),
            ]
        );

        $this->add_control(
            'stamp',
            [
                'label'       => esc_html__('Badge / Stamp Text', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('The Optimize Blueprint', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'heading',
            [
                'label'       => esc_html__('Heading', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => __('Your data is a<br>starting point.<br><em>Not a verdict.</em>', 'the-optimize-code'),
                'rows'        => 3,
            ]
        );

        $this->add_control(
            'content',
            [
                'label'   => esc_html__('Paragraph Content', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('The Optimize Blueprint brings education, personal context and next-step questions into one understandable framework. It is designed to help you learn—not to diagnose, prescribe or replace care from a licensed professional.', 'the-optimize-code'),
                'rows'    => 4,
            ]
        );

        $this->add_control(
            'cta_text',
            [
                'label'   => esc_html__('Button Label', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Join the Blueprint waitlist →', 'the-optimize-code'),
            ]
        );

        $this->add_control(
            'cta_url',
            [
                'label'         => esc_html__('Button URL', 'the-optimize-code'),
                'type'          => \Elementor\Controls_Manager::URL,
                'show_external' => true,
                'default'       => [
                    'url'         => '#contact',
                    'is_external' => false,
                    'nofollow'    => false,
                ],
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB - VISUAL / MEDIA
        // ==========================================
        $this->start_controls_section(
            'section_content_media',
            [
                'label' => esc_html__('Visual & Orbit Art', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'media_mode',
            [
                'label'   => esc_html__('Visual Mode', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'orbit',
                'options' => [
                    'orbit' => esc_html__('Animated Orbit Diagram', 'the-optimize-code'),
                    'image' => esc_html__('Custom Image', 'the-optimize-code'),
                ],
            ]
        );

        $this->add_control(
            'orbit_core',
            [
                'label'       => esc_html__('Orbit Core Label', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'YOUR<br>CODE',
                'condition'   => ['media_mode' => 'orbit'],
                'description' => esc_html__('Center label inside the orbit visual.', 'the-optimize-code'),
            ]
        );

        $this->add_control(
            'orbit_label_1',
            [
                'label'     => esc_html__('Orbit Rotor 1 (Genes)', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => 'GENES',
                'condition' => ['media_mode' => 'orbit'],
            ]
        );

        $this->add_control(
            'orbit_label_2',
            [
                'label'     => esc_html__('Orbit Rotor 2 (Nutrition)', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => 'NUTRITION',
                'condition' => ['media_mode' => 'orbit'],
            ]
        );

        $this->add_control(
            'orbit_label_3',
            [
                'label'     => esc_html__('Orbit Rotor 3 (Lifestyle)', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => 'LIFESTYLE',
                'condition' => ['media_mode' => 'orbit'],
            ]
        );

        $this->add_control(
            'orbit_label_4',
            [
                'label'     => esc_html__('Orbit Rotor 4 (Context)', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => 'CONTEXT',
                'condition' => ['media_mode' => 'orbit'],
            ]
        );

        $this->add_control(
            'custom_image',
            [
                'label'       => esc_html__('Custom Image', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::MEDIA,
                'condition'   => ['media_mode' => 'image'],
                'description' => esc_html__('Image to display instead of the orbit diagram.', 'the-optimize-code'),
            ]
        );

        $this->add_control(
            'media_side',
            [
                'label'   => esc_html__('Media Position', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'right',
                'options' => [
                    'right' => esc_html__('Right', 'the-optimize-code'),
                    'left'  => esc_html__('Left', 'the-optimize-code'),
                ],
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB - COLORS
        // ==========================================
        $this->start_controls_section(
            'section_style_colors',
            [
                'label' => esc_html__('Colors & Spacing', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label'     => esc_html__('Section Background', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .story' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'stamp_color',
            [
                'label'     => esc_html__('Stamp Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .story__text .stamp' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label'     => esc_html__('Heading Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .story__text h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'accent_color',
            [
                'label'     => esc_html__('Accent (Emphasis) Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .story__text h2 em' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => esc_html__('Paragraph Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .story__text p' => 'color: {{VALUE}};',
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

        $section_id = toc_elementor_sanitize_id($settings['section_id'] ?? '', 'blueprint');
        $stamp      = !empty($settings['stamp']) ? trim($settings['stamp']) : '';
        $heading    = !empty($settings['heading']) ? trim($settings['heading']) : '';
        $content    = !empty($settings['content']) ? trim($settings['content']) : '';
        $cta_text   = !empty($settings['cta_text']) ? trim($settings['cta_text']) : '';
        $cta_url    = !empty($settings['cta_url']) ? $settings['cta_url'] : [];

        $media_mode   = !empty($settings['media_mode']) ? $settings['media_mode'] : 'orbit';
        $media_side   = !empty($settings['media_side']) ? $settings['media_side'] : 'right';
        $core_label   = !empty($settings['orbit_core']) ? trim($settings['orbit_core']) : 'YOUR<br>CODE';
        $orbit_1      = !empty($settings['orbit_label_1']) ? trim($settings['orbit_label_1']) : 'GENES';
        $orbit_2      = !empty($settings['orbit_label_2']) ? trim($settings['orbit_label_2']) : 'NUTRITION';
        $orbit_3      = !empty($settings['orbit_label_3']) ? trim($settings['orbit_label_3']) : 'LIFESTYLE';
        $orbit_4      = !empty($settings['orbit_label_4']) ? trim($settings['orbit_label_4']) : 'CONTEXT';
        $custom_image = !empty($settings['custom_image']) ? $settings['custom_image'] : [];

        $grid_style = 'left' === $media_side ? ' style="direction: rtl;"' : '';
        $text_style = 'left' === $media_side ? ' style="direction: ltr;"' : '';
        ?>
        <section class="story" id="<?php echo esc_attr($section_id); ?>">
            <div class="story__grid"<?php echo $grid_style; ?>>
                <div class="story__text reveal"<?php echo $text_style; ?>>
                    <?php if ($stamp) : ?>
                        <span class="stamp"><?php echo esc_html($stamp); ?></span>
                    <?php endif; ?>
                    <?php if ($heading) : ?>
                        <h2 class="display"><?php echo toc_elementor_kses_title($heading); ?></h2>
                    <?php endif; ?>
                    <?php if ($content) : ?>
                        <p><?php echo toc_elementor_kses_desc($content); ?></p>
                    <?php endif; ?>
                    <?php if ($cta_text && !empty($cta_url['url'])) : ?>
                        <a class="btn btn--primary" <?php echo toc_elementor_render_link_attrs($cta_url); ?>><?php echo esc_html($cta_text); ?></a>
                    <?php endif; ?>
                </div>

                <?php if ('image' === $media_mode && (!empty($custom_image['id']) || !empty($custom_image['url']))) : ?>
                    <div class="story__image-wrap reveal"<?php echo $text_style; ?>>
                        <?php echo toc_elementor_render_image($custom_image, 'full', ['class' => 'story__image', 'alt' => esc_attr($stamp ?: 'The Optimize Blueprint')]); ?>
                    </div>
                <?php else : ?>
                    <div class="blueprint-art reveal"<?php echo $text_style; ?>>
                        <div class="blueprint-art__system" aria-label="<?php esc_attr_e('Animated orbit diagram showing biological systems orbiting around personalized data', 'the-optimize-code'); ?>">
                            <span class="blueprint-art__core"><?php echo toc_elementor_kses_title($core_label); ?></span>
                            <?php if ($orbit_1) : ?>
                                <div class="blueprint-art__orbital blueprint-art__orbital--genes"><div class="blueprint-art__rotor"><i><?php echo esc_html($orbit_1); ?></i></div></div>
                            <?php endif; ?>
                            <?php if ($orbit_2) : ?>
                                <div class="blueprint-art__orbital blueprint-art__orbital--nutrition"><div class="blueprint-art__rotor"><i><?php echo esc_html($orbit_2); ?></i></div></div>
                            <?php endif; ?>
                            <?php if ($orbit_3) : ?>
                                <div class="blueprint-art__orbital blueprint-art__orbital--lifestyle"><div class="blueprint-art__rotor"><i><?php echo esc_html($orbit_3); ?></i></div></div>
                            <?php endif; ?>
                            <?php if ($orbit_4) : ?>
                                <div class="blueprint-art__orbital blueprint-art__orbital--context"><div class="blueprint-art__rotor"><i><?php echo esc_html($orbit_4); ?></i></div></div>
                            <?php endif; ?>
                        </div>
                    </div>
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
        var sectionId   = settings.section_id ? settings.section_id.trim() : 'blueprint';
        var stamp       = settings.stamp ? settings.stamp.trim() : '';
        var heading     = settings.heading ? settings.heading.trim() : '';
        var content     = settings.content ? settings.content.trim() : '';
        var ctaText     = settings.cta_text ? settings.cta_text.trim() : '';
        var ctaUrl      = settings.cta_url && settings.cta_url.url ? settings.cta_url.url : '';
        var mediaMode   = settings.media_mode || 'orbit';
        var mediaSide   = settings.media_side || 'right';
        var coreLabel   = settings.orbit_core ? settings.orbit_core.trim() : 'YOUR<br>CODE';
        var orbit1      = settings.orbit_label_1 ? settings.orbit_label_1.trim() : 'GENES';
        var orbit2      = settings.orbit_label_2 ? settings.orbit_label_2.trim() : 'NUTRITION';
        var orbit3      = settings.orbit_label_3 ? settings.orbit_label_3.trim() : 'LIFESTYLE';
        var orbit4      = settings.orbit_label_4 ? settings.orbit_label_4.trim() : 'CONTEXT';

        var gridStyle = mediaSide === 'left' ? ' style="direction: rtl;"' : '';
        var textStyle = mediaSide === 'left' ? ' style="direction: ltr;"' : '';
        #>
        <section class="story" id="{{ sectionId }}">
            <div class="story__grid"{{{ gridStyle }}}>
                <div class="story__text"{{{ textStyle }}}>
                    <# if (stamp) { #>
                        <span class="stamp">{{{ stamp }}}</span>
                    <# } #>
                    <# if (heading) { #>
                        <h2 class="display">{{{ heading }}}</h2>
                    <# } #>
                    <# if (content) { #>
                        <p>{{{ content }}}</p>
                    <# } #>
                    <# if (ctaText && ctaUrl) { #>
                        <a class="btn btn--primary" href="{{ ctaUrl }}">{{{ ctaText }}}</a>
                    <# } #>
                </div>

                <# if (mediaMode === 'image' && settings.custom_image && settings.custom_image.url) { #>
                    <div class="story__image-wrap"{{{ textStyle }}}>
                        <img src="{{ settings.custom_image.url }}" class="story__image" alt="{{ stamp }}" />
                    </div>
                <# } else { #>
                    <div class="blueprint-art"{{{ textStyle }}}>
                        <div class="blueprint-art__system">
                            <span class="blueprint-art__core">{{{ coreLabel }}}</span>
                            <# if (orbit1) { #>
                                <div class="blueprint-art__orbital blueprint-art__orbital--genes"><div class="blueprint-art__rotor"><i>{{{ orbit1 }}}</i></div></div>
                            <# } #>
                            <# if (orbit2) { #>
                                <div class="blueprint-art__orbital blueprint-art__orbital--nutrition"><div class="blueprint-art__rotor"><i>{{{ orbit2 }}}</i></div></div>
                            <# } #>
                            <# if (orbit3) { #>
                                <div class="blueprint-art__orbital blueprint-art__orbital--lifestyle"><div class="blueprint-art__rotor"><i>{{{ orbit3 }}}</i></div></div>
                            <# } #>
                            <# if (orbit4) { #>
                                <div class="blueprint-art__orbital blueprint-art__orbital--context"><div class="blueprint-art__rotor"><i>{{{ orbit4 }}}</i></div></div>
                            <# } #>
                        </div>
                    </div>
                <# } #>
            </div>
        </section>
        <?php
    }
}
