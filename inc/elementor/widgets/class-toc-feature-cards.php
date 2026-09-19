<?php
/**
 * TOC Feature Cards widget for Elementor Free.
 *
 * @package The_Optimize_Code
 */

if (!defined('ABSPATH')) {
    exit;
}

class TOC_Feature_Cards_Widget extends \Elementor\Widget_Base
{
    /**
     * Get widget name.
     */
    public function get_name(): string
    {
        return 'toc-feature-cards';
    }

    /**
     * Get widget title.
     */
    public function get_title(): string
    {
        return esc_html__('TOC Feature Cards', 'the-optimize-code');
    }

    /**
     * Get widget icon.
     */
    public function get_icon(): string
    {
        return 'eicon-gallery-grid';
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
        return ['cards', 'grid', 'learn', 'receipts', 'perspectives', 'toc'];
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
                'label' => esc_html__('Section Header', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_id',
            [
                'label'       => esc_html__('Section Anchor ID', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'learn',
                'description' => esc_html__('Target ID for top navigation and jump links.', 'the-optimize-code'),
            ]
        );

        $this->add_control(
            'show_header',
            [
                'label'        => esc_html__('Show Header', 'the-optimize-code'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'header_title',
            [
                'label'       => esc_html__('Heading', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => __('Make the complex<br>feel usable.', 'the-optimize-code'),
                'condition'   => ['show_header' => 'yes'],
                'rows'        => 2,
            ]
        );

        $this->add_control(
            'header_desc',
            [
                'label'       => esc_html__('Description', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Four interconnected perspectives that turn biological data into everyday decisions.', 'the-optimize-code'),
                'condition'   => ['show_header' => 'yes'],
                'rows'        => 2,
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB - CARDS
        // ==========================================
        $this->start_controls_section(
            'section_content_cards',
            [
                'label' => esc_html__('Cards', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'num',
            [
                'label'       => esc_html__('Card Index / Label', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('01 / PERSPECTIVE', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'glyph',
            [
                'label'       => esc_html__('Glyph / Icon Symbol', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'DNA',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__('Card Title', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Nutrigenomics', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'body',
            [
                'label'   => esc_html__('Card Body', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('How your unique genetic profile influences nutrient processing, metabolism, and food responses.', 'the-optimize-code'),
                'rows'    => 3,
            ]
        );

        $repeater->add_control(
            'link_text',
            [
                'label'   => esc_html__('Link Label', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Explore insights →', 'the-optimize-code'),
            ]
        );

        $repeater->add_control(
            'link_url',
            [
                'label'         => esc_html__('Link URL', 'the-optimize-code'),
                'type'          => \Elementor\Controls_Manager::URL,
                'show_external' => true,
                'default'       => [
                    'url'         => '#episodes',
                    'is_external' => false,
                    'nofollow'    => false,
                ],
            ]
        );

        $this->add_control(
            'cards',
            [
                'label'       => esc_html__('Feature Cards', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'num'       => '01 / PERSPECTIVE',
                        'glyph'     => 'DNA',
                        'title'     => 'Nutrigenomics',
                        'body'      => 'How your unique genetic profile influences nutrient processing, metabolism, and food responses.',
                        'link_text' => 'Explore insights →',
                        'link_url'  => ['url' => '#episodes'],
                    ],
                    [
                        'num'       => '02 / PERSPECTIVE',
                        'glyph'     => '♂♀',
                        'title'     => 'Epigenetics',
                        'body'      => 'How environment, sleep, stress, and nutrition signal your genes to dial expression up or down.',
                        'link_text' => 'Explore insights →',
                        'link_url'  => ['url' => '#episodes'],
                    ],
                    [
                        'num'       => '03 / PERSPECTIVE',
                        'glyph'     => '∞',
                        'title'     => 'Longevity',
                        'body'      => 'Practical strategies for healthspan: cellular health, inflammation management, and metabolic vitality.',
                        'link_text' => 'Explore insights →',
                        'link_url'  => ['url' => '#episodes'],
                    ],
                    [
                        'num'       => '04 / PERSPECTIVE',
                        'glyph'     => '⚖',
                        'title'     => 'Biomarkers',
                        'body'      => 'Understanding standard and functional lab markers so you can have informed conversations with clinicians.',
                        'link_text' => 'Explore insights →',
                        'link_url'  => ['url' => '#episodes'],
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB - COLORS & GRID
        // ==========================================
        $this->start_controls_section(
            'section_style_design',
            [
                'label' => esc_html__('Colors & Styling', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'card_bg',
            [
                'label'     => esc_html__('Card Background', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stat-card' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'glyph_color',
            [
                'label'     => esc_html__('Glyph Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stat-card__glyph' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Title Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stat-card__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'body_color',
            [
                'label'     => esc_html__('Body Text Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stat-card__body' => 'color: {{VALUE}};',
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

        $section_id  = toc_elementor_sanitize_id($settings['section_id'] ?? '', 'learn');
        $show_header = !empty($settings['show_header']) && 'yes' === $settings['show_header'];
        $header_title = !empty($settings['header_title']) ? trim($settings['header_title']) : '';
        $header_desc  = !empty($settings['header_desc']) ? trim($settings['header_desc']) : '';
        $cards        = !empty($settings['cards']) && is_array($settings['cards']) ? $settings['cards'] : [];

        if (empty($cards) && !$header_title) {
            toc_elementor_editor_empty_state($this->get_title());
            return;
        }
        ?>
        <section class="receipts" id="<?php echo esc_attr($section_id); ?>">
            <?php if ($show_header && ($header_title || $header_desc)) : ?>
                <div class="receipts__head">
                    <?php if ($header_title) : ?>
                        <h2 class="display"><?php echo toc_elementor_kses_title($header_title); ?></h2>
                    <?php endif; ?>
                    <?php if ($header_desc) : ?>
                        <p><?php echo toc_elementor_kses_desc($header_desc); ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($cards)) : ?>
                <div class="receipts__grid">
                    <?php foreach ($cards as $card) : ?>
                        <?php
                        $num       = !empty($card['num']) ? trim($card['num']) : '';
                        $glyph     = !empty($card['glyph']) ? trim($card['glyph']) : '';
                        $title     = !empty($card['title']) ? trim($card['title']) : '';
                        $body      = !empty($card['body']) ? trim($card['body']) : '';
                        $link_text = !empty($card['link_text']) ? trim($card['link_text']) : '';
                        $link_url  = !empty($card['link_url']) ? $card['link_url'] : [];
                        ?>
                        <div class="stat-card reveal">
                            <?php if ($num) : ?>
                                <span class="stat-card__num"><?php echo esc_html($num); ?></span>
                            <?php endif; ?>
                            <?php if ($glyph) : ?>
                                <div class="stat-card__glyph"><?php echo esc_html($glyph); ?></div>
                            <?php endif; ?>
                            <?php if ($title) : ?>
                                <h3 class="stat-card__title"><?php echo esc_html($title); ?></h3>
                            <?php endif; ?>
                            <?php if ($body) : ?>
                                <p class="stat-card__body"><?php echo toc_elementor_kses_desc($body); ?></p>
                            <?php endif; ?>
                            <?php if ($link_text && !empty($link_url['url'])) : ?>
                                <a class="stat-card__link" <?php echo toc_elementor_render_link_attrs($link_url); ?>><?php echo esc_html($link_text); ?></a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
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
        var sectionId   = settings.section_id ? settings.section_id.trim() : 'learn';
        var showHeader  = settings.show_header === 'yes';
        var headerTitle = settings.header_title ? settings.header_title.trim() : '';
        var headerDesc  = settings.header_desc ? settings.header_desc.trim() : '';
        var cards       = settings.cards || [];
        #>
        <section class="receipts" id="{{ sectionId }}">
            <# if (showHeader && (headerTitle || headerDesc)) { #>
                <div class="receipts__head">
                    <# if (headerTitle) { #>
                        <h2 class="display">{{{ headerTitle }}}</h2>
                    <# } #>
                    <# if (headerDesc) { #>
                        <p>{{{ headerDesc }}}</p>
                    <# } #>
                </div>
            <# } #>

            <# if (cards.length) { #>
                <div class="receipts__grid">
                    <# _.each(cards, function(card) { #>
                        <div class="stat-card">
                            <# if (card.num) { #>
                                <span class="stat-card__num">{{{ card.num }}}</span>
                            <# } #>
                            <# if (card.glyph) { #>
                                <div class="stat-card__glyph">{{{ card.glyph }}}</div>
                            <# } #>
                            <# if (card.title) { #>
                                <h3 class="stat-card__title">{{{ card.title }}}</h3>
                            <# } #>
                            <# if (card.body) { #>
                                <p class="stat-card__body">{{{ card.body }}}</p>
                            <# } #>
                            <# if (card.link_text && card.link_url && card.link_url.url) { #>
                                <a class="stat-card__link" href="{{ card.link_url.url }}">{{{ card.link_text }}}</a>
                            <# } #>
                        </div>
                    <# }); #>
                </div>
            <# } #>
        </section>
        <?php
    }
}
