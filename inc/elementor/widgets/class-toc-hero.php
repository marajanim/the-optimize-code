<?php
/**
 * TOC Hero widget for Elementor Free.
 *
 * @package The_Optimize_Code
 */

if (!defined('ABSPATH')) {
    exit;
}

class TOC_Hero_Widget extends \Elementor\Widget_Base
{
    /**
     * Get widget name.
     */
    public function get_name(): string
    {
        return 'toc-hero';
    }

    /**
     * Get widget title.
     */
    public function get_title(): string
    {
        return esc_html__('TOC Hero', 'the-optimize-code');
    }

    /**
     * Get widget icon.
     */
    public function get_icon(): string
    {
        return 'eicon-banner';
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
        return ['hero', 'banner', 'home', 'kicker', 'toc', 'heading'];
    }

    /**
     * Register widget controls.
     */
    protected function register_controls(): void
    {
        // ==========================================
        // CONTENT TAB - SECTION & TEXT
        // ==========================================
        $this->start_controls_section(
            'section_content_text',
            [
                'label' => esc_html__('Hero Content', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_id',
            [
                'label'       => esc_html__('Section Anchor ID', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'home',
                'description' => esc_html__('Target ID for top navigation and jump links.', 'the-optimize-code'),
            ]
        );

        $this->add_control(
            'kicker_1',
            [
                'label'       => esc_html__('Kicker Left', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('[ PERSONALIZED HEALTH EDUCATION ]', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'kicker_2',
            [
                'label'       => esc_html__('Kicker Right', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('GENETICS · NUTRITION · LONGEVITY', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title_line_1',
            [
                'label'       => esc_html__('Title Line 1', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('YOUR HEALTH.', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title_line_2',
            [
                'label'       => esc_html__('Title Line 2 (Accent)', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('DECODED.', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description',
            [
                'label'       => esc_html__('Description', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Clear, grounded education at the intersection of your genes, nutrition, lifestyle and long-term wellbeing—without the clinic-speak.', 'the-optimize-code'),
                'rows'        => 3,
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB - CALLS TO ACTION
        // ==========================================
        $this->start_controls_section(
            'section_content_actions',
            [
                'label' => esc_html__('Call to Action Buttons', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'btn1_text',
            [
                'label'       => esc_html__('Primary Button Label', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Listen to the podcast →', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'btn1_url',
            [
                'label'         => esc_html__('Primary Button URL', 'the-optimize-code'),
                'type'          => \Elementor\Controls_Manager::URL,
                'show_external' => true,
                'default'       => [
                    'url'         => '#podcast',
                    'is_external' => false,
                    'nofollow'    => false,
                ],
            ]
        );

        $this->add_control(
            'btn2_text',
            [
                'label'       => esc_html__('Secondary Button Label', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Explore testing', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'btn2_url',
            [
                'label'         => esc_html__('Secondary Button URL', 'the-optimize-code'),
                'type'          => \Elementor\Controls_Manager::URL,
                'show_external' => true,
                'default'       => [
                    'url'         => toc_page_url('testing'),
                    'is_external' => false,
                    'nofollow'    => false,
                ],
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB - BACKGROUND & MEDIA
        // ==========================================
        $this->start_controls_section(
            'section_content_media',
            [
                'label' => esc_html__('Background & Media', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'label'       => esc_html__('Desktop Background Image', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::MEDIA,
                'description' => esc_html__('Leave empty to use the default theme hero image.', 'the-optimize-code'),
            ]
        );

        $this->add_control(
            'mobile_image',
            [
                'label'       => esc_html__('Mobile Background Image', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::MEDIA,
                'description' => esc_html__('Optional alternative crop for mobile devices.', 'the-optimize-code'),
            ]
        );

        $this->add_control(
            'image_alt',
            [
                'label'       => esc_html__('Image Accessibility Label', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Health educator recording a personalized wellness podcast in a modern studio', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'show_shade',
            [
                'label'        => esc_html__('Show Shade Overlay', 'the-optimize-code'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'show_grid',
            [
                'label'        => esc_html__('Show Blueprint Grid', 'the-optimize-code'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB - RAIL METADATA
        // ==========================================
        $this->start_controls_section(
            'section_content_rail',
            [
                'label' => esc_html__('Rail Metadata', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'rail_label_1',
            [
                'label'   => esc_html__('Rail Label 1', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('THE OPTIMIZE CODE / 001', 'the-optimize-code'),
            ]
        );

        $this->add_control(
            'rail_label_2',
            [
                'label'   => esc_html__('Rail Label 2', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('EDUCATION BEFORE ACTION', 'the-optimize-code'),
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB - LAYOUT & HEIGHT
        // ==========================================
        $this->start_controls_section(
            'section_style_layout',
            [
                'label' => esc_html__('Layout & Height', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'min_height',
            [
                'label'      => esc_html__('Minimum Height', 'the-optimize-code'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['vh', 'px'],
                'range'      => [
                    'vh' => [
                        'min' => 50,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 400,
                        'max' => 1200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .opt-hero' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_max_width',
            [
                'label'      => esc_html__('Content Max Width (px)', 'the-optimize-code'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 400,
                        'max'  => 1400,
                        'step' => 10,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .opt-hero__content' => 'width: min({{SIZE}}{{UNIT}}, 92%);',
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
                'label' => esc_html__('Colors', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'kicker_color',
            [
                'label'     => esc_html__('Kicker Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .opt-kicker' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Title Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .opt-hero h1' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'accent_color',
            [
                'label'     => esc_html__('Accent Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .opt-hero h1 .hero-title__line--accent' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .opt-hero h1 em' => 'color: {{VALUE}}; -webkit-text-stroke-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__('Description Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .opt-hero__content > p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'rail_color',
            [
                'label'     => esc_html__('Rail Metadata Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .opt-hero__rail' => 'color: {{VALUE}};',
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

        $section_id   = toc_elementor_sanitize_id($settings['section_id'] ?? '', 'home');
        $kicker_1     = !empty($settings['kicker_1']) ? trim($settings['kicker_1']) : '';
        $kicker_2     = !empty($settings['kicker_2']) ? trim($settings['kicker_2']) : '';
        $title_line_1 = !empty($settings['title_line_1']) ? trim($settings['title_line_1']) : '';
        $title_line_2 = !empty($settings['title_line_2']) ? trim($settings['title_line_2']) : '';
        $description  = !empty($settings['description']) ? trim($settings['description']) : '';
        $image_alt    = !empty($settings['image_alt']) ? trim($settings['image_alt']) : '';
        $show_shade   = !empty($settings['show_shade']) && 'yes' === $settings['show_shade'];
        $show_grid    = !empty($settings['show_grid']) && 'yes' === $settings['show_grid'];

        $btn1_text    = !empty($settings['btn1_text']) ? trim($settings['btn1_text']) : '';
        $btn1_url     = !empty($settings['btn1_url']) ? $settings['btn1_url'] : [];
        $btn2_text    = !empty($settings['btn2_text']) ? trim($settings['btn2_text']) : '';
        $btn2_url     = !empty($settings['btn2_url']) ? $settings['btn2_url'] : [];

        $rail_label_1 = !empty($settings['rail_label_1']) ? trim($settings['rail_label_1']) : '';
        $rail_label_2 = !empty($settings['rail_label_2']) ? trim($settings['rail_label_2']) : '';

        // Custom background style if editor uploaded a custom image
        $bg_image_url = !empty($settings['bg_image']['url']) ? esc_url($settings['bg_image']['url']) : '';
        $custom_bg_style = $bg_image_url ? ' style="background-image:url(' . $bg_image_url . ');"' : '';

        $title_id = $section_id . '-title';
        ?>
        <section class="opt-hero" id="<?php echo esc_attr($section_id); ?>" aria-labelledby="<?php echo esc_attr($title_id); ?>">
            <div class="opt-hero__image" role="img" aria-label="<?php echo esc_attr($image_alt); ?>"<?php echo $custom_bg_style; ?>></div>
            <?php if ($show_shade) : ?>
                <div class="opt-hero__shade"></div>
            <?php endif; ?>
            <?php if ($show_grid) : ?>
                <div class="opt-hero__grid"></div>
            <?php endif; ?>
            <div class="opt-hero__content">
                <?php if ($kicker_1 || $kicker_2) : ?>
                    <div class="opt-kicker">
                        <?php if ($kicker_1) : ?><span><?php echo esc_html($kicker_1); ?></span><?php endif; ?>
                        <?php if ($kicker_2) : ?><span><?php echo esc_html($kicker_2); ?></span><?php endif; ?>
                    </div>
                <?php endif; ?>
                <h1 id="<?php echo esc_attr($title_id); ?>">
                    <?php if ($title_line_1) : ?>
                        <span class="hero-title__line"><?php echo esc_html($title_line_1); ?></span>
                    <?php endif; ?>
                    <?php if ($title_line_2) : ?>
                        <span class="hero-title__line hero-title__line--accent"><?php echo esc_html($title_line_2); ?></span>
                    <?php endif; ?>
                </h1>
                <?php if ($description) : ?>
                    <p><?php echo toc_elementor_kses_desc($description); ?></p>
                <?php endif; ?>
                <?php if (($btn1_text && !empty($btn1_url['url'])) || ($btn2_text && !empty($btn2_url['url']))) : ?>
                    <div class="opt-hero__actions">
                        <?php if ($btn1_text && !empty($btn1_url['url'])) : ?>
                            <a class="btn btn--primary" <?php echo toc_elementor_render_link_attrs($btn1_url); ?>><?php echo esc_html($btn1_text); ?></a>
                        <?php endif; ?>
                        <?php if ($btn2_text && !empty($btn2_url['url'])) : ?>
                            <a class="btn" <?php echo toc_elementor_render_link_attrs($btn2_url); ?>><?php echo esc_html($btn2_text); ?></a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ($rail_label_1 || $rail_label_2) : ?>
                <div class="opt-hero__rail">
                    <?php if ($rail_label_1) : ?><span><?php echo esc_html($rail_label_1); ?></span><?php endif; ?>
                    <?php if ($rail_label_2) : ?><span><?php echo esc_html($rail_label_2); ?></span><?php endif; ?>
                </div>
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
        var sectionId   = settings.section_id ? settings.section_id.trim() : 'home';
        var kicker1     = settings.kicker_1 ? settings.kicker_1.trim() : '';
        var kicker2     = settings.kicker_2 ? settings.kicker_2.trim() : '';
        var titleLine1  = settings.title_line_1 ? settings.title_line_1.trim() : '';
        var titleLine2  = settings.title_line_2 ? settings.title_line_2.trim() : '';
        var description = settings.description ? settings.description.trim() : '';
        var imageAlt    = settings.image_alt ? settings.image_alt.trim() : '';
        var showShade   = settings.show_shade === 'yes';
        var showGrid    = settings.show_grid === 'yes';

        var btn1Text = settings.btn1_text ? settings.btn1_text.trim() : '';
        var btn1Url  = settings.btn1_url && settings.btn1_url.url ? settings.btn1_url.url : '';
        var btn2Text = settings.btn2_text ? settings.btn2_text.trim() : '';
        var btn2Url  = settings.btn2_url && settings.btn2_url.url ? settings.btn2_url.url : '';

        var railLabel1 = settings.rail_label_1 ? settings.rail_label_1.trim() : '';
        var railLabel2 = settings.rail_label_2 ? settings.rail_label_2.trim() : '';

        var bgStyle = '';
        if (settings.bg_image && settings.bg_image.url) {
            bgStyle = ' style="background-image:url(' + _.escape(settings.bg_image.url) + ');"';
        }

        var titleId = sectionId + '-title';
        #>
        <section class="opt-hero" id="{{ sectionId }}" aria-labelledby="{{ titleId }}">
            <div class="opt-hero__image" role="img" aria-label="{{ imageAlt }}"{{{ bgStyle }}}></div>
            <# if (showShade) { #>
                <div class="opt-hero__shade"></div>
            <# } #>
            <# if (showGrid) { #>
                <div class="opt-hero__grid"></div>
            <# } #>
            <div class="opt-hero__content">
                <# if (kicker1 || kicker2) { #>
                    <div class="opt-kicker">
                        <# if (kicker1) { #><span>{{{ kicker1 }}}</span><# } #>
                        <# if (kicker2) { #><span>{{{ kicker2 }}}</span><# } #>
                    </div>
                <# } #>
                <h1 id="{{ titleId }}">
                    <# if (titleLine1) { #>
                        <span class="hero-title__line">{{{ titleLine1 }}}</span>
                    <# } #>
                    <# if (titleLine2) { #>
                        <span class="hero-title__line hero-title__line--accent">{{{ titleLine2 }}}</span>
                    <# } #>
                </h1>
                <# if (description) { #>
                    <p>{{{ description }}}</p>
                <# } #>
                <# if ((btn1Text && btn1Url) || (btn2Text && btn2Url)) { #>
                    <div class="opt-hero__actions">
                        <# if (btn1Text && btn1Url) { #>
                            <a class="btn btn--primary" href="{{ btn1Url }}">{{{ btn1Text }}}</a>
                        <# } #>
                        <# if (btn2Text && btn2Url) { #>
                            <a class="btn" href="{{ btn2Url }}">{{{ btn2Text }}}</a>
                        <# } #>
                    </div>
                <# } #>
            </div>
            <# if (railLabel1 || railLabel2) { #>
                <div class="opt-hero__rail">
                    <# if (railLabel1) { #><span>{{{ railLabel1 }}}</span><# } #>
                    <# if (railLabel2) { #><span>{{{ railLabel2 }}}</span><# } #>
                </div>
            <# } #>
        </section>
        <?php
    }
}
