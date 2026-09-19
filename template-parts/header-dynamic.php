<?php
/** Dynamic site header markup. @package The_Optimize_Code */
if (!defined('ABSPATH')) { exit; }

$toc_brand_url       = is_front_page() ? '#home' : home_url('/');
$toc_brand_name      = (string) toc_get_theme_option('brand_name');
$toc_default_logo_id = (int) get_theme_mod('custom_logo');
$toc_logo_light_id   = (int) toc_get_theme_option('logo_light_id') ?: $toc_default_logo_id;
$toc_logo_dark_id    = (int) toc_get_theme_option('logo_dark_id') ?: $toc_logo_light_id;
$toc_logo_mobile_id  = (int) toc_get_theme_option('logo_mobile_id');
$toc_header_cta_url  = (string) toc_get_theme_option('header_cta_url');
$toc_header_cta_url  = $toc_header_cta_url ?: toc_page_url('testing');
$toc_header_cta_text = (string) toc_get_theme_option('header_cta_label');
$toc_cta_new_tab     = (bool) toc_get_theme_option('header_cta_new_tab');
$toc_announcement    = (bool) toc_get_theme_option('announcement_enabled') && toc_get_theme_option('announcement_text');
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <script>(function(){var t="dark";try{var s=localStorage.getItem("toc-theme-user");if(s==="dark"||s==="light")t=s}catch(e){}document.documentElement.dataset.theme=t;document.documentElement.classList.add("site-loading")})();</script>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php if (toc_get_theme_option('loader_enabled')) : ?>
<div class="site-loader" role="presentation" aria-hidden="true">
  <div class="site-loader__panel site-loader__panel--top"></div>
  <div class="site-loader__panel site-loader__panel--bottom"></div>
  <div class="site-loader__content">
    <div class="site-loader__brand"><span><?php echo esc_html((string) toc_get_theme_option('loader_brand')); ?></span><span><?php echo esc_html((string) toc_get_theme_option('loader_established')); ?></span></div>
    <div class="site-loader__counter"><span data-loader-count>50</span><sup>%</sup></div>
    <div class="site-loader__progress"><i></i></div>
    <div class="site-loader__meta"><span><?php echo esc_html((string) toc_get_theme_option('loader_status')); ?></span><span><?php echo esc_html((string) toc_get_theme_option('loader_message')); ?></span></div>
  </div>
</div>
<?php endif; ?>
<?php if ($toc_announcement) : ?>
  <aside class="site-announcement" aria-label="<?php esc_attr_e('Announcement', 'the-optimize-code'); ?>">
    <?php if (toc_get_theme_option('announcement_url')) : ?><a href="<?php echo esc_url((string) toc_get_theme_option('announcement_url')); ?>"><?php endif; ?>
      <?php echo esc_html((string) toc_get_theme_option('announcement_text')); ?>
    <?php if (toc_get_theme_option('announcement_url')) : ?></a><?php endif; ?>
  </aside>
<?php endif; ?>
<header>
  <nav class="nav" id="topnav" aria-label="<?php esc_attr_e('Main navigation', 'the-optimize-code'); ?>">
    <a href="<?php echo esc_url($toc_brand_url); ?>" class="nav__brand" aria-label="<?php echo esc_attr($toc_brand_name); ?>">
      <?php if ($toc_logo_light_id) : ?>
        <?php echo wp_get_attachment_image($toc_logo_light_id, 'full', false, ['class' => 'nav__brand-logo nav__brand-logo--light', 'alt' => '']); ?>
        <?php if ($toc_logo_dark_id !== $toc_logo_light_id) : echo wp_get_attachment_image($toc_logo_dark_id, 'full', false, ['class' => 'nav__brand-logo nav__brand-logo--dark', 'alt' => '']); endif; ?>
        <?php if ($toc_logo_mobile_id) : echo wp_get_attachment_image($toc_logo_mobile_id, 'full', false, ['class' => 'nav__brand-logo nav__brand-logo--mobile', 'alt' => '']); endif; ?>
        <span class="screen-reader-text"><?php echo esc_html($toc_brand_name); ?></span>
      <?php else : echo esc_html($toc_brand_name); endif; ?>
    </a>
    <div class="nav__right">
      <?php wp_nav_menu(['theme_location' => 'primary', 'container' => false, 'menu_class' => 'nav__links', 'menu_id' => 'primary-navigation', 'fallback_cb' => 'toc_primary_menu_fallback', 'depth' => 2]); ?>
      <?php if ($toc_header_cta_text && $toc_header_cta_url) : ?>
        <a href="<?php echo esc_url($toc_header_cta_url); ?>" class="pill"<?php echo $toc_cta_new_tab ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>><span class="pill__dot"></span><?php echo esc_html($toc_header_cta_text); ?></a>
      <?php endif; ?>
      <?php if (toc_get_theme_option('show_theme_toggle')) : ?>
        <button class="theme-toggle" type="button" aria-label="<?php esc_attr_e('Switch to light theme', 'the-optimize-code'); ?>"><span class="theme-toggle__moon" aria-hidden="true">&#9790;</span><span class="theme-toggle__sun" aria-hidden="true">&#9728;</span></button>
      <?php endif; ?>
      <button class="nav__toggle" type="button" aria-label="<?php esc_attr_e('Open navigation menu', 'the-optimize-code'); ?>" aria-expanded="false" aria-controls="mobile-navigation"><span></span><span></span></button>
    </div>
  </nav>
</header>
