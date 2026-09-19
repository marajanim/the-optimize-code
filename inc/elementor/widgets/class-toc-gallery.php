<?php
/**
 * TOC Gallery / Lightbox widget for Elementor Free.
 *
 * @package The_Optimize_Code
 */

if (!defined('ABSPATH')) {
    exit;
}

class TOC_Gallery_Widget extends \Elementor\Widget_Base
{
    /**
     * Get widget name.
     */
    public function get_name(): string
    {
        return 'toc-gallery';
    }

    /**
     * Get widget title.
     */
    public function get_title(): string
    {
        return esc_html__('TOC Gallery / Lightbox', 'the-optimize-code');
    }

    /**
     * Get widget icon.
     */
    public function get_icon(): string
    {
        return 'eicon-gallery-masonry';
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
        return ['gallery', 'lightbox', 'photos', 'images', 'wall', 'toc'];
    }

    /**
     * Register widget controls.
     */
    protected function register_controls(): void
    {
        $this->start_controls_section(
            'section_content_gallery',
            [
                'label' => esc_html__('Gallery Images', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_id',
            [
                'label'   => esc_html__('Section Anchor ID', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'gallery-wall',
            ]
        );

        $this->add_control(
            'aria_label',
            [
                'label'   => esc_html__('Accessibility Label', 'the-optimize-code'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Photo gallery', 'the-optimize-code'),
            ]
        );

        $this->add_control(
            'gallery',
            [
                'label'       => esc_html__('Select Images from Media Library', 'the-optimize-code'),
                'type'        => \Elementor\Controls_Manager::GALLERY,
                'default'     => [],
                'description' => esc_html__('Select images from your WordPress Media Library. If empty, the 18 default theme gallery images will be used.', 'the-optimize-code'),
            ]
        );

        $this->end_controls_section();

        // Style section
        $this->start_controls_section(
            'section_style_gallery',
            [
                'label' => esc_html__('Gallery Styling', 'the-optimize-code'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label'     => esc_html__('Columns', 'the-optimize-code'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '4',
                'options'   => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
                'selectors' => [
                    '{{WRAPPER}} .gallery-wall' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );

        $this->add_responsive_control(
            'gap',
            [
                'label'      => esc_html__('Grid Gap (px)', 'the-optimize-code'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 60,
                        'step' => 2,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .gallery-wall' => 'gap: {{SIZE}}{{UNIT}};',
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

        $section_id = toc_elementor_sanitize_id($settings['section_id'] ?? '', 'gallery-wall');
        $aria_label = !empty($settings['aria_label']) ? trim($settings['aria_label']) : __('Photo gallery', 'the-optimize-code');
        $gallery    = !empty($settings['gallery']) && is_array($settings['gallery']) ? $settings['gallery'] : [];

        // If gallery is populated from Media Library, render those images
        if (!empty($gallery)) {
            ?>
            <section class="gallery-wall" aria-label="<?php echo esc_attr($aria_label); ?>" id="<?php echo esc_attr($section_id); ?>">
                <?php foreach ($gallery as $index => $item) : ?>
                    <?php
                    $attachment_id = !empty($item['id']) ? (int) $item['id'] : 0;
                    $image_url     = !empty($item['url']) ? esc_url($item['url']) : '';
                    $alt_text      = $attachment_id ? get_post_meta($attachment_id, '_wp_attachment_image_alt', true) : '';
                    $alt_text      = $alt_text ?: sprintf(__('The Optimize Code gallery photograph %d', 'the-optimize-code'), $index + 1);
                    $loading       = 0 === $index ? 'eager' : 'lazy';
                    ?>
                    <button class="gallery-item" type="button" data-gallery-index="<?php echo esc_attr((string) $index); ?>" aria-label="<?php echo esc_attr(sprintf(__('Open gallery image %d', 'the-optimize-code'), $index + 1)); ?>">
                        <?php if ($attachment_id) : ?>
                            <?php echo wp_get_attachment_image($attachment_id, 'large', false, ['loading' => $loading, 'alt' => esc_attr($alt_text)]); ?>
                        <?php elseif ($image_url) : ?>
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($alt_text); ?>" loading="<?php echo esc_attr($loading); ?>">
                        <?php endif; ?>
                        <span><?php echo esc_html(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)); ?></span>
                    </button>
                <?php endforeach; ?>
            </section>
            <?php
            return;
        }

        // Fallback to the 18 default theme gallery files if no Media Library images are chosen yet
        $default_gallery = [
            ['WhatsApp Image 2026-09-01 at 19.19.04.jpeg', 'The Optimize Code gallery portrait'],
            ['WhatsApp Image 2026-09-01 at 19.19.54.jpeg', 'The Optimize Code event moment'],
            ['WhatsApp Image 2026-09-01 at 19.20.01.jpeg', 'The Optimize Code speaker portrait'],
            ['WhatsApp Image 2026-09-01 at 19.20.20.jpeg', 'The Optimize Code visual archive'],
            ['WhatsApp Image 2026-09-01 at 19.20.31.jpeg', 'The Optimize Code visual archive'],
            ['WhatsApp Image 2026-09-01 at 19.21.11.jpeg', 'The Optimize Code visual archive'],
            ['WhatsApp Image 2026-09-01 at 19.45.59.jpeg', 'The Optimize Code visual archive'],
            ['WhatsApp Image 2026-09-01 at 19.47.14.jpeg', 'The Optimize Code visual archive'],
            ['WhatsApp Image 2026-09-01 at 19.47.51.jpeg', 'The Optimize Code visual archive'],
            ['WhatsApp Image 2026-09-01 at 20.00.34.jpeg', 'The Optimize Code visual archive'],
            ['WhatsApp Image 2026-09-01 at 20.11.20.jpeg', 'The Optimize Code visual archive'],
            ['WhatsApp Image 2026-09-01 at 20.11.49.jpeg', 'The Optimize Code visual archive'],
            ['WhatsApp Image 2026-09-01 at 20.12.07.jpeg', 'The Optimize Code visual archive'],
            ['WhatsApp Image 2026-09-01 at 20.12.07 (1).jpeg', 'The Optimize Code visual archive'],
            ['WhatsApp Image 2026-09-01 at 21.52.31.jpeg', 'The Optimize Code visual archive'],
            ['WhatsApp Image 2026-09-01 at 21.58.57.jpeg', 'The Optimize Code visual archive'],
            ['WhatsApp Image 2026-09-01 at 21.59.29.jpeg', 'The Optimize Code visual archive'],
            ['WhatsApp Image 2026-09-01 at 22.01.26.jpeg', 'The Optimize Code visual archive'],
        ];
        ?>
        <section class="gallery-wall" aria-label="<?php echo esc_attr($aria_label); ?>" id="<?php echo esc_attr($section_id); ?>">
            <?php foreach ($default_gallery as $index => $item) : ?>
                <?php
                $image_url = get_template_directory_uri() . '/assets/images/client gallery image/' . rawurlencode($item[0]);
                $loading   = 0 === $index ? 'eager' : 'lazy';
                ?>
                <button class="gallery-item" type="button" data-gallery-index="<?php echo esc_attr((string) $index); ?>" aria-label="<?php echo esc_attr(sprintf(__('Open gallery image %d', 'the-optimize-code'), $index + 1)); ?>">
                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($item[1]); ?>" loading="<?php echo esc_attr($loading); ?>">
                    <span><?php echo esc_html(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)); ?></span>
                </button>
            <?php endforeach; ?>
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
        var sectionId = settings.section_id ? settings.section_id.trim() : 'gallery-wall';
        var ariaLabel = settings.aria_label ? settings.aria_label.trim() : 'Photo gallery';
        var gallery   = settings.gallery || [];
        #>
        <section class="gallery-wall" aria-label="{{ ariaLabel }}" id="{{ sectionId }}">
            <# if (gallery.length) { #>
                <# _.each(gallery, function(img, idx) {
                    var numStr = ('0' + (idx + 1)).slice(-2);
                #>
                    <button class="gallery-item" type="button" data-gallery-index="{{ idx }}">
                        <img src="{{ img.url }}" alt="Gallery photo {{ idx + 1 }}">
                        <span>{{{ numStr }}}</span>
                    </button>
                <# }); #>
            <# } else { #>
                <div class="toc-elementor-empty-state" style="grid-column: 1 / -1; padding: 30px; text-align: center; border: 1px dashed var(--line, #26322c);">
                    <p style="font-size: 13px; color: var(--sky, #edf4ef); margin: 0;">
                        {{{ '<?php echo esc_js(__('Select images from Media Library or default archive will be displayed.', 'the-optimize-code')); ?>' }}}
                    </p>
                </div>
            <# } #>
        </section>
        <?php
    }
}
