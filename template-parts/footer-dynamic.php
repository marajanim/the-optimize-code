<?php
/** Dynamic site footer markup. @package The_Optimize_Code */
if (!defined('ABSPATH')) { exit; }

$toc_footer_explore = [
    ['label' => __('Podcast', 'the-optimize-code'), 'url' => toc_home_anchor('#podcast')],
    ['label' => __('Education hub', 'the-optimize-code'), 'url' => toc_home_anchor('#education')],
    ['label' => __('Gallery', 'the-optimize-code'), 'url' => toc_page_url('gallery')],
    ['label' => __('Blueprint', 'the-optimize-code'), 'url' => toc_home_anchor('#blueprint')],
];
$toc_footer_services = [
    ['label' => __('Wellness testing', 'the-optimize-code'), 'url' => toc_page_url('testing', '#testing-options')],
    ['label' => __('Request PGx', 'the-optimize-code'), 'url' => toc_page_url('testing', '#pgx-request')],
    ['label' => __('How it works', 'the-optimize-code'), 'url' => toc_page_url('testing', '#testing-options')],
];
$toc_social_profiles = [
    'facebook'  => ['symbol' => 'f', 'url' => (string) toc_get_theme_option('facebook_url')],
    'tiktok'    => ['symbol' => '♪', 'url' => (string) toc_get_theme_option('tiktok_url')],
    'instagram' => ['symbol' => '◎', 'url' => (string) toc_get_theme_option('instagram_url')],
    'youtube'   => ['symbol' => '▶', 'url' => (string) toc_get_theme_option('youtube_url')],
    'linkedin'  => ['symbol' => 'in', 'url' => (string) toc_get_theme_option('linkedin_url')],
    'email'     => ['symbol' => '@', 'url' => sanitize_email((string) toc_get_theme_option('social_email'))],
];
?>
<footer class="footer">
  <div class="footer__inner">
    <div class="footer__cols">
      <div>
        <?php if (toc_get_theme_option('footer_logo_id')) : ?>
          <a class="footer__logo" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr((string) toc_get_theme_option('brand_name')); ?>"><?php echo wp_get_attachment_image((int) toc_get_theme_option('footer_logo_id'), 'full', false, ['alt' => '']); ?></a>
        <?php else : ?>
          <h2 class="footer__brand"><?php echo esc_html((string) toc_get_theme_option('short_brand_name')); ?></h2>
        <?php endif; ?>
        <p><?php echo esc_html((string) toc_get_theme_option('footer_description')); ?></p>
      </div>
      <div>
        <h3><?php echo esc_html((string) toc_get_theme_option('footer_explore_title')); ?></h3>
        <?php if (has_nav_menu('footer_explore')) { wp_nav_menu(['theme_location' => 'footer_explore', 'container' => false, 'menu_class' => 'footer-menu', 'depth' => 1, 'fallback_cb' => false]); } else { toc_footer_fallback_links($toc_footer_explore); } ?>
      </div>
      <div>
        <h3><?php echo esc_html((string) toc_get_theme_option('footer_services_title')); ?></h3>
        <?php if (has_nav_menu('footer_services')) { wp_nav_menu(['theme_location' => 'footer_services', 'container' => false, 'menu_class' => 'footer-menu', 'depth' => 1, 'fallback_cb' => false]); } else { toc_footer_fallback_links($toc_footer_services); } ?>
      </div>
      <div>
        <h3><?php echo esc_html((string) toc_get_theme_option('footer_social_title')); ?></h3>
        <ul class="footer-socials">
          <?php foreach ($toc_social_profiles as $toc_platform => $toc_profile) : ?>
            <?php
            if (!toc_get_theme_option($toc_platform . '_enabled') || !$toc_profile['url']) { continue; }
            $toc_label = (string) toc_get_theme_option($toc_platform . '_label');
            $toc_url = 'email' === $toc_platform ? 'mailto:' . $toc_profile['url'] : $toc_profile['url'];
            ?>
            <li><a class="footer-social footer-social--<?php echo esc_attr($toc_platform); ?>" href="<?php echo esc_url($toc_url); ?>" aria-label="<?php echo esc_attr($toc_label); ?>"<?php echo 'email' === $toc_platform ? '' : ' target="_blank" rel="noopener noreferrer"'; ?>><span class="footer-social__icon" aria-hidden="true"><span class="footer-social__monogram"><?php echo esc_html($toc_profile['symbol']); ?></span></span><span><?php echo esc_html($toc_label); ?></span></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
    <div class="footer__meta" id="legal">
      <span><?php echo esc_html(toc_copyright_text()); ?></span>
      <span><?php echo esc_html((string) toc_get_theme_option('footer_legal_text')); ?></span>
      <?php if (has_nav_menu('footer_legal')) : ?><nav aria-label="<?php esc_attr_e('Legal navigation', 'the-optimize-code'); ?>"><?php wp_nav_menu(['theme_location' => 'footer_legal', 'container' => false, 'menu_class' => 'footer-legal-menu', 'depth' => 1, 'fallback_cb' => false]); ?></nav><?php endif; ?>
    </div>
    <?php if (toc_get_theme_option('footer_watermark_show') && toc_get_theme_option('footer_watermark')) : ?><div class="footer__watermark"><?php echo esc_html((string) toc_get_theme_option('footer_watermark')); ?></div><?php endif; ?>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
