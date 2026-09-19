# The Optimize Code — Elementor Free Implementation Prompts

## How to use these prompts

Run these prompts **in order, one at a time**. Do not ask an implementation agent to perform the entire conversion in one pass. Review each section in Elementor, on the front end, and at desktop/tablet/mobile sizes before continuing.

These prompts deliberately use:

- Elementor Free only.
- Custom TOC widgets built with Elementor's free developer APIs.
- Native WordPress menus, Custom Logo, Settings API, Media Library, posts, revisions, and permissions.
- One approved free form plugin through a shortcode.

They deliberately do **not** use Elementor Pro, ACF PRO, Theme Builder, Dynamic Tags, Loop Grid, Form Builder, Popup Builder, Pro custom CSS, paid add-ons, or paid template libraries.

Before Prompt 1, make a full files/database backup and work on staging/local—not production.

## Shared rules for every prompt

Prepend these rules whenever a prompt is given to a coding agent:

```text
Work inside the existing The Optimize Code WordPress project. Read DYNAMIC-THEME-REQUIREMENTS.md completely before changing code. Preserve existing user changes.

Use Elementor Free and free/open-source WordPress functionality only. Do not use or recommend Elementor Pro, ACF PRO, paid add-ons, Pro Dynamic Tags, Theme Builder, Loop Grid, Form Builder, Popup Builder, Global Widgets, or Pro custom CSS. Before adding any plugin, prove that the exact required capability is available in its free version and obtain approval.

Implement only this prompt's scope. Preserve the current HTML structure, CSS class names, JavaScript hooks, responsive behavior, light/dark mode, animation, and public content unless a change is explicitly required. Keep the legacy section working until its Elementor replacement passes visual parity review.

Follow WordPress and Elementor developer APIs. Escape output by context; sanitize settings; use capabilities/nonces for writes; use Media Library attachment IDs; do not expose secrets; do not edit WordPress core or third-party plugins.

Do not directly manipulate Elementor JSON/post metadata with unsafe search-and-replace. Never overwrite, delete, recreate, or duplicate administrator content during activation/update. Migration must be explicit, backed up, guarded, idempotent, and reversible.

Before editing, inspect and summarize the relevant current implementation and list expected files. After implementation, run available checks and report files changed, tests/results, visual parity status at desktop/tablet/mobile, manual WordPress/Elementor steps, assumptions, and anything deferred. Stop and ask one concise question if a dependency or business decision blocks safe work.
```

---

## Prompt 1 — Free-only audit and section migration map

```text
Audit the theme for an Elementor Free conversion. Do not change public behavior.

Tasks:

1. Inspect all PHP, CSS, JavaScript, images, templates, hooks, and configuration.
2. Inventory every hard-coded public string, image, URL, email, social link, menu, logo value, color, form behavior, gallery item, slug condition, and activation-time content mutation.
3. Map every current page section to either:
   - a custom TOC Elementor Free widget;
   - an existing standard Elementor Free widget; or
   - a native global WordPress component.
4. Record exact outer markup, class names, JS selectors, animations, section anchors, responsive breakpoints, and dependencies for each section.
5. Check whether Elementor Free and a free form plugin are installed. Do not install anything yet.
6. Identify any current/previous code or documentation that assumes ACF PRO, Elementor Pro, Dynamic Tags, Theme Builder, Loop Grid, Form Builder, or another paid feature.
7. Create/update IMPLEMENTATION-STATUS.md with:
   - free dependencies and approval status;
   - current-state inventory;
   - section-by-section migration order;
   - markup/selector preservation map;
   - visual QA viewports;
   - content destination map;
   - risks and rollback plan.
8. Add no production feature code.

Acceptance:

- Home, Testing, Gallery, header, footer, 404, generic page, and form behavior are fully mapped.
- The hard-coded gallery, fake form, slug logic, and activation page creation are documented.
- Every planned capability is marked free, custom project code, or undecided.
```

## Prompt 2 — Safe bootstrap and Elementor Free compatibility

```text
Refactor the theme foundation and add Elementor Free compatibility without changing current front-end output.

Tasks:

1. Keep functions.php as a small bootstrap and split responsibilities under inc/ for setup, assets, menus, settings, helpers, Elementor integration, and migration.
2. Preserve all current hooks/output.
3. Add safe Elementor detection and version compatibility checks.
4. Add a capability-protected dismissible admin notice when Elementor is missing/incompatible; never fatal on public pages.
5. Add Elementor theme locations/support only where available in Free and actually needed; do not call Pro APIs.
6. Ensure ordinary pages use the normal WordPress loop while Elementor-edited pages can render full-width `the_content()` without the generic width wrapper.
7. Add an Elementor Full Width page template that retains native header/footer. Keep Canvas optional and intentionally headerless.
8. Register styles/scripts cleanly but do not add section widgets yet.
9. Update IMPLEMENTATION-STATUS.md.

Verification:

- PHP syntax checks for all changed files.
- Compare current Home, Testing, Gallery, page, and 404 before/after.
- Test Elementor active and inactive states.
- Confirm non-Elementor pages remain unchanged.
```

## Prompt 3 — Native Theme Settings and semantic design tokens

```text
Implement free global settings with the WordPress Settings API. Do not use ACF or a settings plugin.

Tasks:

1. Create Appearance > Theme Settings with General, Header, Footer, Social Profiles, Appearance, and Integrations sections/tabs.
2. Register all fields described in Sections 7–9 of DYNAMIC-THEME-REQUIREMENTS.md.
3. Use capability checks, Settings API nonces, per-field validation/sanitization, defaults matching the current site, and contextual help.
4. Use the WordPress Media Library for logo/image attachment IDs.
5. Create typed helper functions for safe option retrieval and fallbacks.
6. Centralize existing colors into semantic CSS variables for light/dark modes.
7. Generate validated option overrides safely with wp_add_inline_style(); never write a CSS file from an admin request.
8. Keep theme tokens as the default source of truth. Configure/document Elementor Free Site Settings so its global fonts/colors do not conflict.
9. Do not store API keys/secrets in Theme Settings.
10. Update IMPLEMENTATION-STATUS.md.

Verification:

- Save/reload valid, empty, and invalid values.
- Verify unauthorized roles cannot edit settings.
- Test default and customized light/dark palettes for contrast and visual regressions.
- Confirm clearing an optional setting never produces warnings/broken markup.
```

## Prompt 4 — Dynamic native header and menus

```text
Convert the header to native WordPress-managed content without Elementor Theme Builder.

Tasks:

1. Render native Custom Logo with accessible home linking and brand-text fallback.
2. Support configured light/dark/mobile logo attachment IDs.
3. Register/render the primary menu with wp_nav_menu(). Preserve existing classes/structure using arguments, filters, or a minimal walker only when necessary.
4. Support nested items, active states, internal anchors, external links, targets, and relationships.
5. Generate mobile navigation from the same primary menu; remove duplicated/hard-coded links in PHP/JS.
6. Make CTA, theme-toggle labels/visibility, announcement bar, and loader content/visibility dynamic from Theme Settings.
7. Remove header presentation and CTA decisions based on Testing/Gallery slugs.
8. Preserve admin-bar offset, styling, and motion.
9. Implement keyboard navigation, Escape close, expanded/hidden states, focus handling, and reduced-motion behavior.
10. Update IMPLEMENTATION-STATUS.md.

Verification:

- Assign/unassign/reorder/rename/nest menu items.
- Test missing logo/menu/settings fallbacks.
- Test desktop/mobile, keyboard-only, light/dark, reduced motion, and logged-in admin bar.
- Confirm no hard-coded header navigation remains.
```

## Prompt 5 — Dynamic native footer

```text
Convert the footer to free native WordPress-managed content without Elementor Theme Builder.

Tasks:

1. Register/render footer_explore, footer_services, and footer_legal menus with wp_nav_menu(). Retain a migration path from the existing footer location.
2. Render footer logo/fallback, brand description, column headings, contact information, disclaimer, copyright token, and watermark from Theme Settings.
3. Render enabled social profiles safely with local icons. Remove third-party CDN icon dependencies.
4. Do not output empty headings, wrappers, links, or image elements.
5. Preserve existing footer markup/classes, responsive layout, animation, and light/dark behavior.
6. Add safe external-link rel/target behavior and accessible labels.
7. Update IMPLEMENTATION-STATUS.md.

Verification:

- Test every footer menu and unassigned states.
- Test every supported social platform, email, disabled items, and invalid URLs.
- Test current-year token, empty content, keyboard focus, desktop/mobile, and both themes.
- Confirm no hard-coded social URL/footer email remains.
```

## Prompt 6 — Custom Elementor Free widget foundation

```text
Build the shared custom-widget architecture using Elementor Free developer APIs.

Tasks:

1. Register a The Optimize Code widget category.
2. Register custom widgets on `elementor/widgets/register` only when Elementor is active.
3. Establish inc/elementor/bootstrap.php, helpers, and a widgets directory.
4. Create shared helpers for unique section IDs, classes, links, buttons, responsive images, safe rich text, heading tags, visibility, and editor empty states.
5. Register shared CSS/JS once. Let each widget declare only its actual get_style_depends()/get_script_depends().
6. Define Content, Style, and safe responsive controls conventions.
7. Use repeater controls for lists; URL controls for links; Media controls for images; avoid raw HTML/script/custom CSS controls.
8. Add Elementor editor-preview initialization for interactive widgets.
9. Create a minimal TOC Section Header proof widget while preserving the corresponding existing markup/classes.
10. Update IMPLEMENTATION-STATUS.md.

Verification:

- Insert/edit/preview/duplicate/move/hide/save/reload/delete the proof widget.
- Test inline editing, empty fields, escaping, unique IDs, both themes, and all responsive modes.
- Confirm no Elementor Pro class/API is referenced.
- Confirm assets load only on pages using the widget.
```

## Prompt 7 — Convert the Home Hero only

```text
Create the TOC Hero Elementor Free widget. Do not convert any other section in this step.

Requirements:

1. Preserve the current Hero HTML order, CSS classes, overlay/grid layers, CTA classes, rail metadata, animation selectors, and breakpoints.
2. Add controls for kicker lines, title lines/highlight, description, background/mobile image, focal point, overlay choice, primary/secondary CTAs, rail labels, anchor, height, alignment, and approved style.
3. Use attachment IDs and WordPress responsive images where possible. Preserve CSS-background behavior only where required for visual parity, with an accessible/decorative treatment.
4. Default values must reproduce the current Hero.
5. Add safe Style controls that inherit semantic theme variables by default.
6. Correctly prioritize the LCP media and prevent layout shift.
7. Make the widget work in editor preview and front end.
8. Keep the legacy Hero active on the public Home page until the new widget is approved.

Verification gate:

- Compare legacy and Elementor Hero at 320, 375, 768, 1024, 1440, and a large desktop width.
- Test long/short/missing content, both themes, reduced motion, CTA focus, mobile image, and admin bar.
- Do not continue until visual structure and behavior are approved.
```

## Prompt 8 — Convert the Home Ticker only

```text
Create the TOC Ticker Elementor Free widget. Do not convert another section.

Requirements:

1. Preserve current ticker markup/classes, sizing, duplicate-track behavior if needed, and animation appearance.
2. Add a repeater for text items and allowlisted separator choices.
3. Add direction, approved speed range, pause-on-hover, anchor, and approved Style controls.
4. Output a readable static list when prefers-reduced-motion is enabled.
5. Prevent empty tracks and unsafe HTML.
6. Ensure animation initializes in Elementor preview and after normal front-end rendering without duplicate handlers.
7. Keep the legacy ticker until approval.

Verification gate:

- Test 1, 2, typical, and maximum items; long text; both directions; reduced motion; tab/focus behavior; and all viewports.
- Confirm no horizontal page overflow or duplicated initialization.
```

## Prompt 9 — Convert Featured Podcast only

```text
Create the TOC Featured Podcast Elementor Free widget. Do not use Dynamic Tags or Pro widgets.

Requirements:

1. Preserve current card markup/classes, artwork, episode label, waveform, play control, tags, title, description, link, animation, and responsive layout.
2. Implement manual controls for artwork, episode number, tags repeater, duration, title, summary, destination, and supported audio/embed URL.
3. Add an optional selected/latest Podcast mode only if the free custom Podcast content type already exists; query it directly with WordPress APIs.
4. Render the play control only for a real supported audio source. Otherwise render a normal episode link or hide the control.
5. Do not simulate playback.
6. Use safe provider allowlists and accessible play/pause labels.
7. Keep legacy output until approval.

Verification gate:

- Test manual mode, no audio, valid audio, invalid embed, missing image, multiple tags, long title, keyboard controls, reduced motion, and all viewports.
- Confirm no Dynamic Tag, Elementor Pro, or paid media widget dependency.
```

## Prompt 10 — Convert Feature Cards only

```text
Create the TOC Feature Cards Elementor Free widget for the current Learn/receipts card grid. Do not convert another section.

Requirements:

1. Preserve section/card markup, classes, numbering, hover behavior, links, reveal motion, grid, and responsive layout.
2. Add section heading/description controls where they belong in this component, or pair clearly with TOC Section Header.
3. Add a repeater for index, label, glyph/approved icon, title, description, and URL.
4. Add safe column/style choices and a reasonable item maximum.
5. Make whole-card links accessible without invalid nested interactive elements.
6. Add approved Style controls with semantic-token defaults.
7. Keep legacy output until approval.

Verification gate:

- Test minimum/maximum cards, missing links, long content, keyboard focus, touch, light/dark, reduced motion, and all viewports.
- Confirm cards never overflow or produce inconsistent heights that break the design.
```

## Prompt 11 — Convert Blueprint Story only

```text
Create the TOC Blueprint Story Elementor Free widget. Do not convert another section.

Requirements:

1. Preserve current story split markup/classes, typography, spacing, orbit artwork, CTA, animations, and responsive stacking.
2. Add controls for stamp, heading/emphasis, content, CTA, orbit/image mode, orbit labels, media side, anchor, and approved background style.
3. In orbit mode, keep labels accessible and motion decorative; provide a reduced-motion state.
4. In image mode, use a Media control, attachment ID, responsive image output, and alt text.
5. Add only safe Style controls and semantic-token defaults.
6. Keep legacy output until approval.

Verification gate:

- Test orbit/image modes, missing CTA/media, long content, keyboard focus, reduced motion, light/dark, and all viewports.
- Confirm visual balance/stacking matches the existing design.
```

## Prompt 12 — Convert Process Steps only

```text
Create the TOC Process Steps Elementor Free widget. Do not convert another section.

Requirements:

1. Preserve current section heading, scroll/grid behavior, step cards, numbering, animations, and responsive behavior.
2. Add a repeater for stage label, title, description, and optional approved icon/number.
3. Add horizontal/vertical approved layouts, safe item limits, anchor, and semantic Style controls.
4. Generate numbering reliably without editors typing duplicate numbers unless a custom display number is explicitly supported.
5. Keep content readable and navigable without JavaScript.
6. Keep legacy output until approval.

Verification gate:

- Test 1 through maximum steps, long content, horizontal overflow behavior, keyboard/touch access, reduced motion, both themes, and all viewports.
```

## Prompt 13 — Convert Education Grid only

```text
Create the TOC Education Grid Elementor Free widget. Do not use Loop Grid, Dynamic Tags, or a paid posts widget.

Requirements:

1. Preserve current heading, featured/standard card markup/classes, grid proportions, link styles, motion, and responsive layout.
2. Implement manual repeater mode with type/meta, title, description, link, and featured style.
3. If approved reusable content exists, add selected/latest/category query modes directly with WP_Query and explicit limits.
4. Exclude unpublished records publicly and resolve links with WordPress permalinks.
5. Add safe empty-state behavior in editor and front end.
6. Avoid unbounded/N+1 queries; cache only if measurement justifies it.
7. Keep legacy output until approval.

Verification gate:

- Test manual, selected, latest, filtered, empty, plugin-inactive, long title, and maximum-item states.
- Confirm no Elementor Pro/Loop Grid/Dynamic Tag dependency and no private/draft content leak.
```

## Prompt 14 — Convert Newsletter CTA and integrate a free form

```text
Create the TOC CTA / Newsletter Elementor Free widget and replace the fake form behavior.

Before implementation, inspect IMPLEMENTATION-STATUS.md for the approved free form plugin. If none is approved, ask the user. Default recommendation is Contact Form 7, but do not install it without authorization.

Requirements:

1. Preserve current CTA section/grid markup, heading, feature list, form placement, styling, and responsive behavior.
2. Add controls for eyebrow, heading, description, feature repeater, privacy note/link, background style, and form shortcode.
3. Render the shortcode safely using the approved plugin; do not allow ordinary editors to add arbitrary scripts.
4. Remove the JavaScript-only fake submission/success logic.
5. Style the free form through theme CSS while preserving accessible labels, errors, success messages, and focus.
6. Document recipient/list, consent, privacy, retention, spam setup, and delivery configuration.
7. Add clear editor/public missing-plugin or missing-form states.
8. Keep legacy CTA until the real form and new widget are approved.

Verification gate:

- Test success, validation failure, spam rejection, duplicate click, provider/mail failure, keyboard/screen reader, mobile, and both themes.
- Confirm no paid form add-on and no secret in page/theme code.
```

## Prompt 15 — Convert the Testing page widgets section by section

```text
Convert the Testing page in four separately reviewable substeps. Complete and test one substep before starting the next:

A. TOC Testing Hero
B. TOC Testing Pathways
C. TOC Notice / Disclaimer
D. TOC PGx Request CTA

For every substep:

1. Preserve the corresponding markup/classes, spacing, styling, motion, anchors, and responsive behavior.
2. Implement the controls listed in Section 10 of DYNAMIC-THEME-REQUIREMENTS.md.
3. Use repeater controls for pathways and steps with safe limits and stable numbering.
4. Use Elementor URL/shortcode controls; do not use Dynamic Tags.
5. Remove slug-dependent presentation logic only after the Elementor version is approved.
6. Keep required educational/medical disclaimers visible or warn authorized editors when a configuration would remove required context.
7. PGx must be a basic contact request only unless an approved secure workflow is documented; do not collect health/genetic/medication details through ordinary email.
8. Keep each legacy section until its replacement passes its gate.

Verification gate after each substep:

- Test empty/long/minimum/maximum content, links/forms, keyboard, reduced motion, light/dark, and all viewports.
- Record approval independently for A, B, C, and D in IMPLEMENTATION-STATUS.md.
```

## Prompt 16 — Convert the Gallery page widgets section by section

```text
Convert the Gallery page in two separately reviewable substeps:

A. TOC Gallery Hero
B. TOC Gallery / Lightbox

Requirements:

1. Preserve current gallery hero/wall markup classes, image presentation, numbering, lightbox design, and responsive behavior.
2. Use Media Library attachment IDs, manual ordering, captions/credits, approved layouts/columns, and optional load-more.
3. Calculate the image count; make date calculated or explicitly editable with clear labeling.
4. Use WordPress responsive images with dimensions and correct alt text.
5. Implement accessible lightbox dialog labeling, keyboard controls, focus trap/restoration, Escape close, previous/next, and non-JavaScript full-image links.
6. Avoid layout shift and eager-load only the appropriate first/LCP image.
7. Do not import current files in this widget step; use the migration step after widget approval.
8. Keep each legacy section until approved.

Verification gates:

- Hero: test zero/one/many count data, long copy, and all viewports.
- Gallery: test 0, 1, 2, and many images; portrait/landscape; missing/deleted attachments; captions; keyboard; touch; reduced motion; and JS-disabled access.
```

## Prompt 17 — Optional free reusable Podcast/Education content

```text
Run this prompt only if the user confirms that Podcast episodes or Education resources must be reused across pages. Otherwise keep manual widget mode and mark this step deferred.

Build a free custom `toc-core` companion plugin. Do not use ACF.

Location rule:

- If wp-content/plugins is authorized/writable, create wp-content/plugins/toc-core.
- Otherwise create an installable package at packages/toc-core and document installation.

Tasks:

1. Register required content types/taxonomies with native WordPress APIs, REST support where useful, revisions, featured images, and confirmed public/archive behavior.
2. Register native post meta with sanitize/auth callbacks and create capability/nonced custom meta boxes for episode/resource fields.
3. Flush rewrites only on plugin activation/deactivation.
4. Keep presentation in the theme/widgets; keep content data in the plugin.
5. Connect Featured Podcast and Education Grid custom widgets with direct select/query controls—no Dynamic Tags.
6. Handle plugin inactive/empty/draft states safely.
7. Do not delete content on uninstall by default.

Verification:

- Activate/deactivate/reactivate and preserve records.
- Test capabilities, revisions, validation, REST visibility, queries, drafts, and missing-plugin fallback.
- Confirm there is no ACF or paid dependency.
```

## Prompt 18 — Build saved templates and migrate pages safely

```text
Build complete Elementor Free page/section templates and migrate content only after all relevant widget gates pass.

Tasks:

1. Import current content images into Media Library once with reviewable metadata/alt text.
2. Build unpublished Elementor versions of Home, Testing, and Gallery using only Elementor Free standard widgets and approved TOC widgets.
3. Create local saved templates for every TOC section and complete Home, Testing, Gallery, Standard Marketing, and Landing pages.
4. Export versioned JSON backups when supported without a paid plan and test re-import on staging.
5. Preserve public URLs, anchors, titles, status, and selected static front page.
6. Populate native Theme Settings and assign WordPress menus.
7. Implement any migration utility with dry-run, logs, capability/nonce protection, stored version, and idempotency. Never run it automatically.
8. Do not hand-edit Elementor metadata or use raw database replacements.
9. Switch public pages only after full desktop/tablet/mobile approval and backup.
10. Keep rollback copies and temporary legacy fallbacks until post-switch verification.

Verification:

- Create a new page from each saved page template without code.
- Run migration twice and prove no duplicate pages, attachments, templates, menus, or records.
- Verify editing every widget exposes no Pro-only control or upgrade requirement.
- Compare every migrated page with the original at all QA viewports.
```

## Prompt 19 — Remove legacy hard-coding and harden the site

```text
Run this only after migrated Elementor pages are live on staging and approved.

Tasks:

1. Remove obsolete hard-coded page sections, gallery filename arrays, fake form code, duplicated menu/social links, emails, and slug-based presentation logic now replaced by approved dynamic sources.
2. Remove/change the activation routine that creates Testing/Gallery pages; activation/update must never recreate deleted content.
3. Keep decorative assets and legitimate translation-ready interface strings.
4. Remove unused js/config.js or formally integrate it.
5. Remove unused CSS/JS only after selector usage and visual parity checks.
6. Audit/fix accessibility to WCAG 2.2 AA for theme-controlled interfaces.
7. Audit/fix contextual escaping, sanitization, capabilities, nonces, embeds, protocols, HTML-widget permissions, and secrets.
8. Audit/fix heading structure, server-rendered content, permalink/sitemap/SEO-plugin compatibility, and duplicate schema.
9. Audit/fix asset loading, responsive images, LCP/CLS, query limits, DOM size, third-party requests, and JavaScript-disabled access.
10. Update README.txt and IMPLEMENTATION-STATUS.md with only free dependencies and exact setup steps.

Verification:

- Search for every legacy value from Prompt 1's content map.
- PHP syntax and available lint/build checks.
- Keyboard/manual accessibility plus automated scans.
- Debug log, browser console, network, performance, light/dark, reduced motion, and all viewports.
- Confirm no paid/Pro class, widget, feature, or plugin is required.
```

## Prompt 20 — Final acceptance and administrator handoff

```text
Perform final acceptance against Section 23 of DYNAMIC-THEME-REQUIREMENTS.md. Do not claim completion for an unverified item.

Tasks:

1. Create an acceptance matrix for all 16 criteria with pass/fail, evidence, owner, and remaining action.
2. Test Home, Testing, Gallery, 404, generic pages/posts, any enabled archives/singles, and a new page built from a saved template.
3. Test every Theme Setting, menu, logo, social profile, custom widget, saved template, media workflow, reusable query, and free form.
4. Test drafts, preview, scheduling, autosave, revisions, permissions, logged-in/out, admin bar, browsers/devices, keyboard, screen reader basics, reduced motion, and light/dark.
5. Temporarily test Elementor Free inactive and form plugin inactive fallbacks on staging.
6. Confirm update/activation and migration idempotency cannot overwrite or duplicate content.
7. Create ADMIN-GUIDE.md explaining:
   - free dependencies and updates;
   - Theme Settings;
   - logos/Site Icon;
   - header/footer/legal menus;
   - colors and dark/light tokens;
   - Elementor editing, moving, hiding, and duplicating widgets;
   - inserting section/page templates;
   - creating a similar new page;
   - gallery/media and alt text;
   - podcast/resources if enabled;
   - form editing/testing;
   - revisions, cache clearing, backups, and rollback.
8. Finalize IMPLEMENTATION-STATUS.md, deployment steps, and rollback plan.

Final report:

- Explicitly prove Elementor Free is sufficient for every delivered editing workflow.
- List every installed plugin and state why it is free/required.
- Report any intentionally deferred optional feature; never substitute a paid feature.
```

---

## Optional future prompt — Add another Elementor Free section

```text
Add one new section to the existing TOC Elementor Free widget system.

First confirm its purpose, reference design, content controls, repeater limits, responsive behavior, light/dark behavior, animation/reduced-motion behavior, accessibility semantics, and whether it queries WordPress content.

Then implement one custom Elementor Free widget using existing helpers, semantic tokens, class conventions, dependency loading, safe controls, and server-side rendering. Do not use Pro APIs, Dynamic Tags, raw editor scripts, or unrelated add-on plugins.

Keep existing output unchanged, test editor/front-end parity and all standard states/viewports, create a saved section template, and update ADMIN-GUIDE.md and IMPLEMENTATION-STATUS.md.
```
