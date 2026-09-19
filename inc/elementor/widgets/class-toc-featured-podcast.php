<?php
/**
 * TOC Featured Podcast widget for Elementor Free.
 *
 * @package The_Optimize_Code
 */

if (!defined('ABSPATH')) {
    exit;
}

class TOC_Featured_Podcast_Widget extends \Elementor\Widget_Base
{
    /**
     * Get widget name.
     */
    public function get_name(): string
    {
        return 'toc-featured-podcast';
    }

    /**
     * Get widget title.
     */
    public function get_title(): string
    {
        return esc_html__('TOC Featured Podcast', 'the-optimize-code');
    }

    /**
     * Get widget icon.
     */
    public function get_icon(): string
    {
        return 'eicon-play';
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
        return ['podcast', 'audio', 'episode', 'featured', 'toc'];
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
                'default'     => 'podcast',
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
            'header_eyebrow',
            [
                'label'       => esc_html__('Eyebrow', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('The Optimize Code Podcast · Latest episode', 'the-optimize-code'),
                'condition'   => ['show_header' => 'yes'],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'header_title',
            [
                'label'       => esc_html__('Header Title', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => __('Science you can use.<br>Conversations worth keeping.', 'the-optimize-code'),
                'condition'   => ['show_header' => 'yes'],
                'rows'        => 2,
            ]
        );

        $this->add_control(
            'header_link_text',
            [
                'label'     => esc_html__('Header Link Label', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => esc_html__('Browse episodes →', 'the-optimize-code'),
                'condition' => ['show_header' => 'yes'],
            ]
        );

        $this->add_control(
            'header_link_url',
            [
                'label'       => esc_html__('Header Link URL', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::URL,
                'default'     => ['url' => '#episodes'],
                'condition'   => ['show_header' => 'yes'],
            ]
        );

        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB - EPISODE CARD
        // ==========================================
        $this->start_controls_section(
            'section_content_card',
            [
                'label' => esc_html__('Episode Details', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'source_mode',
            [
                'label'   => esc_html__('Episode Source', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'manual',
                'options' => [
                    'manual' => esc_html__('Manual Controls', 'the-optimize-code'),
                    'query'  => esc_html__('Latest Podcast Episode (from Companion Plugin)', 'the-optimize-code'),
                ],
            ]
        );

        $this->add_control(
            'episode_number',
            [
                'label'     => esc_html__('Episode Label / Number', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => esc_html__('EP / 018', 'the-optimize-code'),
                'condition' => ['source_mode' => 'manual'],
            ]
        );

        $this->add_control(
            'artwork',
            [
                'label'       => esc_html__('Episode Artwork', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::MEDIA,
                'description' => esc_html__('Cover image for the podcast card. Leave empty to use theme default.', 'the-optimize-code'),
            ]
        );

        $this->add_control(
            'show_wave',
            [
                'label'        => esc_html__('Show Waveform Graphic', 'the-optimize-code'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'tag',
            [
                'label'       => esc_html__('Tag', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Nutrigenomics', 'the-optimize-code'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tags',
            [
                'label'       => esc_html__('Tags / Metadata', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    ['tag' => esc_html__('Nutrigenomics', 'the-optimize-code')],
                    ['tag' => esc_html__('42 min', 'the-optimize-code')],
                ],
                'title_field' => '{{{ tag }}}',
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__('Episode Title', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => __('Your genes are<br>not your <em>destiny.</em>', 'the-optimize-code'),
                'rows'        => 2,
            ]
        );

        $this->add_control(
            'description',
            [
                'label'   => esc_html__('Episode Summary', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('A practical conversation about what genetic insights can—and cannot—tell you about food, movement and everyday choices.', 'the-optimize-code'),
                'rows'    => 3,
            ]
        );

        $this->add_control(
            'episode_url',
            [
                'label'         => esc_html__('Episode Destination URL', 'the-optimize-code'),
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
            'episode_link_text',
            [
                'label'   => esc_html__('Episode Link Label', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Listen to episode →', 'the-optimize-code'),
            ]
        );

        $this->add_control(
            'audio_url',
            [
                'label'       => esc_html__('Audio Source URL', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://.../episode.mp3', 'the-optimize-code'),
                'description' => esc_html__('Optional direct audio link. Only real audio sources will show an interactive play button.', 'the-optimize-code'),
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
            'card_bg',
            [
                'label'     => esc_html__('Card Background', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feature-card' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'series_color',
            [
                'label'     => esc_html__('Series Label Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .podcast-card__series' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Title Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feature-card__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__('Summary Color', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feature-card__desc' => 'color: {{VALUE}};',
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

        $section_id  = toc_elementor_sanitize_id($settings['section_id'] ?? '', 'podcast');
        $show_header = !empty($settings['show_header']) && 'yes' === $settings['show_header'];

        $header_eyebrow   = !empty($settings['header_eyebrow']) ? trim($settings['header_eyebrow']) : '';
        $header_title     = !empty($settings['header_title']) ? trim($settings['header_title']) : '';
        $header_link_text = !empty($settings['header_link_text']) ? trim($settings['header_link_text']) : '';
        $header_link_url  = !empty($settings['header_link_url']) ? $settings['header_link_url'] : [];

        $episode_number = !empty($settings['episode_number']) ? trim($settings['episode_number']) : '';
        $show_wave      = !empty($settings['show_wave']) && 'yes' === $settings['show_wave'];
        $tags           = !empty($settings['tags']) && is_array($settings['tags']) ? $settings['tags'] : [];
        $title          = !empty($settings['title']) ? trim($settings['title']) : '';
        $description    = !empty($settings['description']) ? trim($settings['description']) : '';
        $episode_url    = !empty($settings['episode_url']) ? $settings['episode_url'] : [];
        $link_text      = !empty($settings['episode_link_text']) ? trim($settings['episode_link_text']) : '';
        $audio_url      = !empty($settings['audio_url']['url']) ? trim($settings['audio_url']['url']) : '';

        $source_mode = !empty($settings['source_mode']) ? $settings['source_mode'] : 'manual';

        if ('query' === $source_mode && post_type_exists('toc_podcast')) {
            $query = new \WP_Query([
                'post_type'           => 'toc_podcast',
                'post_status'         => 'publish',
                'posts_per_page'      => 1,
                'ignore_sticky_posts' => true,
                'no_found_rows'       => true,
            ]);

            if ($query->have_posts()) {
                $query->the_post();
                $post_id        = get_the_ID();
                $title          = get_the_title();
                $description    = get_the_excerpt();
                $episode_number = (string) get_post_meta($post_id, '_toc_podcast_episode_number', true) ?: $episode_number;
                $audio_url      = (string) get_post_meta($post_id, '_toc_podcast_audio_url', true) ?: $audio_url;
                $tags_raw       = (string) get_post_meta($post_id, '_toc_podcast_tags', true);
                $episode_url    = ['url' => get_permalink()];
                $link_text      = __('Listen to episode →', 'the-optimize-code');

                if ($tags_raw) {
                    $tags = array_map(function ($t) {
                        return ['tag' => trim($t)];
                    }, explode(',', $tags_raw));
                }

                $thumb_id = get_post_thumbnail_id($post_id);
                if ($thumb_id) {
                    $art_url = wp_get_attachment_image_url($thumb_id, 'full');
                }
                wp_reset_postdata();
            }
        }

        // Custom artwork background style
        $art_url   = !empty($art_url) ? esc_url($art_url) : (!empty($settings['artwork']['url']) ? esc_url($settings['artwork']['url']) : '');
        $art_style = $art_url ? ' style="background-image:url(' . $art_url . ');"' : '';

        // Only render interactive play button for legitimate audio URLs
        $has_valid_audio = false;
        if ($audio_url) {
            $parsed_url = wp_parse_url($audio_url, PHP_URL_PATH);
            $extension  = $parsed_url ? strtolower(pathinfo($parsed_url, PATHINFO_EXTENSION)) : '';
            if (in_array($extension, ['mp3', 'm4a', 'ogg', 'wav'], true)) {
                $has_valid_audio = true;
            }
        }
        ?>
        <section class="feature" id="<?php echo esc_attr($section_id); ?>">
            <?php if ($show_header && ($header_eyebrow || $header_title)) : ?>
                <div class="feature__head">
                    <div>
                        <?php if ($header_eyebrow) : ?>
                            <span class="feature__eyebrow"><?php echo esc_html($header_eyebrow); ?></span>
                        <?php endif; ?>
                        <?php if ($header_title) : ?>
                            <h2 class="display"><?php echo toc_elementor_kses_title($header_title); ?></h2>
                        <?php endif; ?>
                    </div>
                    <?php if ($header_link_text && !empty($header_link_url['url'])) : ?>
                        <a class="feature__cta-link" <?php echo toc_elementor_render_link_attrs($header_link_url); ?>><?php echo esc_html($header_link_text); ?></a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <article class="feature-card podcast-card reveal">
                <div class="feature-card__media podcast-card__art"<?php echo $art_style; ?>>
                    <?php if ($episode_number) : ?>
                        <span class="podcast-card__series"><?php echo esc_html($episode_number); ?></span>
                    <?php endif; ?>
                    <?php if ($show_wave) : ?>
                        <div class="podcast-card__wave" aria-hidden="true">
                            <i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i>
                        </div>
                    <?php endif; ?>
                    <?php if ($has_valid_audio) : ?>
                        <button class="feature-card__play-btn" type="button" aria-label="<?php esc_attr_e('Play episode audio', 'the-optimize-code'); ?>" data-audio-src="<?php echo esc_url($audio_url); ?>">&#9654;</button>
                    <?php elseif (!empty($episode_url['url'])) : ?>
                        <a class="feature-card__play-btn" aria-label="<?php esc_attr_e('View episode details', 'the-optimize-code'); ?>" <?php echo toc_elementor_render_link_attrs($episode_url); ?>>&#9654;</a>
                    <?php endif; ?>
                </div>
                <div class="feature-card__info">
                    <div>
                        <?php if (!empty($tags)) : ?>
                            <div class="feature-card__tags">
                                <?php foreach ($tags as $tag_item) : ?>
                                    <?php if (!empty($tag_item['tag'])) : ?>
                                        <span class="feature-card__tag"><?php echo esc_html($tag_item['tag']); ?></span>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($title) : ?>
                            <h3 class="feature-card__title"><?php echo toc_elementor_kses_title($title); ?></h3>
                        <?php endif; ?>
                        <?php if ($description) : ?>
                            <p class="feature-card__desc"><?php echo toc_elementor_kses_desc($description); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php if ($link_text && !empty($episode_url['url'])) : ?>
                        <a class="feature-card__more" <?php echo toc_elementor_render_link_attrs($episode_url); ?>><?php echo esc_html($link_text); ?></a>
                    <?php endif; ?>
                </div>
            </article>
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
        var sectionId   = settings.section_id ? settings.section_id.trim() : 'podcast';
        var showHeader  = settings.show_header === 'yes';
        var eyebrow     = settings.header_eyebrow ? settings.header_eyebrow.trim() : '';
        var headerTitle = settings.header_title ? settings.header_title.trim() : '';
        var headLinkTxt = settings.header_link_text ? settings.header_link_text.trim() : '';
        var headLinkUrl = settings.header_link_url && settings.header_link_url.url ? settings.header_link_url.url : '';

        var epNum       = settings.episode_number ? settings.episode_number.trim() : '';
        var showWave    = settings.show_wave === 'yes';
        var tags        = settings.tags || [];
        var title       = settings.title ? settings.title.trim() : '';
        var description = settings.description ? settings.description.trim() : '';
        var epUrl       = settings.episode_url && settings.episode_url.url ? settings.episode_url.url : '';
        var linkText    = settings.episode_link_text ? settings.episode_link_text.trim() : '';

        var artStyle = '';
        if (settings.artwork && settings.artwork.url) {
            artStyle = ' style="background-image:url(' + _.escape(settings.artwork.url) + ');"';
        }
        #>
        <section class="feature" id="{{ sectionId }}">
            <# if (showHeader && (eyebrow || headerTitle)) { #>
                <div class="feature__head">
                    <div>
                        <# if (eyebrow) { #>
                            <span class="feature__eyebrow">{{{ eyebrow }}}</span>
                        <# } #>
                        <# if (headerTitle) { #>
                            <h2 class="display">{{{ headerTitle }}}</h2>
                        <# } #>
                    </div>
                    <# if (headLinkTxt && headLinkUrl) { #>
                        <a class="feature__cta-link" href="{{ headLinkUrl }}">{{{ headLinkTxt }}}</a>
                    <# } #>
                </div>
            <# } #>

            <article class="feature-card podcast-card">
                <div class="feature-card__media podcast-card__art"{{{ artStyle }}}>
                    <# if (epNum) { #>
                        <span class="podcast-card__series">{{{ epNum }}}</span>
                    <# } #>
                    <# if (showWave) { #>
                        <div class="podcast-card__wave">
                            <i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i>
                        </div>
                    <# } #>
                    <button class="feature-card__play-btn" type="button" aria-label="Play">&#9654;</button>
                </div>
                <div class="feature-card__info">
                    <div>
                        <# if (tags.length) { #>
                            <div class="feature-card__tags">
                                <# _.each(tags, function(t) { if (t.tag) { #>
                                    <span class="feature-card__tag">{{{ t.tag }}}</span>
                                <# } }); #>
                            </div>
                        <# } #>
                        <# if (title) { #>
                            <h3 class="feature-card__title">{{{ title }}}</h3>
                        <# } #>
                        <# if (description) { #>
                            <p class="feature-card__desc">{{{ description }}}</p>
                        <# } #>
                    </div>
                    <# if (linkText && epUrl) { #>
                        <a class="feature-card__more" href="{{ epUrl }}">{{{ linkText }}}</a>
                    <# } #>
                </div>
            </article>
        </section>
        <?php
    }
}
