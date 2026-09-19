<?php
/**
 * TOC Education Grid widget for Elementor Free.
 *
 * @package The_Optimize_Code
 */

if (!defined('ABSPATH')) {
    exit;
}

class TOC_Education_Grid_Widget extends \Elementor\Widget_Base
{
    /**
     * Get widget name.
     */
    public function get_name(): string
    {
        return 'toc-education-grid';
    }

    /**
     * Get widget title.
     */
    public function get_title(): string
    {
        return esc_html__('TOC Education Grid', 'the-optimize-code');
    }

    /**
     * Get widget icon.
     */
    public function get_icon(): string
    {
        return 'eicon-posts-grid';
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
        return ['education', 'grid', 'articles', 'resources', 'guides', 'toc'];
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
                'default'     => 'education',
                'description' => esc_html__('Target ID for top navigation and jump links.', 'the-optimize-code'),
            ]
        );

        $this->add_control(
            'grid_id',
            [
                'label'       => esc_html__('Grid Anchor ID', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'episodes',
                'description' => esc_html__('Target ID for link jumps directly to the article grid.', 'the-optimize-code'),
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
                'default'     => esc_html__('Education hub', 'the-optimize-code'),
                'condition'   => ['show_header' => 'yes'],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__('Title', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => __('Read. Watch.<br>Question. Repeat.', 'the-optimize-code'),
                'condition'   => ['show_header' => 'yes'],
                'rows'        => 2,
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB - SOURCE & CARDS
        // ==========================================
        $this->start_controls_section(
            'section_content_articles',
            [
                'label' => esc_html__('Articles & Resources', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'source_mode',
            [
                'label'   => esc_html__('Content Source', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'manual',
                'options' => [
                    'manual' => esc_html__('Manual Repeater Items', 'the-optimize-code'),
                    'query'  => esc_html__('WordPress Posts Query', 'the-optimize-code'),
                ],
            ]
        );

        // Manual repeater
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'meta',
            [
                'label'       => esc_html__('Category / Meta Tag', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('FEATURED GUIDE · 8 MIN', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__('Article Title', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('What a genetic test can actually tell you', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label'       => esc_html__('Description (Featured only)', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__('A calm, practical guide to probabilities, limitations and useful next questions.', 'the-optimize-code'),
                'rows'        => 2,
            ]
        );

        $repeater->add_control(
            'link_text',
            [
                'label'   => esc_html__('Link Label', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Read the guide →', 'the-optimize-code'),
            ]
        );

        $repeater->add_control(
            'link_url',
            [
                'label'         => esc_html__('Link URL', 'the-optimize-code'),
                'type'          => \Elementor\Controls_Manager::URL,
                'show_external' => true,
                'default'       => [
                    'url'         => '#contact',
                    'is_external' => false,
                    'nofollow'    => false,
                ],
            ]
        );

        $repeater->add_control(
            'is_featured',
            [
                'label'        => esc_html__('Featured Card Style', 'the-optimize-code'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'articles',
            [
                'label'       => esc_html__('Articles', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'condition'   => ['source_mode' => 'manual'],
                'default'     => [
                    [
                        'meta'        => esc_html__('FEATURED GUIDE · 8 MIN', 'the-optimize-code'),
                        'title'       => esc_html__('What a genetic test can actually tell you', 'the-optimize-code'),
                        'description' => esc_html__('A calm, practical guide to probabilities, limitations and useful next questions.', 'the-optimize-code'),
                        'link_text'   => esc_html__('Read the guide →', 'the-optimize-code'),
                        'link_url'    => ['url' => '#contact'],
                        'is_featured' => 'yes',
                    ],
                    [
                        'meta'        => esc_html__('PODCAST · EP 017', 'the-optimize-code'),
                        'title'       => esc_html__('Food, genes and the myth of one perfect diet', 'the-optimize-code'),
                        'description' => '',
                        'link_text'   => esc_html__('Listen now →', 'the-optimize-code'),
                        'link_url'    => ['url' => '#podcast'],
                        'is_featured' => 'no',
                    ],
                    [
                        'meta'        => esc_html__('VIDEO · 06:20', 'the-optimize-code'),
                        'title'       => esc_html__('PGx: five things to understand before testing', 'the-optimize-code'),
                        'description' => '',
                        'link_text'   => esc_html__('Watch explainer →', 'the-optimize-code'),
                        'link_url'    => ['url' => toc_page_url('testing')],
                        'is_featured' => 'no',
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        // Query mode controls
        $this->add_control(
            'query_posts_count',
            [
                'label'     => esc_html__('Number of Posts', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::NUMBER,
                'default'   => 3,
                'min'       => 1,
                'max'       => 12,
                'condition' => ['source_mode' => 'query'],
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB - COLORS
        // ==========================================
        $this->start_controls_section(
            'section_style_colors',
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
                    '{{WRAPPER}} .education-hub' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'card_bg',
            [
                'label'     => esc_html__('Card Background', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .article-card' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'label'     => esc_html__('Meta Tag Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .article-card > span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Title Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .article-card h3' => 'color: {{VALUE}};',
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

        $section_id  = toc_elementor_sanitize_id($settings['section_id'] ?? '', 'education');
        $grid_id     = toc_elementor_sanitize_id($settings['grid_id'] ?? '', 'episodes');
        $show_header = !empty($settings['show_header']) && 'yes' === $settings['show_header'];
        $eyebrow     = !empty($settings['eyebrow']) ? trim($settings['eyebrow']) : '';
        $title       = !empty($settings['title']) ? trim($settings['title']) : '';
        $source_mode = !empty($settings['source_mode']) ? $settings['source_mode'] : 'manual';

        $cards = [];

        if ('query' === $source_mode) {
            $count = !empty($settings['query_posts_count']) ? (int) $settings['query_posts_count'] : 3;
            $post_type = post_type_exists('toc_resource') ? 'toc_resource' : 'post';
            $query = new \WP_Query([
                'post_type'           => $post_type,
                'post_status'         => 'publish',
                'posts_per_page'      => $count,
                'ignore_sticky_posts' => true,
                'no_found_rows'       => true,
            ]);

            if ($query->have_posts()) {
                $idx = 0;
                while ($query->have_posts()) {
                    $query->the_post();
                    $post_id = get_the_ID();
                    $badge   = (string) get_post_meta($post_id, '_toc_resource_badge', true);
                    if (!$badge) {
                        $categories = get_the_category();
                        $badge      = !empty($categories) ? strtoupper($categories[0]->name) : __('ARTICLE', 'the-optimize-code');
                    }
                    $cards[] = [
                        'meta'        => $badge,
                        'title'       => get_the_title(),
                        'description' => 0 === $idx ? get_the_excerpt() : '',
                        'link_text'   => __('Read more →', 'the-optimize-code'),
                        'link_url'    => ['url' => get_permalink()],
                        'is_featured' => 0 === $idx ? 'yes' : 'no',
                    ];
                    $idx++;
                }
                wp_reset_postdata();
            }
        } else {
            $cards = !empty($settings['articles']) && is_array($settings['articles']) ? $settings['articles'] : [];
        }

        if (empty($cards) && !$title) {
            toc_elementor_editor_empty_state($this->get_title());
            return;
        }
        ?>
        <section class="education-hub" id="<?php echo esc_attr($section_id); ?>">
            <?php if ($show_header && ($eyebrow || $title)) : ?>
                <div class="education-hub__head">
                    <?php if ($eyebrow) : ?>
                        <span class="feature__eyebrow"><?php echo esc_html($eyebrow); ?></span>
                    <?php endif; ?>
                    <?php if ($title) : ?>
                        <h2 class="display"><?php echo toc_elementor_kses_title($title); ?></h2>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($cards)) : ?>
                <div class="article-grid" id="<?php echo esc_attr($grid_id); ?>">
                    <?php foreach ($cards as $card) : ?>
                        <?php
                        $meta        = !empty($card['meta']) ? trim($card['meta']) : '';
                        $card_title  = !empty($card['title']) ? trim($card['title']) : '';
                        $desc        = !empty($card['description']) ? trim($card['description']) : '';
                        $link_text   = !empty($card['link_text']) ? trim($card['link_text']) : '';
                        $link_url    = !empty($card['link_url']) ? $card['link_url'] : [];
                        $is_featured = !empty($card['is_featured']) && 'yes' === $card['is_featured'];
                        $featured_cl = $is_featured ? ' article-card--featured' : '';
                        ?>
                        <article class="article-card<?php echo esc_attr($featured_cl); ?> reveal">
                            <?php if ($meta) : ?>
                                <span><?php echo esc_html($meta); ?></span>
                            <?php endif; ?>
                            <?php if ($card_title) : ?>
                                <h3><?php echo esc_html($card_title); ?></h3>
                            <?php endif; ?>
                            <?php if ($desc) : ?>
                                <p><?php echo toc_elementor_kses_desc($desc); ?></p>
                            <?php endif; ?>
                            <?php if ($link_text && !empty($link_url['url'])) : ?>
                                <a <?php echo toc_elementor_render_link_attrs($link_url); ?>><?php echo esc_html($link_text); ?></a>
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
        var sectionId  = settings.section_id ? settings.section_id.trim() : 'education';
        var gridId     = settings.grid_id ? settings.grid_id.trim() : 'episodes';
        var showHeader = settings.show_header === 'yes';
        var eyebrow    = settings.eyebrow ? settings.eyebrow.trim() : '';
        var title      = settings.title ? settings.title.trim() : '';
        var articles   = settings.articles || [];
        #>
        <section class="education-hub" id="{{ sectionId }}">
            <# if (showHeader && (eyebrow || title)) { #>
                <div class="education-hub__head">
                    <# if (eyebrow) { #>
                        <span class="feature__eyebrow">{{{ eyebrow }}}</span>
                    <# } #>
                    <# if (title) { #>
                        <h2 class="display">{{{ title }}}</h2>
                    <# } #>
                </div>
            <# } #>

            <# if (articles.length) { #>
                <div class="article-grid" id="{{ gridId }}">
                    <# _.each(articles, function(card) {
                        var isFeatured = card.is_featured === 'yes';
                        var featuredCl = isFeatured ? ' article-card--featured' : '';
                        var linkUrl    = card.link_url && card.link_url.url ? card.link_url.url : '';
                    #>
                        <article class="article-card{{ featuredCl }}">
                            <# if (card.meta) { #>
                                <span>{{{ card.meta }}}</span>
                            <# } #>
                            <# if (card.title) { #>
                                <h3>{{{ card.title }}}</h3>
                            <# } #>
                            <# if (card.description) { #>
                                <p>{{{ card.description }}}</p>
                            <# } #>
                            <# if (card.link_text && linkUrl) { #>
                                <a href="{{ linkUrl }}">{{{ card.link_text }}}</a>
                            <# } #>
                        </article>
                    <# }); #>
                </div>
            <# } #>
        </section>
        <?php
    }
}
