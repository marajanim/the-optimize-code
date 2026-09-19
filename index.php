<?php
/**
 * WordPress fallback template.
 *
 * @package The_Optimize_Code
 */

get_header();
?>
<main class="wp-page-content">
  <div class="wp-page-content__inner">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
          <div class="entry-content"><?php the_content(); ?></div>
        </article>
      <?php endwhile; ?>
      <?php the_posts_navigation(); ?>
    <?php else : ?>
      <h1><?php esc_html_e('Nothing found.', 'the-optimize-code'); ?></h1>
    <?php endif; ?>
  </div>
</main>
<?php
get_footer();

