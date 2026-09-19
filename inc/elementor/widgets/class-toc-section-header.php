<?php
/**
 * TOC Section Header widget for Elementor Free.
 *
 * @package The_Optimize_Code
 */

if (!defined('ABSPATH')) {
    exit;
}

class TOC_Section_Header_Widget extends \Elementor\Widget_Base
{
    /**
     * Get widget name.
     */
    public function get_name(): string
    {
        return 'toc-section-header';
    }

    /**
     * Get widget title.
     */
    public function get_title(): string
    {
        return esc_html__('TOC Section Header', 'the-optimize-code');
    }

    /**
     * Get widget icon.
     */
    public function get_icon(): string
    {
        return 'eicon-heading';
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
        return ['header', 'heading', 'eyebrow', 'title', 'section', 'toc'];
    }

    /**
     * Register widget controls.
     */
    protected function register_controls(): void
    {
        // ==========================================
        // CONTENT TAB - HEADER
        // ==========================================
        $this->start_controls_section(
            'section_content_header',
            [
                'label' => esc_html__('Header Content', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'layout_style',
            [
                'label'   => esc_html__('Layout Style', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'split',
                'options' => [
                    'split'   => esc_html__('Split (Link on Right / feature__head)', 'the-optimize-code'),
                    'stacked' => esc_html__('Stacked (Description below / receipts__head)', 'the-optimize-code'),
                ],
            ]
        );

        $this->add_control(
            'eyebrow',
            [
                'label'       => esc_html__('Eyebrow', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('The Optimize Code · Signal', 'the-optimize-code'),
                'placeholder' => esc_html__('Category or section kicker', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__('Title', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => __('Science you can use.<br>Conversations worth keeping.', 'the-optimize-code'),
                'placeholder' => esc_html__('Main section title. <br> and <em> allowed.', 'the-optimize-code'),
                'rows'        => 3,
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'   => esc_html__('Title HTML Tag', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1'   => 'H1',
                    'h2'   => 'H2',
                    'h3'   => 'H3',
                    'h4'   => 'H4',
                    'h5'   => 'H5',
                    'h6'   => 'H6',
                    'div'  => 'div',
                    'p'    => 'p',
                ],
            ]
        );

        $this->add_control(
            'description',
            [
                'label'       => esc_html__('Description', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => '',
                'placeholder' => esc_html__('Optional supporting paragraph text', 'the-optimize-code'),
                'rows'        => 3,
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB - ACTION LINK
        // ==========================================
        $this->start_controls_section(
            'section_content_link',
            [
                'label' => esc_html__('Action Link', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'link_text',
            [
                'label'       => esc_html__('Link Label', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Browse episodes →', 'the-optimize-code'),
                'placeholder' => esc_html__('e.g. View all →', 'the-optimize-code'),
            ]
        );

        $this->add_control(
            'link_url',
            [
                'label'         => esc_html__('Link URL', 'the-optimize-code'),
                'type'          => \Elementor\Controls_Manager::URL,
                'placeholder'   => esc_html__('https://your-link.com or #anchor', 'the-optimize-code'),
                'show_external' => true,
                'default'       => [
                    'url'         => '#episodes',
                    'is_external' => false,
                    'nofollow'    => false,
                ],
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB - LAYOUT & SPACING
        // ==========================================
        $this->start_controls_section(
            'section_style_layout',
            [
                'label' => esc_html__('Layout & Alignment', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label'   => esc_html__('Alignment', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left'   => [
                        'title' => esc_html__('Left', 'the-optimize-code'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'the-optimize-code'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'the-optimize-code'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'left',
                'selectors' => [
                    '{{WRAPPER}} .toc-section-header' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_max_width',
            [
                'label'      => esc_html__('Title Max Width (px)', 'the-optimize-code'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 200,
                        'max'  => 1400,
                        'step' => 10,
                    ],
                    '%'  => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .toc-section-header h1, {{WRAPPER}} .toc-section-header h2, {{WRAPPER}} .toc-section-header h3' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'bottom_margin',
            [
                'label'      => esc_html__('Bottom Margin (px)', 'the-optimize-code'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 120,
                        'step' => 2,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .toc-section-header' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
            'eyebrow_color',
            [
                'label'     => esc_html__('Eyebrow Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feature__eyebrow' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .feature__eyebrow::before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Title Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .toc-section-header .display, {{WRAPPER}} .toc-section-header h1, {{WRAPPER}} .toc-section-header h2, {{WRAPPER}} .toc-section-header h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__('Description Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .toc-section-header p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'link_color',
            [
                'label'     => esc_html__('Link Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feature__cta-link' => 'color: {{VALUE}};',
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

        $eyebrow     = !empty($settings['eyebrow']) ? trim($settings['eyebrow']) : '';
        $title       = !empty($settings['title']) ? trim($settings['title']) : '';
        $description = !empty($settings['description']) ? trim($settings['description']) : '';
        $link_text   = !empty($settings['link_text']) ? trim($settings['link_text']) : '';
        $link_url    = !empty($settings['link_url']) ? $settings['link_url'] : [];
        $layout      = !empty($settings['layout_style']) ? $settings['layout_style'] : 'split';
        $title_tag   = toc_elementor_validate_tag($settings['title_tag'] ?? 'h2', 'h2');

        if (empty($eyebrow) && empty($title) && empty($description) && empty($link_text)) {
            toc_elementor_editor_empty_state($this->get_title());
            return;
        }

        $link_attrs = toc_elementor_render_link_attrs($link_url);
        $has_link   = !empty($link_text) && !empty($link_url['url']);

        if ('split' === $layout) {
            ?>
            <div class="feature__head toc-section-header toc-section-header--split">
                <div>
                    <?php if ($eyebrow) : ?>
                        <span class="feature__eyebrow"><?php echo esc_html($eyebrow); ?></span>
                    <?php endif; ?>
                    <?php if ($title) : ?>
                        <<?php echo $title_tag; ?> class="display"><?php echo toc_elementor_kses_title($title); ?></<?php echo $title_tag; ?>>
                    <?php endif; ?>
                    <?php if ($description) : ?>
                        <p class="toc-section-header__desc"><?php echo toc_elementor_kses_desc($description); ?></p>
                    <?php endif; ?>
                </div>
                <?php if ($has_link) : ?>
                    <a class="feature__cta-link" <?php echo $link_attrs; ?>><?php echo esc_html($link_text); ?></a>
                <?php endif; ?>
            </div>
            <?php
        } else {
            ?>
            <div class="receipts__head toc-section-header toc-section-header--stacked">
                <?php if ($eyebrow) : ?>
                    <span class="feature__eyebrow"><?php echo esc_html($eyebrow); ?></span>
                <?php endif; ?>
                <?php if ($title) : ?>
                    <<?php echo $title_tag; ?> class="display"><?php echo toc_elementor_kses_title($title); ?></<?php echo $title_tag; ?>>
                <?php endif; ?>
                <?php if ($description) : ?>
                    <p><?php echo toc_elementor_kses_desc($description); ?></p>
                <?php endif; ?>
                <?php if ($has_link) : ?>
                    <a class="feature__cta-link" <?php echo $link_attrs; ?>><?php echo esc_html($link_text); ?></a>
                <?php endif; ?>
            </div>
            <?php
        }
    }

    /**
     * Render widget output in the editor (Underscore.js template).
     */
    protected function content_template(): void
    {
        ?>
        <#
        var eyebrow     = settings.eyebrow ? settings.eyebrow.trim() : '';
        var title       = settings.title ? settings.title.trim() : '';
        var description = settings.description ? settings.description.trim() : '';
        var linkText    = settings.link_text ? settings.link_text.trim() : '';
        var linkUrl     = settings.link_url && settings.link_url.url ? settings.link_url.url : '';
        var layout      = settings.layout_style || 'split';
        var titleTag    = settings.title_tag || 'h2';

        if (!eyebrow && !title && !description && !linkText) {
            #>
            <div class="toc-elementor-empty-state" style="padding: 30px; border: 1px dashed var(--line, #26322c); text-align: center; background: rgba(255,255,255,0.03); border-radius: 4px; margin: 10px 0;">
                <p style="font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--sky, #edf4ef); margin-bottom: 6px;">
                    {{{ '<?php echo esc_js(__('TOC Section Header', 'the-optimize-code')); ?>' }}}
                </p>
                <p style="font-size: 12px; color: var(--body, #a9b6af); margin: 0;">
                    {{{ '<?php echo esc_js(__('Configure this section header in the Elementor panel.', 'the-optimize-code')); ?>' }}}
                </p>
            </div>
            <#
            return;
        }

        var linkAttrs = 'href="' + _.escape(linkUrl) + '"';
        if (settings.link_url && settings.link_url.is_external) {
            linkAttrs += ' target="_blank" rel="noopener noreferrer"';
        }
        var hasLink = linkText && linkUrl;

        if (layout === 'split') {
            #>
            <div class="feature__head toc-section-header toc-section-header--split">
                <div>
                    <# if (eyebrow) { #>
                        <span class="feature__eyebrow">{{{ eyebrow }}}</span>
                    <# } #>
                    <# if (title) { #>
                        <{{ titleTag }} class="display">{{{ title }}}</{{ titleTag }}>
                    <# } #>
                    <# if (description) { #>
                        <p class="toc-section-header__desc">{{{ description }}}</p>
                    <# } #>
                </div>
                <# if (hasLink) { #>
                    <a class="feature__cta-link" {{{ linkAttrs }}}>{{{ linkText }}}</a>
                <# } #>
            </div>
            <#
        } else {
            #>
            <div class="receipts__head toc-section-header toc-section-header--stacked">
                <# if (eyebrow) { #>
                    <span class="feature__eyebrow">{{{ eyebrow }}}</span>
                <# } #>
                <# if (title) { #>
                    <{{ titleTag }} class="display">{{{ title }}}</{{ titleTag }}>
                <# } #>
                <# if (description) { #>
                    <p>{{{ description }}}</p>
                <# } #>
                <# if (hasLink) { #>
                    <a class="feature__cta-link" {{{ linkAttrs }}}>{{{ linkText }}}</a>
                <# } #>
            </div>
            <#
        }
        #>
        <?php
    }
}
