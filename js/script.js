/* The Optimize Code — interaction layer */
'use strict';

function initNav() {
  const nav = document.getElementById('topnav');
  if (!nav) return;
  const update = () => nav.classList.toggle('scrolled', window.scrollY > 40);
  update();
  window.addEventListener('scroll', update, { passive: true });
}

function initMobileMenu() {
  const nav = document.getElementById('topnav');
  const navRight = nav?.querySelector('.nav__right');
  const desktopLinks = nav?.querySelector('.nav__links');
  if (!nav || !navRight || !desktopLinks) return;

  let toggle = navRight.querySelector('.nav__toggle');
  if (!toggle) {
    toggle = document.createElement('button');
    toggle.className = 'nav__toggle';
    toggle.type = 'button';
    toggle.innerHTML = '<span></span><span></span>';
    navRight.appendChild(toggle);
  }
  toggle.setAttribute('aria-label', 'Open navigation menu');
  toggle.setAttribute('aria-expanded', 'false');
  toggle.setAttribute('aria-controls', 'mobile-navigation');

  const syncToggle = () => {
    toggle.style.display = window.matchMedia('(max-width: 1023px)').matches ? 'grid' : 'none';
  };
  syncToggle();

  let menu = document.getElementById('mobile-navigation');
  if (!menu) {
    menu = document.createElement('div');
    menu.className = 'mobile-menu';
    menu.id = 'mobile-navigation';
    document.body.appendChild(menu);
  }
  menu.setAttribute('aria-hidden', 'true');
  const links = [...desktopLinks.querySelectorAll('a')]
    .map(link => link.outerHTML)
    .join('');
  const cta = navRight.querySelector('.pill');
  menu.innerHTML = `<div class=mobile-menu__links>${links}</div>${cta ? `<div class=mobile-menu__cta>${cta.outerHTML}</div>` : ''}<div class=mobile-menu__meta><span>THE OPTIMIZE CODE</span><span>EDUCATION · PODCAST · WELLNESS</span></div>`;

  const setOpen = open => {
    document.body.classList.toggle('menu-open', open);
    toggle.classList.toggle('is-open', open);
    toggle.setAttribute('aria-expanded', String(open));
    toggle.setAttribute('aria-label', open ? 'Close navigation menu' : 'Open navigation menu');
    menu.setAttribute('aria-hidden', String(!open));
  };
  toggle.addEventListener('click', () => setOpen(!document.body.classList.contains('menu-open')));
  menu.querySelectorAll('a').forEach(link => link.addEventListener('click', () => setOpen(false)));
  window.addEventListener('keydown', event => {
    if (event.key === 'Escape') setOpen(false);
  });
  window.addEventListener('resize', () => {
    syncToggle();
    if (window.innerWidth > 1023) setOpen(false);
  }, { passive: true });
}

function initThemeToggle() {
  const navRight = document.querySelector('.nav__right');
  if (!navRight) return;
  let toggle = navRight.querySelector('.theme-toggle');
  if (!toggle) {
    toggle = document.createElement('button');
    toggle.className = 'theme-toggle';
    toggle.type = 'button';
    toggle.innerHTML = '<span class=theme-toggle__moon aria-hidden=true>&#9790;</span><span class=theme-toggle__sun aria-hidden=true>&#9728;</span>';
    navRight.insertBefore(toggle, navRight.querySelector('.nav__toggle'));
  }

  const apply = (theme, persist = false) => {
    document.documentElement.dataset.theme = theme;
    toggle.setAttribute('aria-label', theme === 'dark' ? 'Switch to light theme' : 'Switch to dark theme');
    toggle.setAttribute('title', theme === 'dark' ? 'Light theme' : 'Dark theme');
    if (persist) {
      try { localStorage.setItem('toc-theme-user', theme); } catch (error) { /* Storage can be unavailable. */ }
    }
  };
  apply(document.documentElement.dataset.theme === 'dark' ? 'dark' : 'light');
  toggle.addEventListener('click', () => {
    apply(document.documentElement.dataset.theme === 'dark' ? 'light' : 'dark', true);
  });
}

function initPremiumMotion() {
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const selectors = [
    '.nav__brand', '.nav__links a', '.nav .pill',
    '.opt-kicker', '.opt-hero h1', '.opt-hero__content > p',
    '.opt-hero__actions .btn', '.opt-hero__rail', '.ticker',
    '.feature__head .feature__eyebrow', '.feature__head .display',
    '.feature__cta-link', '.feature-card',
    '.receipts__head > *', '.stat-card',
    '.story__text > *', '.blueprint-art',
    '.services__head .feature__eyebrow', '.services__head .display',
    '.services__head > p', '.test-card', '.disclaimer',
    '.process__head .feature__eyebrow', '.process__head .display', '.process-step',
    '.education-hub__head > *', '.article-card',
    '.cta__copy > *', '.form-field', '.form-submit',
    '.pgx-request .feature__eyebrow', '.pgx-request .display',
    '.pgx-request p', '.pgx-request > .btn',
    '.footer__cols > *', '.footer__meta',
    '.testing-hero .feature__eyebrow', '.testing-hero h1',
    '.testing-hero__intro > *', '.gallery-hero > *', '.gallery-item'
  ];
  const items = [...new Set(document.querySelectorAll(selectors.join(',')))];

  if (reduceMotion || !('IntersectionObserver' in window)) {
    document.documentElement.classList.add('motion-reduced');
    items.forEach(item => item.classList.add('in', 'is-visible'));
    return;
  }

  document.documentElement.classList.add('motion-ready');
  const groups = new Map();

  items.forEach(item => {
    const group = item.closest('section, footer, header') || document.body;
    const groupItems = groups.get(group) || [];
    groupItems.push(item);
    groups.set(group, groupItems);

    item.classList.add('motion-item');
    if (item.matches('.feature-card,.stat-card,.test-card,.process-step,.article-card,.blueprint-art,.cta__grid,.gallery-item')) {
      item.dataset.motion = 'scale';
    } else if (item.matches('.services__head > p,.receipts__head > p,.pgx-request > .btn')) {
      item.dataset.motion = 'from-right';
    } else {
      item.dataset.motion = 'rise';
    }
  });

  groups.forEach(groupItems => {
    groupItems.forEach((item, index) => {
      item.style.setProperty('--motion-delay', `${Math.min(index, 6) * 75}ms`);
    });
  });

  const show = item => {
    item.classList.add('is-visible', 'in');
  };
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      show(entry.target);
      observer.unobserve(entry.target);
    });
  }, { threshold: 0.01, rootMargin: '0px 0px 6% 0px' });

  items.forEach(item => {
    if (item.closest('header,.opt-hero,.testing-hero')) {
      // Allow the browser to paint the initial blurred state before revealing.
      window.requestAnimationFrame(() => {
        window.requestAnimationFrame(() => show(item));
      });
    } else {
      observer.observe(item);
    }
  });

  // Safety pass: anything already inside the viewport must never remain hidden.
  window.setTimeout(() => {
    items.forEach(item => {
      const bounds = item.getBoundingClientRect();
      if (bounds.top < window.innerHeight && bounds.bottom > 0) show(item);
    });
  }, 900);

  // Mobile browsers can skip observer frames during fast momentum scrolling.
  let revealTicking = false;
  const revealVisibleItems = () => {
    items.forEach(item => {
      if (item.classList.contains('is-visible')) return;
      const bounds = item.getBoundingClientRect();
      if (bounds.top < window.innerHeight * 1.08 && bounds.bottom > -40) show(item);
    });
    revealTicking = false;
  };
  window.addEventListener('scroll', () => {
    if (revealTicking) return;
    revealTicking = true;
    window.requestAnimationFrame(revealVisibleItems);
  }, { passive: true });
}

function initScrollPolish() {
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
  const progress = document.createElement('div');
  progress.className = 'scroll-progress';
  progress.setAttribute('aria-hidden', 'true');
  document.body.appendChild(progress);

  const heroImage = document.querySelector('.opt-hero__image');
  let ticking = false;
  const update = () => {
    const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
    const ratio = maxScroll > 0 ? Math.min(window.scrollY / maxScroll, 1) : 0;
    progress.style.transform = `scaleX(${ratio})`;
    if (heroImage && window.scrollY < window.innerHeight * 1.2) {
      heroImage.style.setProperty('--hero-shift', `${Math.min(window.scrollY * 0.08, 56)}px`);
    }
    ticking = false;
  };
  window.addEventListener('scroll', () => {
    if (ticking) return;
    ticking = true;
    window.requestAnimationFrame(update);
  }, { passive: true });
  update();
}

function initSignup() {
  const form = document.querySelector('.contact-form');
  if (!form) return;
  form.addEventListener('submit', event => {
    event.preventDefault();
    if (!form.reportValidity()) return;
    const button = form.querySelector('button[type="submit"]');
    const message = form.querySelector('.form-message');
    button.disabled = true;
    button.textContent = 'You\u2019re on the list \u2713';
    message.textContent = 'Thanks \u2014 watch your inbox for thoughtful health education.';
    window.setTimeout(() => {
      button.disabled = false;
      button.textContent = 'Keep me informed \u2192';
    }, 3000);
  });
}

function initEpisodePreview() {
  const button = document.querySelector('.feature-card__play-btn');
  if (!button) return;
  button.addEventListener('click', () => {
    const playing = button.dataset.playing === 'true';
    button.dataset.playing = String(!playing);
    button.textContent = playing ? '\u25B6' : '\u2016';
    button.setAttribute('aria-label', playing ? 'Play episode preview' : 'Pause episode preview');
  });
}

function initGalleryLightbox() {
  const items = [...document.querySelectorAll('.gallery-item')];
  if (!items.length) return;
  const viewer = document.createElement('div');
  viewer.className = 'gallery-viewer';
  viewer.setAttribute('role', 'dialog');
  viewer.setAttribute('aria-modal', 'true');
  viewer.setAttribute('aria-hidden', 'true');
  viewer.innerHTML = '<button class=gallery-viewer__close aria-label=Close>&times;</button><button class=gallery-viewer__prev aria-label=Previous>&larr;</button><figure><img alt=""><figcaption></figcaption></figure><button class=gallery-viewer__next aria-label=Next>&rarr;</button>';
  document.body.appendChild(viewer);
  const displayImage = viewer.querySelector('img');
  const caption = viewer.querySelector('figcaption');
  let active = 0;
  const render = index => {
    active = (index + items.length) % items.length;
    const source = items[active].querySelector('img');
    displayImage.src = source.currentSrc || source.src;
    displayImage.alt = source.alt;
    caption.textContent = `${String(active + 1).padStart(2, '0')} / ${items.length}`;
  };
  const close = () => {
    viewer.classList.remove('is-open');
    viewer.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('gallery-open');
  };
  items.forEach((item, index) => item.addEventListener('click', () => {
    render(index);
    viewer.classList.add('is-open');
    viewer.setAttribute('aria-hidden', 'false');
    document.body.classList.add('gallery-open');
    viewer.querySelector('.gallery-viewer__close').focus();
  }));
  viewer.querySelector('.gallery-viewer__close').addEventListener('click', close);
  viewer.querySelector('.gallery-viewer__prev').addEventListener('click', () => render(active - 1));
  viewer.querySelector('.gallery-viewer__next').addEventListener('click', () => render(active + 1));
  viewer.addEventListener('click', event => { if (event.target === viewer) close(); });
  window.addEventListener('keydown', event => {
    if (!viewer.classList.contains('is-open')) return;
    if (event.key === 'Escape') close();
    if (event.key === 'ArrowLeft') render(active - 1);
    if (event.key === 'ArrowRight') render(active + 1);
  });
}

document.addEventListener('DOMContentLoaded', () => {
  initSiteLoader();
  initHeroCinematic();
  initReceiptsCinematic();
  initBlueprintCinematic();
  initProcessCinematic();
  initEducationCinematic();
  initNav();
  initMobileMenu();
  initThemeToggle();
  initPremiumMotion();
  initScrollPolish();
  initSignup();
  initEpisodePreview();
  initGalleryLightbox();
  initPremiumCursor();
  initHeroTyping();
});

function initSiteLoader() {
  const loader = document.querySelector('.site-loader');
  const counter = loader?.querySelector('[data-loader-count]');
  if (!loader || !counter) {
    document.documentElement.classList.remove('site-loading');
    return;
  }

  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  let pageReady = document.readyState === 'complete';
  let finished = false;
  const startedAt = performance.now();
  const minimumDuration = reduceMotion ? 120 : 1450;
  const maximumDuration = reduceMotion ? 240 : 2800;

  window.addEventListener('load', () => { pageReady = true; }, { once: true });

  const finish = () => {
    if (finished) return;
    finished = true;
    counter.textContent = '100';
    loader.style.setProperty('--loader-progress', '1');
    window.setTimeout(() => loader.classList.add('site-loader--complete'), reduceMotion ? 0 : 160);
    window.setTimeout(() => {
      document.documentElement.classList.remove('site-loading');
      loader.remove();
    }, reduceMotion ? 30 : 1180);
  };

  const update = now => {
    const elapsed = now - startedAt;
    if (elapsed >= maximumDuration) pageReady = true;
    const timeProgress = Math.min(elapsed / minimumDuration, 1);
    const easedTime = 1 - Math.pow(1 - timeProgress, 3);
    const visibleProgress = pageReady ? easedTime : Math.min(easedTime, .94);
    const value = Math.min(100, Math.round(50 + visibleProgress * 50));
    counter.textContent = String(value);
    loader.style.setProperty('--loader-progress', String(.5 + visibleProgress * .5));

    if (pageReady && elapsed >= minimumDuration) finish();
    else window.requestAnimationFrame(update);
  };

  window.requestAnimationFrame(update);
}
function initEducationCinematic() {
  const section = document.querySelector('.education-hub');
  const head = section?.querySelector('.education-hub__head');
  const title = head?.querySelector('.display');
  const grid = section?.querySelector('.article-grid');
  const cards = [...(grid?.querySelectorAll('.article-card') || [])];
  if (!section || !head || !title || !grid || !cards.length) return;

  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const finePointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
  section.classList.add('education-cinematic');

  title.innerHTML = title.innerHTML
    .split(/<br\s*\/?\s*>/i)
    .map((line, lineIndex) => {
      const words = line.trim().split(/\s+/).map((word, wordIndex) =>
        `<span class="education-title__word" style="--word-index:${lineIndex * 2 + wordIndex}">${word}</span>`
      ).join(' ');
      return `<span class="education-title__line">${words}</span>`;
    }).join('');

  const dialText = 'READ / WATCH / QUESTION / REPEAT / ';
  const dial = document.createElement('div');
  dial.className = 'education-dial';
  dial.setAttribute('aria-hidden', 'true');
  dial.innerHTML = `<div class="education-dial__type">${[...dialText].map((char, index) =>
    `<span style="--dial-index:${index};--dial-count:${dialText.length}">${char === ' ' ? '&nbsp;' : char}</span>`
  ).join('')}</div><i></i><b>+</b>`;
  head.append(dial);

  const signal = document.createElement('div');
  signal.className = 'education-signal';
  signal.setAttribute('aria-hidden', 'true');
  signal.innerHTML = '<span class="education-signal__count">01 / 03</span><span class="education-signal__track"><i></i></span><span class="education-signal__label">GUIDE</span>';
  grid.before(signal);
  const signalCount = signal.querySelector('.education-signal__count');
  const signalLabel = signal.querySelector('.education-signal__label');
  const formats = ['GUIDE', 'PODCAST', 'VIDEO'];

  cards.forEach((card, index) => {
    card.style.setProperty('--education-index', index);
    card.dataset.educationNumber = `0${index + 1}`;
    card.tabIndex = 0;
    const ghost = document.createElement('span');
    ghost.className = 'article-card__ghost';
    ghost.setAttribute('aria-hidden', 'true');
    ghost.textContent = `0${index + 1}`;
    card.append(ghost);
    const action = card.querySelector('a');
    if (action) action.dataset.cursorLabel = formats[index];
  });

  const setStory = index => {
    const safeIndex = Math.max(0, Math.min(cards.length - 1, index));
    section.dataset.educationActive = safeIndex;
    section.style.setProperty('--education-progress', (safeIndex + 1) / cards.length);
    signalCount.textContent = `0${safeIndex + 1} / 0${cards.length}`;
    signalLabel.textContent = formats[safeIndex];
    cards.forEach((card, cardIndex) => card.classList.toggle('is-education-active', cardIndex === safeIndex));
  };
  setStory(0);

  cards.forEach((card, index) => {
    card.addEventListener('pointerenter', () => setStory(index));
    card.addEventListener('focusin', () => setStory(index));
  });
  grid.addEventListener('pointerleave', () => { if (finePointer) setStory(0); });

  const enter = () => {
    section.classList.add('education-entered');
    window.setTimeout(() => section.classList.add('education-settled'), reduceMotion ? 0 : 1750);
  };
  if (reduceMotion) {
    enter();
  } else if ('IntersectionObserver' in window) {
    const sectionObserver = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        enter();
        sectionObserver.disconnect();
      });
    }, { threshold: .14, rootMargin: '0px 0px -6% 0px' });
    sectionObserver.observe(section);

    if (!finePointer) {
      const cardObserver = new IntersectionObserver(entries => {
        entries.forEach(entry => {
          if (entry.isIntersecting) setStory(cards.indexOf(entry.target));
        });
      }, { threshold: .62, rootMargin: '-12% 0px -12% 0px' });
      cards.forEach(card => cardObserver.observe(card));
    }
  } else {
    enter();
  }

  if (!finePointer || reduceMotion) return;
  cards.forEach(card => {
    card.addEventListener('pointermove', event => {
      const bounds = card.getBoundingClientRect();
      const x = event.clientX - bounds.left;
      const y = event.clientY - bounds.top;
      card.style.setProperty('--education-x', `${x}px`);
      card.style.setProperty('--education-y', `${y}px`);
      card.style.setProperty('--education-shift-x', `${((x / bounds.width) - .5) * 9}px`);
      card.style.setProperty('--education-shift-y', `${((y / bounds.height) - .5) * 7}px`);
    }, { passive: true });
    card.addEventListener('pointerleave', () => {
      card.style.setProperty('--education-shift-x', '0px');
      card.style.setProperty('--education-shift-y', '0px');
    });
  });
}
function initProcessCinematic() {
  const section = document.querySelector('.process');
  const title = section?.querySelector('.process__head .display');
  const scroll = section?.querySelector('.process__scroll');
  const cards = [...(section?.querySelectorAll('.process-step') || [])];
  if (!section || !title || !scroll || !cards.length) return;

  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const finePointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
  const compactLayout = window.matchMedia('(max-width: 640px)').matches;
  section.classList.add('process-cinematic');
  title.innerHTML = title.innerHTML
    .split(/<br\s*\/?\s*>/i)
    .map(line => `<span class="process-title__line">${line.trim()}</span>`)
    .join('');

  cards.forEach((card, index) => {
    card.style.setProperty('--process-index', index);
    card.style.setProperty('--process-tilt', `${index % 2 ? 1.2 : -1.2}deg`);
    card.tabIndex = 0;
    card.dataset.cursorLabel = `0${index + 1}`;
  });

  const path = document.createElement('div');
  path.className = 'process-path';
  path.setAttribute('aria-hidden', 'true');
  path.innerHTML = cards.map((card, index) => {
    const stage = card.querySelector('.process-step__stage')?.textContent.split('·')[1]?.trim() || `Stage ${index + 1}`;
    return `<span class="process-path__node"><i></i><b>0${index + 1}</b><small>${stage}</small></span>`;
  }).join('');
  scroll.before(path);
  const nodes = [...path.querySelectorAll('.process-path__node')];

  const setStage = index => {
    const safeIndex = Math.max(0, Math.min(cards.length - 1, index));
    section.style.setProperty('--process-progress', safeIndex / Math.max(cards.length - 1, 1));
    cards.forEach((card, cardIndex) => card.classList.toggle('is-process-active', cardIndex === safeIndex));
    nodes.forEach((node, nodeIndex) => {
      node.classList.toggle('is-passed', nodeIndex <= safeIndex);
      node.classList.toggle('is-current', nodeIndex === safeIndex);
    });
  };

  cards.forEach((card, index) => {
    card.addEventListener('pointerenter', () => setStage(index));
    card.addEventListener('focus', () => setStage(index));
  });
  scroll.addEventListener('pointerleave', () => { if (finePointer && !compactLayout) setStage(0); });
  scroll.addEventListener('focusout', () => {
    window.requestAnimationFrame(() => {
      if (!scroll.contains(document.activeElement)) {
        if (compactLayout) updateMobileStage();
        else setStage(0);
      }
    });
  });

  const enter = () => {
    section.classList.add('process-entered');
    window.setTimeout(() => {
      if (compactLayout) updateMobileStage();
      else setStage(0);
      section.classList.add('process-settled');
    }, reduceMotion ? 0 : 1150);
  };
  if (reduceMotion) {
    enter();
  } else if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        enter();
        observer.disconnect();
      });
    }, { threshold: .14, rootMargin: '0px 0px -7% 0px' });
    observer.observe(section);
  } else {
    enter();
  }

  let scrollFrame = 0;
  const updateMobileStage = () => {
    const center = scroll.getBoundingClientRect().left + scroll.clientWidth / 2;
    let nearest = 0;
    let distance = Infinity;
    cards.forEach((card, index) => {
      const bounds = card.getBoundingClientRect();
      const nextDistance = Math.abs(bounds.left + bounds.width / 2 - center);
      if (nextDistance < distance) {
        distance = nextDistance;
        nearest = index;
      }
    });
    setStage(nearest);
    scrollFrame = 0;
  };
  let scrollSettleTimer = 0;
  const requestMobileStage = () => {
    if (!scrollFrame) scrollFrame = window.requestAnimationFrame(updateMobileStage);
  };
  scroll.addEventListener('scroll', () => {
    if (compactLayout || !finePointer) requestMobileStage();
    window.clearTimeout(scrollSettleTimer);
    scrollSettleTimer = window.setTimeout(requestMobileStage, 90);
  }, { passive: true });
  scroll.addEventListener('touchend', requestMobileStage, { passive: true });
  scroll.addEventListener('pointerup', () => { if (compactLayout) requestMobileStage(); }, { passive: true });
  if ('onscrollend' in window) scroll.addEventListener('scrollend', requestMobileStage, { passive: true });
  window.addEventListener('resize', () => {
    if (window.matchMedia('(max-width: 640px)').matches) requestMobileStage();
  }, { passive: true });

  if (!finePointer || reduceMotion) return;
  cards.forEach(card => {
    card.addEventListener('pointermove', event => {
      const bounds = card.getBoundingClientRect();
      const x = event.clientX - bounds.left;
      const y = event.clientY - bounds.top;
      card.style.setProperty('--process-x', `${x}px`);
      card.style.setProperty('--process-y', `${y}px`);
      card.style.setProperty('--process-shift-x', `${((x / bounds.width) - .5) * 8}px`);
      card.style.setProperty('--process-shift-y', `${((y / bounds.height) - .5) * 6}px`);
    }, { passive: true });
    card.addEventListener('pointerleave', () => {
      card.style.setProperty('--process-shift-x', '0px');
      card.style.setProperty('--process-shift-y', '0px');
    });
  });
}
function initBlueprintCinematic() {
  const section = document.querySelector('.story');
  const title = section?.querySelector('.story__text .display');
  const art = section?.querySelector('.blueprint-art');
  const system = art?.querySelector('.blueprint-art__system');
  const orbitals = [...(art?.querySelectorAll('.blueprint-art__orbital') || [])];
  if (!section || !title || !art || !system) return;

  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  section.classList.add('blueprint-cinematic');
  title.innerHTML = title.innerHTML
    .split(/<br\s*\/?\s*>/i)
    .map(line => `<span class="blueprint-title__line">${line.trim()}</span>`)
    .join('');
  orbitals.forEach((orbital, index) => orbital.style.setProperty('--blueprint-index', index));
  const cta = section.querySelector('.story__text .btn');
  if (cta) cta.dataset.cursorLabel = 'JOIN';

  if (reduceMotion) {
    section.classList.add('blueprint-entered', 'blueprint-settled');
    return;
  }

  const enter = () => {
    section.classList.add('blueprint-entered');
    window.setTimeout(() => section.classList.add('blueprint-settled'), 1900);
  };
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        enter();
        observer.disconnect();
      });
    }, { threshold:.18, rootMargin:'0px 0px -7% 0px' });
    observer.observe(section);
  } else {
    enter();
  }

  if (!window.matchMedia('(hover: hover) and (pointer: fine)').matches) return;
  let depthFrame = 0;
  let depthX = 0;
  let depthY = 0;
  const renderDepth = () => {
    system.style.setProperty('--blueprint-x', `${depthX}px`);
    system.style.setProperty('--blueprint-y', `${depthY}px`);
    depthFrame = 0;
  };
  art.addEventListener('pointermove', event => {
    const bounds = art.getBoundingClientRect();
    const localX = event.clientX - bounds.left;
    const localY = event.clientY - bounds.top;
    art.style.setProperty('--blueprint-light-x', `${localX}px`);
    art.style.setProperty('--blueprint-light-y', `${localY}px`);
    depthX = ((localX / bounds.width) - .5) * 12;
    depthY = ((localY / bounds.height) - .5) * 10;
    if (!depthFrame) depthFrame = window.requestAnimationFrame(renderDepth);
  }, { passive:true });
  art.addEventListener('pointerleave', () => {
    depthX = 0;
    depthY = 0;
    if (!depthFrame) depthFrame = window.requestAnimationFrame(renderDepth);
  });
}
function initReceiptsCinematic() {
  const section = document.querySelector('.receipts');
  const title = section?.querySelector('.receipts__head .display');
  const cards = [...(section?.querySelectorAll('.stat-card') || [])];
  if (!section || !title || !cards.length) return;

  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  section.classList.add('receipts-cinematic');

  const titleLines = title.innerHTML.split(/<br\s*\/?\s*>/i);
  title.innerHTML = titleLines
    .map(line => `<span class="receipts-title__line">${line.trim()}</span>`)
    .join('');

  cards.forEach((card, index) => {
    card.style.setProperty('--receipt-index', index);
    card.dataset.cursorLabel = 'EXPLORE';
  });

  const grid = section.querySelector('.receipts__grid');
  const flow = document.createElement('div');
  flow.className = 'receipts-flow';
  flow.setAttribute('aria-hidden', 'true');
  flow.innerHTML = cards
    .map((card, index) => `<span class="receipts-flow__step">0${index + 1}</span>`)
    .join('');
  grid.before(flow);
  const flowSteps = [...flow.querySelectorAll('.receipts-flow__step')];
  const setFlowStep = index => {
    const progress = index < 0 ? 0 : index / Math.max(cards.length - 1, 1);
    section.style.setProperty('--flow-progress', progress);
    flowSteps.forEach((step, stepIndex) => {
      step.classList.toggle('is-passed', index >= 0 && stepIndex <= index);
      step.classList.toggle('is-current', stepIndex === index);
    });
  };
  cards.forEach((card, index) => {
    card.addEventListener('pointerenter', () => setFlowStep(index));
    card.addEventListener('focus', () => setFlowStep(index));
  });
  grid.addEventListener('pointerleave', () => setFlowStep(-1));
  grid.addEventListener('focusout', () => {
    window.requestAnimationFrame(() => {
      if (!grid.contains(document.activeElement)) setFlowStep(-1);
    });
  });

  if (reduceMotion) {
    section.classList.add('receipts-entered');
    return;
  }

  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        section.classList.add('receipts-entered');
        observer.disconnect();
      });
    }, { threshold: .16, rootMargin: '0px 0px -6% 0px' });
    observer.observe(section);
  } else {
    section.classList.add('receipts-entered');
  }

  let scrollFrame = 0;
  const updateSectionDrift = () => {
    const bounds = section.getBoundingClientRect();
    const travel = window.innerHeight + bounds.height;
    const progress = Math.max(0, Math.min(1, (window.innerHeight - bounds.top) / travel));
    section.style.setProperty('--receipts-drift', `${(progress - .5) * 54}px`);
    scrollFrame = 0;
  };
  window.addEventListener('scroll', () => {
    if (!scrollFrame) scrollFrame = window.requestAnimationFrame(updateSectionDrift);
  }, { passive: true });
  updateSectionDrift();

  if (!window.matchMedia('(hover: hover) and (pointer: fine)').matches) return;
  cards.forEach(card => {
    card.addEventListener('pointermove', event => {
      const bounds = card.getBoundingClientRect();
      card.style.setProperty('--card-x', `${event.clientX - bounds.left}px`);
      card.style.setProperty('--card-y', `${event.clientY - bounds.top}px`);
    }, { passive: true });
  });
}
function initHeroCinematic() {
  const hero = document.querySelector('.opt-hero');
  const heroImage = hero?.querySelector('.opt-hero__image');
  if (!hero || !heroImage) return;

  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduceMotion) return;

  document.documentElement.classList.add('hero-cinematic');
  window.requestAnimationFrame(() => {
    window.requestAnimationFrame(() => document.documentElement.classList.add('hero-entered'));
  });
  window.setTimeout(() => document.documentElement.classList.add('hero-settled'), 1900);

  if (!window.matchMedia('(hover: hover) and (pointer: fine)').matches) return;
  let parallaxFrame = 0;
  let pointerX = 0;
  let pointerY = 0;
  const renderParallax = () => {
    heroImage.style.setProperty('--hero-parallax-x', `${pointerX}px`);
    heroImage.style.setProperty('--hero-parallax-y', `${pointerY}px`);
    parallaxFrame = 0;
  };
  hero.addEventListener('pointermove', event => {
    pointerX = ((event.clientX / window.innerWidth) - .5) * -12;
    pointerY = ((event.clientY / window.innerHeight) - .5) * -7;
    if (!parallaxFrame) parallaxFrame = window.requestAnimationFrame(renderParallax);
  }, { passive: true });
  hero.addEventListener('pointerleave', () => {
    pointerX = 0;
    pointerY = 0;
    if (!parallaxFrame) parallaxFrame = window.requestAnimationFrame(renderParallax);
  });
}
function initPremiumCursor() {
  const canHover = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (!canHover || reduceMotion) return;

  const cursor = document.createElement('div');
  cursor.className = 'premium-cursor';
  cursor.setAttribute('aria-hidden', 'true');
  cursor.innerHTML = '<span class="premium-cursor__ring" data-label="OPEN"></span><span class="premium-cursor__dot"></span>';
  document.body.appendChild(cursor);
  document.documentElement.classList.add('has-premium-cursor');

  const ring = cursor.querySelector('.premium-cursor__ring');
  const dot = cursor.querySelector('.premium-cursor__dot');
  let mouseX = window.innerWidth / 2;
  let mouseY = window.innerHeight / 2;
  let ringX = mouseX;
  let ringY = mouseY;
  let hoverTarget = null;

  const moveDot = () => {
    dot.style.setProperty('--cursor-dot-x', `${mouseX}px`);
    dot.style.setProperty('--cursor-dot-y', `${mouseY}px`);
  };

  const animateRing = () => {
    let targetX = mouseX;
    let targetY = mouseY;
    if (hoverTarget) {
      const bounds = hoverTarget.getBoundingClientRect();
      if (bounds.width < 320 && bounds.height < 180) {
        targetX += (bounds.left + bounds.width / 2 - mouseX) * .12;
        targetY += (bounds.top + bounds.height / 2 - mouseY) * .12;
      }
    }
    ringX += (targetX - ringX) * .17;
    ringY += (targetY - ringY) * .17;
    ring.style.setProperty('--cursor-ring-x', `${ringX}px`);
    ring.style.setProperty('--cursor-ring-y', `${ringY}px`);
    window.requestAnimationFrame(animateRing);
  };

  window.addEventListener('pointermove', event => {
    mouseX = event.clientX;
    mouseY = event.clientY;
    document.documentElement.classList.add('cursor-active');
    moveDot();
  }, { passive: true });

  window.addEventListener('pointerdown', () => document.documentElement.classList.add('cursor-pressed'));
  window.addEventListener('pointerup', () => document.documentElement.classList.remove('cursor-pressed'));
  window.addEventListener('pointercancel', () => document.documentElement.classList.remove('cursor-pressed'));
  document.addEventListener('mouseleave', () => document.documentElement.classList.remove('cursor-active'));
  document.addEventListener('mouseenter', () => document.documentElement.classList.add('cursor-active'));

  const interactiveSelector = 'a, button, input, textarea, select, label, [role="button"], .gallery-item, .stat-card, .article-card, .process-step, .feature-card__play-btn';
  const getCursorLabel = target => {
    if (target.dataset.cursorLabel) return target.dataset.cursorLabel;
    if (target.matches('input, textarea, select, label')) return 'TYPE';
    if (target.matches('.gallery-item')) return 'VIEW';
    if (target.matches('.feature-card__play-btn')) return 'PLAY';
    if (target.matches('button')) return 'CLICK';
    return 'OPEN';
  };

  document.addEventListener('pointerover', event => {
    const target = event.target.closest(interactiveSelector);
    if (!target) return;
    hoverTarget = target;
    ring.dataset.label = getCursorLabel(target);
    document.documentElement.classList.add('cursor-hover');
  });

  document.addEventListener('pointerout', event => {
    if (!hoverTarget || hoverTarget.contains(event.relatedTarget)) return;
    hoverTarget = null;
    document.documentElement.classList.remove('cursor-hover');
  });

  moveDot();
  animateRing();
}
function initHeroTyping() {
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const textEl = document.querySelector('.opt-hero__content > p');
  if (!textEl || reduceMotion) return;

  const fullText = textEl.textContent.replace(/\s+/g, ' ').trim();
  textEl.dataset.fullText = fullText;
  textEl.textContent = '';
  textEl.classList.add('hero-typing', 'is-typing');

  let index = 0;
  const startDelay = 950;
  const speed = 22;

  window.setTimeout(() => {
    const typeNext = () => {
      index += 1;
      textEl.textContent = fullText.slice(0, index);
      if (index < fullText.length) {
        window.setTimeout(typeNext, speed);
      } else {
        textEl.classList.remove('is-typing');
        textEl.classList.add('typing-complete');
      }
    };
    typeNext();
  }, startDelay);
}


function initBlueprintOrbitMotion() {
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const system = document.querySelector('.blueprint-art__system');
  if (!system || reduceMotion) return;

  const orbitals = [
    { el: system.querySelector('.blueprint-art__orbital--genes'), speed: 0.34, start: -70, direction: 1 },
    { el: system.querySelector('.blueprint-art__orbital--nutrition'), speed: 0.26, start: 30, direction: -1 },
    { el: system.querySelector('.blueprint-art__orbital--lifestyle'), speed: 0.2, start: 155, direction: 1 },
    { el: system.querySelector('.blueprint-art__orbital--context'), speed: 0.16, start: 240, direction: 1 }
  ].filter(item => item.el && item.el.querySelector('i'));

  if (!orbitals.length) return;

  orbitals.forEach(item => {
    item.label = item.el.querySelector('i');
    item.el.style.setProperty('animation', 'none', 'important');
    item.el.style.setProperty('transform', 'translate(-50%, -50%)', 'important');
    item.el.style.setProperty('left', '50%', 'important');
    item.el.style.setProperty('top', '50%', 'important');
    item.label.style.setProperty('animation', 'none', 'important');
    item.label.style.setProperty('left', '50%', 'important');
    item.label.style.setProperty('top', '50%', 'important');
  });

  const animate = time => {
    orbitals.forEach(item => {
      const orbitBox = item.el.getBoundingClientRect();
      const labelBox = item.label.getBoundingClientRect();
      const inset = Math.max(labelBox.width, labelBox.height) / 2 + 8;
      const radius = Math.max(20, orbitBox.width / 2 - inset);
      const angle = (item.start + item.direction * item.speed * time / 16.67) * Math.PI / 180;
      const x = Math.cos(angle) * radius;
      const y = Math.sin(angle) * radius;
      item.label.style.setProperty('transform', `translate(calc(-50% + ${x}px), calc(-50% + ${y}px))`, 'important');
    });
    window.requestAnimationFrame(animate);
  };

  window.requestAnimationFrame(animate);
}


function initBlueprintOrbitPositionMotion() {
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const system = document.querySelector('.blueprint-art__system');
  if (!system || reduceMotion) return;

  const items = [
    { ring: system.querySelector('.blueprint-art__orbital--genes'), speed: 0.018, start: -Math.PI / 2.4, dir: 1 },
    { ring: system.querySelector('.blueprint-art__orbital--nutrition'), speed: 0.014, start: 0.25, dir: -1 },
    { ring: system.querySelector('.blueprint-art__orbital--lifestyle'), speed: 0.011, start: 2.45, dir: 1 },
    { ring: system.querySelector('.blueprint-art__orbital--context'), speed: 0.0085, start: 3.85, dir: 1 }
  ].filter(item => item.ring && item.ring.querySelector('i'));

  items.forEach(item => {
    item.label = item.ring.querySelector('i');
    item.ring.style.animation = 'none';
    item.ring.style.transform = 'translate(-50%, -50%)';
    item.ring.style.left = '50%';
    item.ring.style.top = '50%';
    item.label.style.animation = 'none';
    item.label.style.transform = 'translate(-50%, -50%)';
    item.label.style.position = 'absolute';
  });

  const tick = now => {
    items.forEach(item => {
      const ringSize = item.ring.offsetWidth;
      const labelW = item.label.offsetWidth || 80;
      const labelH = item.label.offsetHeight || 28;
      const safeInset = Math.max(labelW, labelH) / 2 + 10;
      const radius = Math.max(24, ringSize / 2 - safeInset);
      const angle = item.start + item.dir * item.speed * (now / 16.67);
      const x = Math.cos(angle) * radius;
      const y = Math.sin(angle) * radius;
      item.label.style.left = `calc(50% + ${x}px)`;
      item.label.style.top = `calc(50% + ${y}px)`;
      item.label.style.transform = 'translate(-50%, -50%)';
    });
    requestAnimationFrame(tick);
  };

  requestAnimationFrame(tick);
}


