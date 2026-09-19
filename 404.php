<?php
/**
 * Not-found template.
 *
 * @package The_Optimize_Code
 */

get_header();
?>
<main class="wp-page-content">
  <div class="wp-page-content__inner">
    <p class="feature__eyebrow">404 &middot; Signal not found</p>
    <h1>PAGE<br>NOT FOUND.</h1>
    <p>The page you were looking for is no longer here or may have moved.</p>
    <p><a class="btn btn--primary" href="<?php echo esc_url(home_url('/')); ?>">Return home &rarr;</a></p>
  </div>
</main>
<?php
get_footer();

