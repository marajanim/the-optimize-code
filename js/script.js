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
    button.textContent = 'You’re on the list ✓';
    message.textContent = 'Thanks — watch your inbox for thoughtful health education.';
    window.setTimeout(() => {
      button.disabled = false;
      button.textContent = 'Keep me informed →';
    }, 3000);
  });
}

function initEpisodePreview() {
  const button = document.querySelector('.feature-card__play-btn');
  if (!button) return;
  button.addEventListener('click', () => {
    const playing = button.dataset.playing === 'true';
    button.dataset.playing = String(!playing);
    button.textContent = playing ? '▶' : 'Ⅱ';
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
  viewer.innerHTML = '<button class=gallery-viewer__close aria-label=Close>×</button><button class=gallery-viewer__prev aria-label=Previous>←</button><figure><img alt="><figcaption></figcaption></figure><button class=gallery-viewer__next aria-label=Next>→</button>';
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
  initNav();
  initMobileMenu();
  initThemeToggle();
  initPremiumMotion();
  initScrollPolish();
  initSignup();
  initEpisodePreview();
  initGalleryLightbox();
});
