/* WordPress admin-toolbar compatibility for the theme's fixed navigation. */
'use strict';

(() => {
  const toolbar = document.getElementById('wpadminbar');
  const nav = document.getElementById('topnav');

  if (!nav) return;

  let frame = 0;

  const visibleToolbarHeight = () => {
    if (!toolbar || window.getComputedStyle(toolbar).display === 'none') return 0;

    const bounds = toolbar.getBoundingClientRect();
    return Math.max(0, Math.min(bounds.height, bounds.bottom));
  };

  const sync = () => {
    frame = 0;
    const offset = visibleToolbarHeight();
    const offsetValue = `${Math.round(offset)}px`;
    const progress = document.querySelector('.scroll-progress');
    const mobileMenu = document.getElementById('mobile-navigation');

    nav.style.setProperty('top', offsetValue, 'important');
    if (progress) progress.style.setProperty('top', offsetValue, 'important');

    if (mobileMenu && window.matchMedia('(max-width: 1023px)').matches) {
      const menuTop = Math.round(offset + nav.getBoundingClientRect().height);
      mobileMenu.style.setProperty('top', `${menuTop}px`, 'important');
      mobileMenu.style.setProperty('height', `calc(100dvh - ${menuTop}px)`, 'important');
    } else if (mobileMenu) {
      mobileMenu.style.removeProperty('top');
      mobileMenu.style.removeProperty('height');
    }
  };

  const requestSync = () => {
    if (frame) return;
    frame = window.requestAnimationFrame(sync);
  };

  document.addEventListener('DOMContentLoaded', requestSync, { once: true });
  window.addEventListener('load', requestSync, { once: true });
  window.addEventListener('scroll', requestSync, { passive: true });
  window.addEventListener('resize', requestSync, { passive: true });

  if (window.visualViewport) {
    window.visualViewport.addEventListener('resize', requestSync, { passive: true });
  }

  requestSync();
})();

