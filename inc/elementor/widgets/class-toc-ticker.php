<?php
/**
 * TOC Ticker widget for Elementor Free.
 *
 * @package The_Optimize_Code
 */

if (!defined('ABSPATH')) {
    exit;
}

class TOC_Ticker_Widget extends \Elementor\Widget_Base
{
    /**
     * Get widget name.
     */
    public function get_name(): string
    {
        return 'toc-ticker';
    }

    /**
     * Get widget title.
     */
    public function get_title(): string
    {
        return esc_html__('TOC Ticker', 'the-optimize-code');
    }

    /**
     * Get widget icon.
     */
    public function get_icon(): string
    {
        return 'eicon-animation';
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
        return ['ticker', 'marquee', 'banner', 'scroll', 'animation', 'toc'];
    }

    /**
     * Register widget controls.
     */
    protected function register_controls(): void
    {
        // ==========================================
        // CONTENT TAB - ITEMS
        // ==========================================
        $this->start_controls_section(
            'section_content_items',
            [
                'label' => esc_html__('Ticker Items', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'text',
            [
                'label'       => esc_html__('Item Text', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Know your code', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'items',
            [
                'label'       => esc_html__('Items', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    ['text' => esc_html__('Know your code', 'the-optimize-code')],
                    ['text' => esc_html__('Ask better questions', 'the-optimize-code')],
                    ['text' => esc_html__('Build better habits', 'the-optimize-code')],
                    ['text' => esc_html__('Live with intention', 'the-optimize-code')],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->add_control(
            'separator',
            [
                'label'   => esc_html__('Separator Character', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => '+',
                'options' => [
                    '+'    => '+ (Medical plus)',
                    '·'    => '· (Middle dot)',
                    '*'    => '* (Star)',
                    '/'    => '/ (Slash)',
                    '-'    => '- (Dash)',
                    'none' => esc_html__('None', 'the-optimize-code'),
                ],
            ]
        );

        $this->add_control(
            'anchor_id',
            [
                'label'       => esc_html__('Section Anchor ID', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => 'ticker',
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB - ANIMATION & SETTINGS
        // ==========================================
        $this->start_controls_section(
            'section_content_animation',
            [
                'label' => esc_html__('Animation & Settings', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'speed',
            [
                'label'      => esc_html__('Scroll Speed (seconds)', 'the-optimize-code'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['s'],
                'range'      => [
                    's' => [
                        'min'  => 10,
                        'max'  => 120,
                        'step' => 2,
                    ],
                ],
                'default'    => [
                    'unit' => 's',
                    'size' => 36,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .ticker__track' => 'animation-duration: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'direction',
            [
                'label'     => esc_html__('Direction', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'normal',
                'options'   => [
                    'normal'  => esc_html__('Left (Normal)', 'the-optimize-code'),
                    'reverse' => esc_html__('Right (Reverse)', 'the-optimize-code'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .ticker__track' => 'animation-direction: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label'        => esc_html__('Pause on Hover', 'the-optimize-code'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
                'selectors'    => [
                    '{{WRAPPER}} .ticker:hover .ticker__track' => 'animation-play-state: paused;',
                ],
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB - COLORS & PADDING
        // ==========================================
        $this->start_controls_section(
            'section_style_design',
            [
                'label' => esc_html__('Colors & Spacing', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label'     => esc_html__('Background Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ticker' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'     => esc_html__('Text Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ticker, {{WRAPPER}} .ticker__track' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sep_color',
            [
                'label'     => esc_html__('Separator Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ticker .sep' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding_vertical',
            [
                'label'      => esc_html__('Vertical Padding (px)', 'the-optimize-code'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 8,
                        'max'  => 60,
                        'step' => 2,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .ticker' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
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

        $items     = !empty($settings['items']) && is_array($settings['items']) ? $settings['items'] : [];
        $separator = !empty($settings['separator']) ? $settings['separator'] : '+';
        $anchor_id = !empty($settings['anchor_id']) ? toc_elementor_sanitize_id($settings['anchor_id']) : '';

        if (empty($items)) {
            toc_elementor_editor_empty_state($this->get_title());
            return;
        }

        $id_attr = $anchor_id ? ' id="' . esc_attr($anchor_id) . '"' : '';

        // Double the list to maintain a continuous, seamless infinite loop
        $repeated_items = array_merge($items, $items);
        ?>
        <div class="ticker toc-ticker" role="region" aria-label="<?php esc_attr_e('Announcements ticker', 'the-optimize-code'); ?>"<?php echo $id_attr; ?>>
            <div class="ticker__track" aria-hidden="true">
                <?php foreach ($repeated_items as $item) : ?>
                    <?php
                    $item_text = !empty($item['text']) ? trim($item['text']) : '';
                    if (!$item_text) {
                        continue;
                    }
                    ?>
                    <span><?php echo esc_html($item_text); ?></span>
                    <?php if ('none' !== $separator) : ?>
                        <span class="sep" aria-hidden="true"><?php echo esc_html($separator); ?></span>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="screen-reader-text">
                <ul>
                    <?php foreach ($items as $item) : ?>
                        <?php if (!empty($item['text'])) : ?>
                            <li><?php echo esc_html(trim($item['text'])); ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php
    }

    /**
     * Render widget output in the editor (Underscore.js template).
     */
    protected function content_template(): void
    {
        ?>
        <#
        var items = settings.items || [];
        var separator = settings.separator || '+';
        var anchorId = settings.anchor_id ? settings.anchor_id.trim() : '';

        if (!items.length) {
            #>
            <div class="toc-elementor-empty-state" style="padding: 20px; border: 1px dashed var(--line, #26322c); text-align: center;">
                <p style="font-size: 13px; font-weight: 600; color: var(--sky, #edf4ef); margin-bottom: 4px;">
                    {{{ '<?php echo esc_js(__('TOC Ticker', 'the-optimize-code')); ?>' }}}
                </p>
                <p style="font-size: 12px; color: var(--body, #a9b6af); margin: 0;">
                    {{{ '<?php echo esc_js(__('Add items to the ticker in the panel.', 'the-optimize-code')); ?>' }}}
                </p>
            </div>
            <#
            return;
        }

        var idAttr = anchorId ? ' id="' + _.escape(anchorId) + '"' : '';
        var repeated = items.concat(items);
        #>
        <div class="ticker toc-ticker" aria-hidden="true"{{{ idAttr }}}>
            <div class="ticker__track">
                <# _.each(repeated, function(item) {
                    if (!item.text) { return; }
                #>
                    <span>{{{ item.text }}}</span>
                    <# if (separator !== 'none') { #>
                        <span class="sep">{{{ separator }}}</span>
                    <# } #>
                <# }); #>
            </div>
        </div>
        <?php
    }
}
