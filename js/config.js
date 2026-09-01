/* ==========================================================================
   TOC — Site Configuration
   --------------------------------------------------------------------------
   Backend developers: inject server-side values here (e.g., via a template
   engine) or expose a /api/config endpoint and fetch on DOMContentLoaded.
   ========================================================================== */

'use strict';

const CONFIG = {
  /* Clock timezone — change to match server locale if deployed elsewhere */
  clockTimezone: 'Asia/Dhaka',
  clockTickMs:   10000,

  /* Default hero background variant: 'centered' | 'grid' | 'split' | 'glow' */
  heroVariant: 'centered',
};

const HERO_BACKGROUNDS = {
  centered: 'radial-gradient(ellipse 80% 60% at 50% 45%, #1a2048 0%, #070a20 55%, #010314 100%)',
  grid:     'var(--ink)',
  split:    'linear-gradient(100deg, #1a2048 0%, #070a20 50%, #010314 100%)',
  glow:     'conic-gradient(from 180deg at 50% 50%, #2a2a5e, #0b1229, #2a2a5e)',
};
