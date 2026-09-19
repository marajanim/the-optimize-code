<?php
/**
 * TOC Process Steps widget for Elementor Free.
 *
 * @package The_Optimize_Code
 */

if (!defined('ABSPATH')) {
    exit;
}

class TOC_Process_Steps_Widget extends \Elementor\Widget_Base
{
    /**
     * Get widget name.
     */
    public function get_name(): string
    {
        return 'toc-process-steps';
    }

    /**
     * Get widget title.
     */
    public function get_title(): string
    {
        return esc_html__('TOC Process Steps', 'the-optimize-code');
    }

    /**
     * Get widget icon.
     */
    public function get_icon(): string
    {
        return 'eicon-time-line';
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
        return ['process', 'steps', 'timeline', 'workflow', 'how it works', 'toc'];
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
                'default'     => 'process',
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
            'eyebrow',
            [
                'label'       => esc_html__('Eyebrow', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('A clearer path forward', 'the-optimize-code'),
                'condition'   => ['show_header' => 'yes'],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__('Title', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => __('Learn first.<br>Test thoughtfully.', 'the-optimize-code'),
                'condition'   => ['show_header' => 'yes'],
                'rows'        => 2,
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB - STEPS REPEATER
        // ==========================================
        $this->start_controls_section(
            'section_content_steps',
            [
                'label' => esc_html__('Steps', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'stage',
            [
                'label'       => esc_html__('Stage Label', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Stage 1 · Explore', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__('Step Title', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Start with education', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label'   => esc_html__('Description', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Use the podcast and learning hub to understand the science, benefits and limitations.', 'the-optimize-code'),
                'rows'    => 3,
            ]
        );

        $repeater->add_control(
            'custom_number',
            [
                'label'       => esc_html__('Custom Number (Optional)', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('e.g. 01 (leave blank for auto)', 'the-optimize-code'),
            ]
        );

        $this->add_control(
            'steps',
            [
                'label'       => esc_html__('Step Items', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'stage'         => esc_html__('Stage 1 · Explore', 'the-optimize-code'),
                        'title'         => esc_html__('Start with education', 'the-optimize-code'),
                        'description'   => esc_html__('Use the podcast and learning hub to understand the science, benefits and limitations.', 'the-optimize-code'),
                        'custom_number' => '01',
                    ],
                    [
                        'stage'         => esc_html__('Stage 2 · Consider', 'the-optimize-code'),
                        'title'         => esc_html__('Choose the right pathway', 'the-optimize-code'),
                        'description'   => esc_html__('Review whether a wellness test or clinician-connected PGx request fits your goal.', 'the-optimize-code'),
                        'custom_number' => '02',
                    ],
                    [
                        'stage'         => esc_html__('Stage 3 · Collect', 'the-optimize-code'),
                        'title'         => esc_html__('Follow kit instructions', 'the-optimize-code'),
                        'description'   => esc_html__('If eligible and ordered, collect your sample using the instructions supplied with your kit.', 'the-optimize-code'),
                        'custom_number' => '03',
                    ],
                    [
                        'stage'         => esc_html__('Stage 4 · Understand', 'the-optimize-code'),
                        'title'         => esc_html__('Put results in context', 'the-optimize-code'),
                        'description'   => esc_html__('Read results as educational information and involve a qualified professional where appropriate.', 'the-optimize-code'),
                        'custom_number' => '04',
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB - COLORS & SPACING
        // ==========================================
        $this->start_controls_section(
            'section_style_design',
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
                    '{{WRAPPER}} .process' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'card_bg',
            [
                'label'     => esc_html__('Step Card Background', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .process-step' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'stage_color',
            [
                'label'     => esc_html__('Stage Label Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .process-step__stage' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'number_color',
            [
                'label'     => esc_html__('Number Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .process-step__number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Step Title Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .process-step h4' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__('Description Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .process-step p' => 'color: {{VALUE}};',
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

        $section_id  = toc_elementor_sanitize_id($settings['section_id'] ?? '', 'process');
        $show_header = !empty($settings['show_header']) && 'yes' === $settings['show_header'];
        $eyebrow     = !empty($settings['eyebrow']) ? trim($settings['eyebrow']) : '';
        $title       = !empty($settings['title']) ? trim($settings['title']) : '';
        $steps       = !empty($settings['steps']) && is_array($settings['steps']) ? $settings['steps'] : [];

        if (empty($steps) && !$title) {
            toc_elementor_editor_empty_state($this->get_title());
            return;
        }
        ?>
        <section class="process" id="<?php echo esc_attr($section_id); ?>">
            <?php if ($show_header && ($eyebrow || $title)) : ?>
                <div class="process__head">
                    <div>
                        <?php if ($eyebrow) : ?>
                            <span class="feature__eyebrow"><?php echo esc_html($eyebrow); ?></span>
                        <?php endif; ?>
                        <?php if ($title) : ?>
                            <h2 class="display"><?php echo toc_elementor_kses_title($title); ?></h2>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($steps)) : ?>
                <div class="process__scroll">
                    <?php foreach ($steps as $index => $step) : ?>
                        <?php
                        $stage       = !empty($step['stage']) ? trim($step['stage']) : '';
                        $step_title  = !empty($step['title']) ? trim($step['title']) : '';
                        $description = !empty($step['description']) ? trim($step['description']) : '';
                        $num         = !empty($step['custom_number']) ? trim($step['custom_number']) : sprintf('%02d', $index + 1);
                        ?>
                        <article class="process-step reveal">
                            <div>
                                <?php if ($stage) : ?>
                                    <div class="process-step__stage"><?php echo esc_html($stage); ?></div>
                                <?php endif; ?>
                                <?php if ($step_title) : ?>
                                    <h4><?php echo esc_html($step_title); ?></h4>
                                <?php endif; ?>
                                <?php if ($description) : ?>
                                    <p><?php echo toc_elementor_kses_desc($description); ?></p>
                                <?php endif; ?>
                            </div>
                            <?php if ($num) : ?>
                                <div class="process-step__number"><?php echo esc_html($num); ?></div>
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
        var sectionId  = settings.section_id ? settings.section_id.trim() : 'process';
        var showHeader = settings.show_header === 'yes';
        var eyebrow    = settings.eyebrow ? settings.eyebrow.trim() : '';
        var title      = settings.title ? settings.title.trim() : '';
        var steps      = settings.steps || [];
        #>
        <section class="process" id="{{ sectionId }}">
            <# if (showHeader && (eyebrow || title)) { #>
                <div class="process__head">
                    <div>
                        <# if (eyebrow) { #>
                            <span class="feature__eyebrow">{{{ eyebrow }}}</span>
                        <# } #>
                        <# if (title) { #>
                            <h2 class="display">{{{ title }}}</h2>
                        <# } #>
                    </div>
                </div>
            <# } #>

            <# if (steps.length) { #>
                <div class="process__scroll">
                    <# _.each(steps, function(step, idx) {
                        var num = step.custom_number ? step.custom_number.trim() : ('0' + (idx + 1)).slice(-2);
                    #>
                        <article class="process-step">
                            <div>
                                <# if (step.stage) { #>
                                    <div class="process-step__stage">{{{ step.stage }}}</div>
                                <# } #>
                                <# if (step.title) { #>
                                    <h4>{{{ step.title }}}</h4>
                                <# } #>
                                <# if (step.description) { #>
                                    <p>{{{ step.description }}}</p>
                                <# } #>
                            </div>
                            <div class="process-step__number">{{{ num }}}</div>
                        </article>
                    <# }); #>
                </div>
            <# } #>
        </section>
        <?php
    }
}
