<?php
/**
 * Site header.
 *
 * @package The_Optimize_Code
 */

if (!defined('ABSPATH')) {
    exit;
}

require get_template_directory() . '/template-parts/header-dynamic.php';
return;

$toc_is_home    = is_front_page();
$toc_is_testing = is_page('testing');
$toc_is_gallery = is_page('gallery');
$toc_brand_url  = $toc_is_home ? '#home' : home_url('/');
$toc_cta_url    = $toc_is_testing ? '#testing-options' : ($toc_is_home ? toc_page_url('testing') : toc_home_anchor('#contact'));
$toc_cta_text   = $toc_is_gallery ? 'Stay connected' : 'Explore your options';
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
<div class="site-loader" role="presentation" aria-hidden="true">
  <div class="site-loader__panel site-loader__panel--top"></div>
  <div class="site-loader__panel site-loader__panel--bottom"></div>
  <div class="site-loader__content">
    <div class="site-loader__brand"><span>THE OPTIMIZE CODE</span><span>EST. 2026</span></div>
    <div class="site-loader__counter"><span data-loader-count>50</span><sup>%</sup></div>
    <div class="site-loader__progress"><i></i></div>
    <div class="site-loader__meta"><span>LOADING SIGNAL</span><span>EDUCATION BEFORE ACTION</span></div>
  </div>
</div>
<header>
  <nav class="nav" id="topnav" aria-label="<?php esc_attr_e('Main navigation', 'the-optimize-code'); ?>">
    <a href="<?php echo esc_url($toc_brand_url); ?>" class="nav__brand">THE OPTIMIZE CODE</a>
    <div class="nav__right">
      <div class="nav__links">
        <a href="<?php echo $toc_is_home ? '#learn' : toc_home_anchor('#learn'); ?>">Learn</a>
        <a href="<?php echo toc_page_url('testing'); ?>"<?php echo $toc_is_testing ? ' aria-current="page"' : ''; ?>>Testing</a>
        <a href="<?php echo $toc_is_home ? '#podcast' : toc_home_anchor('#podcast'); ?>">Podcast</a>
        <a href="<?php echo toc_page_url('gallery'); ?>"<?php echo $toc_is_gallery ? ' aria-current="page"' : ''; ?>>Gallery</a>
        <a href="<?php echo $toc_is_home ? '#blueprint' : toc_home_anchor('#blueprint'); ?>">Blueprint</a>
      </div>
      <a href="<?php echo esc_url($toc_cta_url); ?>" class="pill"><span class="pill__dot"></span><?php echo esc_html($toc_cta_text); ?></a>
      <button class="theme-toggle" type="button" aria-label="Switch to light theme"><span class="theme-toggle__moon" aria-hidden="true">&#9790;</span><span class="theme-toggle__sun" aria-hidden="true">&#9728;</span></button>
      <button class="nav__toggle" type="button" aria-label="Open navigation menu" aria-expanded="false" aria-controls="mobile-navigation"><span></span><span></span></button>
    </div>
  </nav>
</header>
