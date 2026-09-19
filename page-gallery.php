<?php
/**
 * Template Name: Gallery
 * Template Post Type: page
 *
 * @package The_Optimize_Code
 */

get_header();

if (toc_is_elementor_page()) {
    ?>
    <main id=primary class=toc-elementor-content>
      <?php toc_render_full_width_content(); ?>
    </main>
    <?php
    get_footer();
    return;
}

$toc_gallery_images = [
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
<main>
  <section class="gallery-hero"><span class="feature__eyebrow">Visual archive &middot; People, places, conversations</span><h1>IN THE ROOM.<br><em>OUT IN THE WORLD.</em></h1><div class="gallery-hero__meta"><p>A collection of conversations, stages, adventures and moments behind The Optimize Code.</p><span>18 photographs &middot; Updated 2026</span></div></section>
  <section class="gallery-wall" aria-label="Photo gallery">
    <?php foreach ($toc_gallery_images as $toc_index => $toc_image) : ?>
      <?php $toc_image_url = get_template_directory_uri() . '/assets/images/client gallery image/' . rawurlencode($toc_image[0]); ?>
      <button class="gallery-item" type="button" data-gallery-index="<?php echo esc_attr((string) $toc_index); ?>" aria-label="<?php echo esc_attr(sprintf('Open gallery image %d', $toc_index + 1)); ?>"><img src="<?php echo esc_url($toc_image_url); ?>" alt="<?php echo esc_attr($toc_image[1]); ?>" loading="<?php echo 0 === $toc_index ? 'eager' : 'lazy'; ?>"><span><?php echo esc_html(str_pad((string) ($toc_index + 1), 2, '0', STR_PAD_LEFT)); ?></span></button>
    <?php endforeach; ?>
  </section>
</main>
<?php
get_footer();
