<?php
/**
 * Default page template.
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
?>
<main class="wp-page-content">
  <div class="wp-page-content__inner">
    <?php while (have_posts()) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h1><?php the_title(); ?></h1>
        <div class="entry-content"><?php the_content(); ?></div>
      </article>
    <?php endwhile; ?>
  </div>
</main>
<?php
get_footer();
