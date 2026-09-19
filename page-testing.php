<?php
/**
 * Template Name: Testing Pathways
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
?>
<main>
  <section class="testing-hero">
    <div class="testing-hero__inner"><span class="feature__eyebrow">Personalized testing &middot; Education before action</span><h1>THE RIGHT TEST.<br><em>THE RIGHT PATH.</em></h1><div class="testing-hero__intro"><p>Testing should create useful context&mdash;not confusion. Explore two clearly separated pathways designed around the type of information each test provides.</p><a class="btn btn--primary" href="#testing-options">Compare pathways &rarr;</a></div></div>
  </section>
  <section class="services testing-page__options" id="testing-options">
    <div class="services__head"><div><span class="feature__eyebrow">Two pathways &middot; Designed responsibly</span><h2 class="display">Testing without<br>the guesswork.</h2></div><p>Different tests require different levels of support. Wellness testing may be available for direct purchase; pharmacogenomic testing follows a clinician-connected request pathway.</p></div>
    <div class="testing-grid">
      <article class="test-card test-card--wellness reveal"><div class="test-card__top"><span>01 / DIRECT PURCHASE</span><span class="test-card__status">WELLNESS</span></div><div><h3>Nutrigenomics<br>&amp; Wellness</h3><p>Explore how genetic variation may inform educational insights about nutrition, fitness and lifestyle.</p></div><ol><li>Choose an eligible test</li><li>Complete secure checkout</li><li>Collect and return your sample</li><li>Receive educational insights</li></ol><a class="btn btn--primary" href="<?php echo toc_home_anchor('#contact'); ?>">Explore wellness tests &rarr;</a></article>
      <article class="test-card test-card--pgx reveal"><div class="test-card__top"><span>02 / CLINICIAN-CONNECTED</span><span class="test-card__status">PGx</span></div><div><h3>Pharmacogenomic<br>Testing</h3><p>PGx explores how genetic variation may affect medication response. Requests require review and authorization by a licensed provider.</p></div><ol><li>Submit a testing request</li><li>Licensed provider review</li><li>Sample collection arranged</li><li>Results reviewed before release</li></ol><a class="btn btn--outline-lime" href="#pgx-request">Request PGx testing &rarr;</a><small>PGx testing is not available as a standard &ldquo;buy now&rdquo; product.</small></article>
    </div>
    <aside class="disclaimer" role="note"><strong>Educational use &amp; important notice</strong><p>The Optimize Code is a health education and personalized testing brand&mdash;not a medical clinic. Content and wellness results are for educational purposes and are not medical advice, diagnosis or treatment. PGx requests and results follow provider review; never start, stop or change medication without consulting a qualified clinician.</p></aside>
  </section>
  <section class="pgx-request" id="pgx-request"><div><span class="feature__eyebrow">Clinician-connected pathway</span><h2 class="display">Interested in PGx?</h2><p>Start with a secure request. A licensed provider must review and authorize testing before sample collection is arranged.</p></div><a class="btn btn--outline-lime" href="mailto:hello@theoptimizecode.com?subject=PGx%20testing%20request">Begin a PGx request &rarr;</a></section>
</main>
<?php
get_footer();
