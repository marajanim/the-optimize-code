<?php
/**
 * Site footer.
 *
 * @package The_Optimize_Code
 */

if (!defined('ABSPATH')) {
    exit;
}

require get_template_directory() . '/template-parts/footer-dynamic.php';
return;

$toc_is_home    = is_front_page();
$toc_is_testing = is_page('testing');
$toc_is_gallery = is_page('gallery');
?>
<footer class="footer">
  <div class="footer__inner">
    <div class="footer__cols">
      <div>
        <h2 class="footer__brand">TOC</h2>
        <p>Personalized health education for people who want context, clarity and better questions.</p>
      </div>
      <div>
        <h3>Explore</h3>
        <ul>
          <li><a href="<?php echo $toc_is_home ? '#podcast' : toc_home_anchor('#podcast'); ?>">Podcast</a></li>
          <li><a href="<?php echo $toc_is_home ? '#education' : toc_home_anchor('#education'); ?>">Education hub</a></li>
          <li><a href="<?php echo toc_page_url('gallery'); ?>"<?php echo $toc_is_gallery ? ' aria-current="page"' : ''; ?>>Gallery</a></li>
          <li><a href="<?php echo $toc_is_home ? '#blueprint' : toc_home_anchor('#blueprint'); ?>">Blueprint</a></li>
        </ul>
      </div>
      <div>
        <h3>Testing</h3>
        <ul>
          <li><a href="<?php echo $toc_is_testing ? '#testing-options' : toc_page_url('testing', '#testing-options'); ?>">Wellness testing</a></li>
          <li><a href="<?php echo $toc_is_testing ? '#pgx-request' : toc_page_url('testing', '#pgx-request'); ?>">Request PGx</a></li>
          <li><a href="<?php echo $toc_is_testing ? '#testing-options' : toc_page_url('testing', '#testing-options'); ?>">How it works</a></li>
        </ul>
      </div>
      <div>
        <h3>Social Media</h3>
        <ul class="footer-socials">
          <li><a class="footer-social footer-social--facebook" href="https://www.facebook.com/share/14p52fPZgAu/" aria-label="Facebook" target="_blank" rel="noopener noreferrer"><span class="footer-social__icon"><img src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/icons/facebook.svg" width="16" height="16" alt="" aria-hidden="true" loading="lazy" decoding="async"></span><span>Facebook</span></a></li>
          <li><a class="footer-social footer-social--tiktok" href="https://www.tiktok.com/@theoptimizecode?_r=1&amp;_t=ZP-99N1JR87JVe" aria-label="TikTok" target="_blank" rel="noopener noreferrer"><span class="footer-social__icon"><img src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/icons/tiktok.svg" width="16" height="16" alt="" aria-hidden="true" loading="lazy" decoding="async"></span><span>TikTok</span></a></li>
          <li><a class="footer-social footer-social--instagram" href="https://www.instagram.com/theoptimizecode" aria-label="Instagram" target="_blank" rel="noopener noreferrer"><span class="footer-social__icon"><img src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/icons/instagram.svg" width="16" height="16" alt="" aria-hidden="true" loading="lazy" decoding="async"></span><span>Instagram</span></a></li>
          <li><a class="footer-social footer-social--youtube" href="https://www.youtube.com/channel/UC2V08b8hIuP66p6lFf4P1WA" aria-label="YouTube" target="_blank" rel="noopener noreferrer"><span class="footer-social__icon"><img src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/icons/youtube.svg" width="16" height="16" alt="" aria-hidden="true" loading="lazy" decoding="async"></span><span>YouTube</span></a></li>
          <li><a class="footer-social footer-social--linkedin" href="https://www.linkedin.com/company/theoptimizecode" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer"><span class="footer-social__icon"><img src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/icons/linkedin.svg" width="16" height="16" alt="" aria-hidden="true" loading="lazy" decoding="async"></span><span>LinkedIn</span></a></li>
          <li><a class="footer-social footer-social--email" href="mailto:Hello@theoptimizecode.com" aria-label="Email"><span class="footer-social__icon"><img src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/icons/envelope-fill.svg" width="16" height="16" alt="" aria-hidden="true" loading="lazy" decoding="async"></span><span>Email</span></a></li>
        </ul>
      </div>
    </div>
    <div class="footer__meta" id="legal"><span>&copy; <?php echo esc_html(wp_date('Y')); ?> The Optimize Code</span><span>Educational content only &middot; Not medical advice &middot; Not a medical clinic</span></div>
    <div class="footer__watermark">OPTIMIZE</div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
