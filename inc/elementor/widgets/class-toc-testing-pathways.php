<?php
/**
 * TOC Testing Pathways widget for Elementor Free.
 *
 * @package The_Optimize_Code
 */

if (!defined('ABSPATH')) {
    exit;
}

class TOC_Testing_Pathways_Widget extends \Elementor\Widget_Base
{
    /**
     * Get widget name.
     */
    public function get_name(): string
    {
        return 'toc-testing-pathways';
    }

    /**
     * Get widget title.
     */
    public function get_title(): string
    {
        return esc_html__('TOC Testing Pathways', 'the-optimize-code');
    }

    /**
     * Get widget icon.
     */
    public function get_icon(): string
    {
        return 'eicon-columns';
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
        return ['testing', 'pathways', 'wellness', 'pgx', 'options', 'toc'];
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
                'default'     => 'testing-options',
                'description' => esc_html__('Target ID for navigation and jump links.', 'the-optimize-code'),
            ]
        );

        $this->add_control(
            'eyebrow',
            [
                'label'       => esc_html__('Eyebrow', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Two pathways · Designed responsibly', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'   => esc_html__('Title', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Testing without<br>the guesswork.', 'the-optimize-code'),
                'rows'    => 2,
            ]
        );

        $this->add_control(
            'description',
            [
                'label'   => esc_html__('Description', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Different tests require different levels of support. Wellness testing may be available for direct purchase; pharmacogenomic testing follows a clinician-connected request pathway.', 'the-optimize-code'),
                'rows'    => 3,
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB - PATHWAYS REPEATER
        // ==========================================
        $this->start_controls_section(
            'section_content_cards',
            [
                'label' => esc_html__('Pathways', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'card_variant',
            [
                'label'   => esc_html__('Card Theme Style', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'wellness',
                'options' => [
                    'wellness' => esc_html__('Wellness (test-card--wellness)', 'the-optimize-code'),
                    'pgx'      => esc_html__('PGx (test-card--pgx)', 'the-optimize-code'),
                ],
            ]
        );

        $repeater->add_control(
            'top_label',
            [
                'label'       => esc_html__('Top Index Label', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('01 / DIRECT PURCHASE', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'status_label',
            [
                'label'   => esc_html__('Status Badge', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('WELLNESS', 'the-optimize-code'),
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__('Pathway Title', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => __('Nutrigenomics<br>& Wellness', 'the-optimize-code'),
                'label_block' => true,
                'rows'        => 2,
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label'   => esc_html__('Pathway Summary', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Explore how genetic variation may inform educational insights about nutrition, fitness and lifestyle.', 'the-optimize-code'),
                'rows'    => 3,
            ]
        );

        $repeater->add_control(
            'steps',
            [
                'label'       => esc_html__('Steps List (One per line)', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => "Choose an eligible test\nComplete secure checkout\nCollect and return your sample\nReceive educational insights",
                'description' => esc_html__('Enter each step on a new line.', 'the-optimize-code'),
                'rows'        => 4,
            ]
        );

        $repeater->add_control(
            'cta_text',
            [
                'label'       => esc_html__('CTA Label', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Explore wellness tests →', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'cta_url',
            [
                'label'         => esc_html__('CTA URL', 'the-optimize-code'),
                'type'          => \Elementor\Controls_Manager::URL,
                'show_external' => true,
                'default'       => [
                    'url'         => toc_home_anchor('#contact'),
                    'is_external' => false,
                    'nofollow'    => false,
                ],
            ]
        );

        $repeater->add_control(
            'cta_variant',
            [
                'label'   => esc_html__('Button Style', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'primary',
                'options' => [
                    'primary'      => esc_html__('Primary (btn--primary)', 'the-optimize-code'),
                    'outline-lime' => esc_html__('Outline Accent (btn--outline-lime)', 'the-optimize-code'),
                ],
            ]
        );

        $repeater->add_control(
            'footer_note',
            [
                'label'       => esc_html__('Footnote (Optional)', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '',
                'placeholder' => esc_html__('e.g. PGx testing is not available as a standard "buy now" product.', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'pathways',
            [
                'label'       => esc_html__('Pathway Cards', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'card_variant' => 'wellness',
                        'top_label'    => '01 / DIRECT PURCHASE',
                        'status_label' => 'WELLNESS',
                        'title'        => 'Nutrigenomics<br>& Wellness',
                        'description'  => 'Explore how genetic variation may inform educational insights about nutrition, fitness and lifestyle.',
                        'steps'        => "Choose an eligible test\nComplete secure checkout\nCollect and return your sample\nReceive educational insights",
                        'cta_text'     => 'Explore wellness tests →',
                        'cta_url'      => ['url' => toc_home_anchor('#contact')],
                        'cta_variant'  => 'primary',
                        'footer_note'  => '',
                    ],
                    [
                        'card_variant' => 'pgx',
                        'top_label'    => '02 / CLINICIAN-CONNECTED',
                        'status_label' => 'PGx',
                        'title'        => 'Pharmacogenomic<br>Testing',
                        'description'  => 'PGx explores how genetic variation may affect medication response. Requests require review and authorization by a licensed provider.',
                        'steps'        => "Submit a testing request\nLicensed provider review\nSample collection arranged\nResults reviewed before release",
                        'cta_text'     => 'Request PGx testing →',
                        'cta_url'      => ['url' => '#pgx-request'],
                        'cta_variant'  => 'outline-lime',
                        'footer_note'  => 'PGx testing is not available as a standard “buy now” product.',
                    ],
                ],
                'title_field' => '{{{ title }}}',
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

        $section_id  = toc_elementor_sanitize_id($settings['section_id'] ?? '', 'testing-options');
        $eyebrow     = !empty($settings['eyebrow']) ? trim($settings['eyebrow']) : '';
        $title       = !empty($settings['title']) ? trim($settings['title']) : '';
        $description = !empty($settings['description']) ? trim($settings['description']) : '';
        $pathways    = !empty($settings['pathways']) && is_array($settings['pathways']) ? $settings['pathways'] : [];

        if (empty($pathways) && !$title) {
            toc_elementor_editor_empty_state($this->get_title());
            return;
        }
        ?>
        <section class="services testing-page__options" id="<?php echo esc_attr($section_id); ?>">
            <div class="services__head">
                <div>
                    <?php if ($eyebrow) : ?>
                        <span class="feature__eyebrow"><?php echo esc_html($eyebrow); ?></span>
                    <?php endif; ?>
                    <?php if ($title) : ?>
                        <h2 class="display"><?php echo toc_elementor_kses_title($title); ?></h2>
                    <?php endif; ?>
                </div>
                <?php if ($description) : ?>
                    <p><?php echo toc_elementor_kses_desc($description); ?></p>
                <?php endif; ?>
            </div>

            <?php if (!empty($pathways)) : ?>
                <div class="testing-grid">
                    <?php foreach ($pathways as $card) : ?>
                        <?php
                        $variant   = !empty($card['card_variant']) ? $card['card_variant'] : 'wellness';
                        $top_label = !empty($card['top_label']) ? trim($card['top_label']) : '';
                        $status    = !empty($card['status_label']) ? trim($card['status_label']) : '';
                        $c_title   = !empty($card['title']) ? trim($card['title']) : '';
                        $c_desc    = !empty($card['description']) ? trim($card['description']) : '';
                        $steps_raw = !empty($card['steps']) ? trim($card['steps']) : '';
                        $cta_text  = !empty($card['cta_text']) ? trim($card['cta_text']) : '';
                        $cta_url   = !empty($card['cta_url']) ? $card['cta_url'] : [];
                        $cta_var   = !empty($card['cta_variant']) && 'outline-lime' === $card['cta_variant'] ? 'btn btn--outline-lime' : 'btn btn--primary';
                        $footnote  = !empty($card['footer_note']) ? trim($card['footer_note']) : '';

                        $steps = array_filter(array_map('trim', explode("\n", $steps_raw)));
                        ?>
                        <article class="test-card test-card--<?php echo esc_attr($variant); ?> reveal">
                            <?php if ($top_label || $status) : ?>
                                <div class="test-card__top">
                                    <?php if ($top_label) : ?><span><?php echo esc_html($top_label); ?></span><?php endif; ?>
                                    <?php if ($status) : ?><span class="test-card__status"><?php echo esc_html($status); ?></span><?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <div>
                                <?php if ($c_title) : ?>
                                    <h3><?php echo toc_elementor_kses_title($c_title); ?></h3>
                                <?php endif; ?>
                                <?php if ($c_desc) : ?>
                                    <p><?php echo toc_elementor_kses_desc($c_desc); ?></p>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty($steps)) : ?>
                                <ol>
                                    <?php foreach ($steps as $step) : ?>
                                        <li><?php echo esc_html($step); ?></li>
                                    <?php endforeach; ?>
                                </ol>
                            <?php endif; ?>
                            <?php if ($cta_text && !empty($cta_url['url'])) : ?>
                                <a class="<?php echo esc_attr($cta_var); ?>" <?php echo toc_elementor_render_link_attrs($cta_url); ?>><?php echo esc_html($cta_text); ?></a>
                            <?php endif; ?>
                            <?php if ($footnote) : ?>
                                <small><?php echo esc_html($footnote); ?></small>
                            <?php endif; ?>
                        </article>
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
        var sectionId   = settings.section_id ? settings.section_id.trim() : 'testing-options';
        var eyebrow     = settings.eyebrow ? settings.eyebrow.trim() : '';
        var title       = settings.title ? settings.title.trim() : '';
        var description = settings.description ? settings.description.trim() : '';
        var pathways    = settings.pathways || [];
        #>
        <section class="services testing-page__options" id="{{ sectionId }}">
            <div class="services__head">
                <div>
                    <# if (eyebrow) { #>
                        <span class="feature__eyebrow">{{{ eyebrow }}}</span>
                    <# } #>
                    <# if (title) { #>
                        <h2 class="display">{{{ title }}}</h2>
                    <# } #>
                </div>
                <# if (description) { #>
                    <p>{{{ description }}}</p>
                <# } #>
            </div>

            <# if (pathways.length) { #>
                <div class="testing-grid">
                    <# _.each(pathways, function(card) {
                        var variant = card.card_variant || 'wellness';
                        var ctaCl   = card.cta_variant === 'outline-lime' ? 'btn btn--outline-lime' : 'btn btn--primary';
                        var ctaUrl  = card.cta_url && card.cta_url.url ? card.cta_url.url : '';
                        var steps   = card.steps ? card.steps.split('\n') : [];
                    #>
                        <article class="test-card test-card--{{ variant }}">
                            <div class="test-card__top">
                                <# if (card.top_label) { #><span>{{{ card.top_label }}}</span><# } #>
                                <# if (card.status_label) { #><span class="test-card__status">{{{ card.status_label }}}</span><# } #>
                            </div>
                            <div>
                                <# if (card.title) { #><h3>{{{ card.title }}}</h3><# } #>
                                <# if (card.description) { #><p>{{{ card.description }}}</p><# } #>
                            </div>
                            <# if (steps.length) { #>
                                <ol>
                                    <# _.each(steps, function(s) { if (s.trim()) { #>
                                        <li>{{{ s.trim() }}}</li>
                                    <# } }); #>
                                </ol>
                            <# } #>
                            <# if (card.cta_text && ctaUrl) { #>
                                <a class="{{ ctaCl }}" href="{{ ctaUrl }}">{{{ card.cta_text }}}</a>
                            <# } #>
                            <# if (card.footer_note) { #>
                                <small>{{{ card.footer_note }}}</small>
                            <# } #>
                        </article>
                    <# }); #>
                </div>
            <# } #>
        </section>
        <?php
    }
}
