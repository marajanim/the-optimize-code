<?php
/**
 * Front page template.
 *
 * @package The_Optimize_Code
 */

get_header();
?>
<main>
  <section class="opt-hero" id="home" aria-labelledby="hero-title">
    <div class="opt-hero__image" role="img" aria-label="Health educator recording a personalized wellness podcast in a modern studio"></div>
    <div class="opt-hero__shade"></div>
    <div class="opt-hero__grid"></div>
    <div class="opt-hero__content">
      <div class="opt-kicker"><span>[ PERSONALIZED HEALTH EDUCATION ]</span><span>GENETICS &middot; NUTRITION &middot; LONGEVITY</span></div>
      <h1 id="hero-title"><span class="hero-title__line">YOUR HEALTH.</span><span class="hero-title__line hero-title__line--accent">DECODED.</span></h1>
      <p>Clear, grounded education at the intersection of your genes, nutrition, lifestyle and long-term wellbeing&mdash;without the clinic-speak.</p>
      <div class="opt-hero__actions"><a class="btn btn--primary" href="#podcast">Listen to the podcast &rarr;</a><a class="btn" href="<?php echo toc_page_url('testing'); ?>">Explore testing</a></div>
    </div>
    <div class="opt-hero__rail"><span>THE OPTIMIZE CODE / 001</span><span>EDUCATION BEFORE ACTION</span></div>
  </section>

  <div class="ticker" aria-hidden="true">
    <div class="ticker__track"><span>Know your code</span><span class="sep" aria-label="medical plus">+</span><span>Ask better questions</span><span class="sep" aria-label="medical plus">+</span><span>Build better habits</span><span class="sep" aria-label="medical plus">+</span><span>Live with intention</span><span class="sep" aria-label="medical plus">+</span><span>Know your code</span><span class="sep" aria-label="medical plus">+</span><span>Ask better questions</span><span class="sep" aria-label="medical plus">+</span></div>
  </div>

  <section class="feature" id="podcast">
    <div class="feature__head">
      <div><span class="feature__eyebrow">The Optimize Code Podcast &middot; Latest episode</span>
        <h2 class="display">Science you can use.<br>Conversations worth keeping.</h2>
      </div><a class="feature__cta-link" href="#episodes">Browse episodes &rarr;</a>
    </div>
    <article class="feature-card podcast-card reveal">
      <div class="feature-card__media podcast-card__art"><span class="podcast-card__series">EP / 018</span>
        <div class="podcast-card__wave"><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></div><button class="feature-card__play-btn" type="button" aria-label="Play episode preview">&#9654;</button>
      </div>
      <div class="feature-card__info">
        <div>
          <div class="feature-card__tags"><span class="feature-card__tag">Nutrigenomics</span><span class="feature-card__tag">42 min</span></div>
          <h3 class="feature-card__title">Your genes are<br>not your <em>destiny.</em></h3>
          <p class="feature-card__desc">A practical conversation about what genetic insights can&mdash;and cannot&mdash;tell you about food, movement and everyday choices.</p>
        </div><a class="feature-card__more" href="#episodes">Listen to episode &rarr;</a>
      </div>
    </article>
  </section>

  <section class="receipts" id="learn">
    <div class="receipts__head">
      <h2 class="display">Make the complex<br>feel usable.</h2>
      <p>Personalized health should create clarity, not anxiety. We translate emerging science into thoughtful education so you can understand the context, limits and questions that matter.</p>
    </div>
    <div class="receipts__grid">
      <a class="stat-card" href="#education">
        <div class="stat-card__top"><span class="idx">01 /</span><span>Understand</span></div>
        <div>
          <div class="stat-card__glyph">DNA</div>
          <div class="stat-card__title">Genetics, in context</div>
          <div class="stat-card__desc">Learn how inherited variation may relate to nutrition, wellness and medication response.</div>
        </div><span class="stat-card__arrow">&rarr;</span>
      </a>
      <a class="stat-card" href="#education">
        <div class="stat-card__top"><span class="idx">02 /</span><span>Nourish</span></div>
        <div>
          <div class="stat-card__glyph">FOOD</div>
          <div class="stat-card__title">Nutrition, personalized</div>
          <div class="stat-card__desc">Explore food through evidence, individuality and sustainable everyday decisions.</div>
        </div><span class="stat-card__arrow">&rarr;</span>
      </a>
      <a class="stat-card" href="#education">
        <div class="stat-card__top"><span class="idx">03 /</span><span>Prevent</span></div>
        <div>
          <div class="stat-card__glyph">LIFE</div>
          <div class="stat-card__title">Longevity, grounded</div>
          <div class="stat-card__desc">Separate durable health foundations from shiny, short-lived wellness trends.</div>
        </div><span class="stat-card__arrow">&rarr;</span>
      </a>
      <a class="stat-card" href="#podcast">
        <div class="stat-card__top"><span class="idx">04 /</span><span>Listen</span></div>
        <div>
          <div class="stat-card__glyph">PLAY</div>
          <div class="stat-card__title">Experts, translated</div>
          <div class="stat-card__desc">Hear nuanced conversations with practitioners, researchers and educators.</div>
        </div><span class="stat-card__arrow">&rarr;</span>
      </a>
    </div>
  </section>

  <section class="story" id="blueprint">
    <div class="story__grid">
      <div class="story__text reveal"><span class="stamp">The Optimize Blueprint</span>
        <h2 class="display">Your data is a<br>starting point.<br><em>Not a verdict.</em></h2>
        <p>The Optimize Blueprint brings education, personal context and next-step questions into one understandable framework. It is designed to help you learn&mdash;not to diagnose, prescribe or replace care from a licensed professional.</p><a class="btn btn--primary" href="#contact">Join the Blueprint waitlist &rarr;</a>
      </div>
      <div class="blueprint-art reveal">
        <div class="blueprint-art__system" aria-label="Animated orbit diagram showing genes, nutrition, lifestyle and context around your code">
          <span class="blueprint-art__core">YOUR<br>CODE</span>
          <div class="blueprint-art__orbital blueprint-art__orbital--genes"><div class="blueprint-art__rotor"><i>GENES</i></div></div>
          <div class="blueprint-art__orbital blueprint-art__orbital--nutrition"><div class="blueprint-art__rotor"><i>NUTRITION</i></div></div>
          <div class="blueprint-art__orbital blueprint-art__orbital--lifestyle"><div class="blueprint-art__rotor"><i>LIFESTYLE</i></div></div>
          <div class="blueprint-art__orbital blueprint-art__orbital--context"><div class="blueprint-art__rotor"><i>CONTEXT</i></div></div>
        </div>
      </div>
    </div>
  </section>

  <section class="process">
    <div class="process__head">
      <div><span class="feature__eyebrow">A clearer path forward</span>
        <h2 class="display">Learn first.<br>Test thoughtfully.</h2>
      </div>
    </div>
    <div class="process__scroll">
      <article class="process-step">
        <div><div class="process-step__stage">Stage 1 &middot; Explore</div><h4>Start with education</h4><p>Use the podcast and learning hub to understand the science, benefits and limitations.</p></div>
        <div class="process-step__number">01</div>
      </article>
      <article class="process-step">
        <div><div class="process-step__stage">Stage 2 &middot; Consider</div><h4>Choose the right pathway</h4><p>Review whether a wellness test or clinician-connected PGx request fits your goal.</p></div>
        <div class="process-step__number">02</div>
      </article>
      <article class="process-step">
        <div><div class="process-step__stage">Stage 3 &middot; Collect</div><h4>Follow kit instructions</h4><p>If eligible and ordered, collect your sample using the instructions supplied with your kit.</p></div>
        <div class="process-step__number">03</div>
      </article>
      <article class="process-step">
        <div><div class="process-step__stage">Stage 4 &middot; Understand</div><h4>Put results in context</h4><p>Read results as educational information and involve a qualified professional where appropriate.</p></div>
        <div class="process-step__number">04</div>
      </article>
    </div>
  </section>

  <section class="education-hub" id="education">
    <div class="education-hub__head"><span class="feature__eyebrow">Education hub</span>
      <h2 class="display">Read. Watch.<br>Question. Repeat.</h2>
    </div>
    <div class="article-grid" id="episodes">
      <article class="article-card article-card--featured"><span>FEATURED GUIDE &middot; 8 MIN</span>
        <h3>What a genetic test can actually tell you</h3>
        <p>A calm, practical guide to probabilities, limitations and useful next questions.</p><a href="#contact">Read the guide &rarr;</a>
      </article>
      <article class="article-card"><span>PODCAST &middot; EP 017</span>
        <h3>Food, genes and the myth of one perfect diet</h3><a href="#podcast">Listen now &rarr;</a>
      </article>
      <article class="article-card"><span>VIDEO &middot; 06:20</span>
        <h3>PGx: five things to understand before testing</h3><a href="<?php echo toc_page_url('testing'); ?>">Watch explainer &rarr;</a>
      </article>
    </div>
  </section>

  <section class="cta" id="contact">
    <div class="cta__grid">
      <div class="cta__copy"><span class="feature__eyebrow">Stay curious</span>
        <h2>Build your<br>health literacy.<br><em>One signal at a time.</em></h2>
        <p class="cta__sub">Get new podcast episodes, educational guides and testing updates in your inbox. No miracle claims. No fear-based wellness.</p>
        <div class="cta__features"><span>Evidence-aware education</span><span>New episode notes</span><span>Product updates</span></div>
      </div>
      <form class="contact-form" action="#" method="post">
        <div class="form-field"><label for="name">Your name</label><input id="name" name="name" autocomplete="name" required placeholder="Alex Morgan"></div>
        <div class="form-field"><label for="email">Email address</label><input id="email" name="email" type="email" autocomplete="email" required placeholder="alex@example.com"></div>
        <div class="form-field"><label for="interest">I'm interested in</label><select id="interest" name="interest">
          <option>Podcast &amp; education</option>
          <option>Nutrigenomics / wellness testing</option>
          <option>The Optimize Blueprint</option>
          <option>PGx testing information</option>
        </select></div>
        <div class="form-submit"><span class="form-submit__note">Education, not inbox overload.</span><button class="btn btn--primary" type="submit">Keep me informed &rarr;</button></div>
        <p class="form-message" aria-live="polite"></p>
      </form>
    </div>
  </section>
</main>
<?php
get_footer();

