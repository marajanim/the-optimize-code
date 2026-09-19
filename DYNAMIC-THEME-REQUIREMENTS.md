# The Optimize Code — Dynamic Elementor Free Theme Requirements

## 1. Purpose

This document defines the work required to convert the current WordPress theme into a fully editable site using **Elementor Free and free/open-source WordPress features only**.

Administrators must be able to:

- Edit all page text, images, buttons, links, lists, and approved colors without changing code.
- Add, remove, duplicate, hide, and reorder existing section designs in Elementor Free.
- Create a new page matching the existing design by inserting saved Elementor page/section templates.
- Manage the header menu through native WordPress menus.
- Manage the header logo through native WordPress Custom Logo settings.
- Manage footer text, logo, menus, social profiles, contact information, and legal text from a free theme settings screen.
- Manage gallery images through the WordPress Media Library.
- Embed forms created with an approved free form plugin.
- Preserve the current design, HTML structure, responsive layout, animation, light/dark mode, and accessibility behavior.

No paid plugin, paid Elementor feature, ACF PRO feature, Elementor Pro widget, Theme Builder template, Dynamic Tag, Loop Grid, Form widget, Popup Builder, Global Widget, or Pro-only custom CSS feature may be required.

## 2. Cost and dependency policy

### 2.1 Mandatory free dependencies

- WordPress.
- The current custom theme.
- Elementor Free from WordPress.org.
- One approved free form plugin with shortcode support. Contact Form 7 is the default recommendation; another free plugin may be selected before form integration.

### 2.2 Custom project code

The following functionality will be custom-developed as part of this project and will not require a license payment:

- The Optimize Code Elementor widget category.
- Custom Elementor Free widgets for each existing site section.
- Native WordPress theme settings for global header/footer/social/appearance data.
- Optional reusable Podcast and Education content types and their admin fields.
- Elementor widgets that query reusable WordPress content without Elementor Dynamic Tags.

Theme-specific Elementor widgets may live under `inc/elementor/` in the theme. Reusable business content types should live in a small custom `toc-core` plugin so their data survives a future theme change. Both are project code, not paid plugins.

### 2.3 Prohibited dependencies

The implementation must not depend on:

- Elementor Pro.
- ACF PRO or ACF Blocks.
- Paid dynamic-content, header/footer, forms, popup, loop, template, or custom-field add-ons.
- Paid template libraries.
- A free plugin whose required functionality is locked behind an upgrade.
- Remote page-builder scripts or widgets that can stop working when a subscription expires.

Before adding any new plugin, document its purpose, license, active maintenance status, data ownership, uninstall behavior, and whether the exact required feature is available in its free version.

## 3. Elementor Free capability boundary

Elementor Free can edit page/container layouts, use standard widgets, save page/container templates, use global colors/layout settings, render shortcodes, and load custom widgets registered through Elementor's developer APIs.

Elementor's Theme Builder and Dynamic Tags are Pro features. Therefore:

- Page sections will be custom Elementor widgets with normal Elementor controls and repeater controls.
- Header and footer will be rendered by the WordPress theme and managed through WordPress menus, Custom Logo, and a custom free Theme Settings screen.
- Reusable content queries will be implemented inside custom widgets using WordPress APIs.
- Forms will be created in a free form plugin and embedded with Elementor's Shortcode widget or a safe form-selection control.
- Global light/dark design tokens will be managed by the theme; individual widget overrides may be exposed in the Elementor Style tab.

Editors will be able to build unlimited layouts from the approved widget library. A completely new visual component still requires development so responsive behavior and design quality remain controlled.

## 4. Current-theme audit

| Area | Current implementation | Required free solution |
|---|---|---|
| Site logo | `custom-logo` support is registered but not rendered | Render native Custom Logo plus optional free Theme Settings variants |
| Menus | `primary` and `footer` locations are registered but not rendered | Use `wp_nav_menu()` for all global navigation |
| Home page | Sections are hard-coded in `front-page.php` | Convert one section at a time into custom Elementor Free widgets |
| Testing page | Content is hard-coded in `page-testing.php` | Convert into custom Elementor Free widgets |
| Gallery page | Theme-directory filenames are hard-coded | Custom Elementor Gallery widget using Media Library attachment IDs |
| Header | Brand, links, CTA, and loader copy are hard-coded | Native logo/menu plus free Theme Settings fields |
| Footer | Copy, links, socials, and legal text are hard-coded | Native menus plus free Theme Settings fields |
| Colors | CSS variables and raw values are spread across CSS | Central semantic theme tokens plus controlled widget Style controls |
| Forms | Newsletter only simulates success in JavaScript | Free form plugin embedded by shortcode |
| Generic pages | Standard WordPress content is supported | Add Elementor Full Width-compatible page template |
| Reusable content | No structured content model | Optional custom free `toc-core` plugin and query widgets |
| Activation | Testing/Gallery pages are created automatically | Replace with non-destructive setup guidance/migration |

## 5. No-structure-break migration strategy

The conversion must be incremental and reversible:

1. Keep the current hard-coded page output working initially.
2. Add the Elementor integration and one widget at a time.
3. For each widget, preserve the existing outer elements, class names, content order, CSS hooks, JavaScript hooks, and responsive breakpoints.
4. Compare the new widget against the existing section at desktop, tablet, and mobile sizes.
5. Do not migrate the next section until the current section passes visual and functional checks.
6. Build complete Elementor versions of Home, Testing, and Gallery as unpublished staging pages first.
7. Switch the public page only after content and visual parity approval.
8. Keep a temporary legacy fallback until the migrated page is approved.
9. Remove hard-coded content only after the Elementor page is published and backed up.
10. Never automatically replace `post_content`, delete Elementor metadata, or recreate pages during activation/update.

Elementor stores layout data in WordPress post metadata. Migration must use supported Elementor/WordPress APIs and must not construct or edit serialized/JSON metadata with unsafe search-and-replace operations.

## 6. Theme and Elementor integration

### 6.1 Theme support

The theme must:

- Detect whether Elementor Free is active without causing fatal errors.
- Show a dismissible administrator notice to authorized users when Elementor is missing.
- Register a **The Optimize Code** widget category.
- Register all custom widgets on Elementor's supported widget-registration hook.
- Register widget styles/scripts once and declare per-widget dependencies so unused assets are not loaded.
- Support Elementor Full Width for marketing pages while retaining the native theme header/footer.
- Support Elementor Canvas only as an optional intentionally headerless/footerless layout.
- Render `the_content()` normally so Elementor output, revisions, previews, and draft states work.
- Avoid wrapping Elementor content in the generic `.wp-page-content__inner` width restriction.
- Keep normal WordPress pages/posts working when they are not edited with Elementor.

### 6.2 Widget implementation standards

Every custom widget must:

- Extend Elementor's supported widget base class.
- Use a unique `toc-` widget name.
- Use Content, Style, and Advanced controls appropriately.
- Use Elementor repeater controls for repeatable cards, steps, links, or ticker items.
- Use Media controls and WordPress attachment IDs for images.
- Use URL controls for buttons/links, including target and `nofollow` options.
- Use responsive controls only where editor choice is safe.
- Use Elementor's global colors/fonts where practical, while defaulting to the theme's semantic design tokens.
- Sanitize settings and escape output by context.
- Provide safe defaults that match the current site design.
- Provide a useful editor preview and an empty-state message visible only to editors.
- Support inline editing for simple text where stable.
- Not expose raw PHP, JavaScript, unrestricted CSS, or unrestricted HTML to editors.
- Not allow controls that can destroy the layout, such as arbitrary negative offsets or unbounded item counts.
- Load JavaScript/CSS only when used.
- Render essential content in server-generated HTML.

### 6.3 Page-level editor behavior

Editors must be able to:

- Drag a TOC widget onto an Elementor page.
- Change all business content in the widget panel.
- Duplicate, move, hide responsively, save, and delete widgets/containers.
- Save a complete page or individual container as a local Elementor template.
- Insert saved templates into a new page.
- Preview desktop, tablet, and mobile layouts.
- Use WordPress drafts, revisions, scheduling, and permissions.
- Add a Menu Anchor widget or section CSS ID for stable anchor links.

## 7. Global WordPress-managed settings

Create a role-protected **Appearance > Theme Settings** screen using the native WordPress Settings API. Do not use ACF.

Settings must be split into clear tabs or sections:

- General
- Header
- Footer
- Social Profiles
- Appearance
- Integrations

Fields must have labels, help text, defaults, validation, sanitization, and capability checks. Settings must not contain API secrets.

### 7.1 General

- Public brand name and short brand name.
- Default contact email and optional phone/address.
- Organization legal name.
- Default CTA label/destination.
- Global educational/medical disclaimer.
- Copyright text with `{year}` token.
- Editable 404 eyebrow, heading, message, and button.

### 7.2 Header

- Native WordPress Custom Logo and text fallback.
- Optional light, dark, and compact/mobile logo attachment IDs.
- Primary WordPress menu.
- Header CTA label, URL, target, and visibility.
- Theme-toggle visibility and accessible labels.
- Optional announcement bar fields.
- Loader visibility, brand, progress/meta labels, and reduced-motion behavior.

### 7.3 Footer

- Footer logo attachment ID and text fallback.
- Brand description.
- Column headings.
- Footer WordPress menu locations.
- Contact details.
- Supported social-platform URL fields with enable/disable controls and labels.
- Legal/disclaimer text.
- Copyright and automatic year.
- Watermark text/visibility.

### 7.4 Appearance

Provide controlled semantic color settings for light and dark modes:

- Page and surface backgrounds.
- Primary and secondary text.
- Primary brand and accent colors.
- Border/divider color.
- Button and focus colors.
- Header/footer colors.
- Form validation colors.

Generate validated CSS custom properties through `wp_add_inline_style()` or a similarly safe WordPress mechanism. Do not write generated CSS files from admin requests.

Default custom Elementor widgets must inherit semantic variables. Widget Style controls may override approved values at widget scope. Global typography/layout should use Elementor Free Site Settings or theme tokens, with a documented single source of truth to prevent conflicts.

## 8. Native header requirements

Use the theme's `header.php`, not Elementor Theme Builder.

- Render Custom Logo with an accessible home link and brand-text fallback.
- Render the `primary` menu through `wp_nav_menu()`.
- Support nested items, active/current states, internal anchors, external links, targets, and relationships.
- Generate desktop and mobile navigation from the same menu.
- Preserve current header markup/classes wherever possible.
- Make the CTA, loader, announcement, and theme toggle dynamic from Theme Settings.
- Remove `is_page('testing')` and `is_page('gallery')` decisions for presentation/CTA content.
- Support keyboard navigation, Escape close, focus handling, visible focus, and reduced motion.
- Retain the logged-in WordPress admin-bar offset.

Required menu locations:

- `primary`
- `footer_explore`
- `footer_services`
- `footer_legal`

## 9. Native footer requirements

Use `footer.php`, not Elementor Theme Builder.

- Render footer logo/fallback from Theme Settings.
- Render Explore, Services, and Legal links through native WordPress menus.
- Render editable brand copy, contact data, legal/disclaimer copy, copyright, and watermark.
- Render enabled social profiles in configured order or a documented fixed platform order.
- Package social icons locally; remove third-party CDN icon dependencies.
- Do not output empty wrappers, headings, links, or broken image elements.
- Preserve the current footer markup/classes, layout, light/dark behavior, and responsive breakpoints.

## 10. Elementor Free section widget library

Create the widgets below one at a time. Each must reproduce the current corresponding section before new variants are introduced.

### 10.1 TOC Hero

- Kicker lines, title lines, approved highlighted line, description, background/mobile image, focal position, overlay, two buttons, rail/meta labels, section ID, height, alignment, and approved style.

### 10.2 TOC Ticker

- Repeater text items, allowlisted separator, direction, approved speed range, pause-on-hover, and static reduced-motion output.

### 10.3 TOC Featured Podcast

- Manual artwork, episode number, tags, duration, title, summary, URL, and audio/embed URL.
- Optional selected/latest Podcast mode implemented without Dynamic Tags.
- Play control only for a valid supported audio source, with a normal-link fallback.

### 10.4 TOC Section Header

- Eyebrow, heading, safe emphasis, description, optional action link, alignment, and approved width.

### 10.5 TOC Feature Cards

- Repeater with index, label, glyph/approved icon, title, description, and link.
- Approved columns/styles and a reasonable maximum count.

### 10.6 TOC Blueprint Story

- Stamp, heading, content, CTA, orbit or image mode, editable orbit labels, media side, and background.

### 10.7 TOC Process Steps

- Repeater stage label, title, description, number/icon, horizontal/vertical style, and safe item limits.

### 10.8 TOC Education Grid

- Manual repeater mode plus optional WordPress-content query mode implemented directly in the widget.
- Selected/latest/category filters, limit, featured item, CTA, and empty state.

### 10.9 TOC CTA / Newsletter

- Eyebrow, heading, description, feature list, privacy note, background style, and form shortcode/selection.
- No fake submission or fake success state.

### 10.10 TOC Testing Hero

- Eyebrow, title, intro, CTA, background/style, and anchor.

### 10.11 TOC Testing Pathways

- Repeater with type/status, title, description, steps, CTA, notice, style, safe limits, numbering, and disclaimer warning.

### 10.12 TOC Notice / Disclaimer

- Heading, content, allowlisted icon, severity/style, and semantic role.

### 10.13 TOC PGx Request CTA

- Eyebrow, heading, description, CTA/form shortcode, and disclaimer.
- A basic free form must not collect medical/genetic details unless an approved secure service is configured.

### 10.14 TOC Gallery Hero

- Eyebrow, heading, intro, optional date, and calculated gallery count when connected.

### 10.15 TOC Gallery

- Media Library images, manual order, captions/credits, columns/layout, load-more option, accessible lightbox, responsive image dimensions, and non-JavaScript image links.

### 10.16 TOC Media + Text

- Image/video, heading, content, CTA, media side, and approved style.

### 10.17 Standard Elementor widgets

Use Elementor Free Heading, Text Editor, Image, Video, Button, Divider, Spacer, Icon List, Accordion, and Shortcode widgets when they meet the design. Do not create a custom widget merely to rename an existing free widget.

## 11. Saved page and section templates

Create local Elementor templates for:

- Complete Home, Testing, Gallery, Standard Marketing, and Landing pages.
- Each individual TOC section/container.

Templates must use only Elementor Free widgets and custom TOC widgets. They must not contain missing Pro widgets, Pro Dynamic Tags, remote subscription assets, hard-coded production domains, or duplicate HTML IDs.

Creating a similar new page must require only:

1. Add a WordPress Page.
2. Select the Elementor Full Width page template.
3. Edit with Elementor.
4. Insert the closest saved page template.
5. Change content and add/remove/reorder widgets.
6. Publish and add the page to a WordPress menu.

Where practical, export versioned template JSON files for backup/distribution. Import/export must be tested on staging before production use.

## 12. Reusable WordPress content

Elementor Free Dynamic Tags are unavailable. Reusable content must therefore be selected and rendered directly by custom TOC widgets.

### 12.1 Podcast

The optional free custom `toc-core` plugin may register Podcast content with:

- Title, slug, content, excerpt, featured image, and revisions.
- Episode number, duration, audio/embed URL, hosts/guests, transcript, topics, and platform URLs using native registered post meta and custom meta boxes.

### 12.2 Education resources

Use normal WordPress Posts with categories when sufficient. If separate administration is required, `toc-core` may register Education Resources with title, content, excerpt, featured image, type, duration, topics, external URL, and featured state.

### 12.3 Query widgets

Custom Elementor widgets must provide their own select/query controls and render records with WordPress APIs. They must:

- Use explicit query limits.
- Exclude unpublished content publicly.
- Avoid unbounded queries and N+1 media/meta loading.
- Handle the custom content plugin being inactive.
- Resolve internal links by post ID/permalink.

## 13. Media requirements

- Store attachment IDs, not theme-directory content filenames or absolute production URLs.
- Use WordPress image functions for `srcset`, `sizes`, dimensions, and alt text.
- Require meaningful alt-text guidance and allow empty alt for decorative media.
- Support hero focal point and optional mobile image.
- Eager-load only the likely LCP image and lazy-load below-the-fold images.
- Calculate gallery counts rather than hard-coding them.
- Import current content images into the Media Library during migration.
- Keep only decorative/theme-owned assets in the theme directory.

## 14. Forms and integrations

- Use one approved free form plugin and its shortcode.
- Embed forms with Elementor Free's Shortcode widget or a controlled custom widget field.
- Remove the current JavaScript-only fake success behavior.
- Require server-side validation, nonce/CSRF protection supplied by the form plugin, available free spam protection, and accessible error/success output.
- Do not place API keys in theme settings, Elementor data, HTML, or JavaScript.
- Document recipients, stored fields, consent, privacy link, retention, export/deletion, and third parties.
- PGx forms must collect only basic contact/request information unless a separately approved secure/compliant workflow is available.
- If a required capability is paid-only, simplify the workflow or implement a secure custom solution; do not silently introduce a paid add-on.

## 15. Links and buttons

- Use Elementor URL controls or native WordPress link selection.
- Support target and relationship settings.
- Validate external URLs and email links.
- Do not render a CTA if its label or destination is missing.
- Sanitize and keep anchor IDs unique.
- Internal links should use WordPress IDs/permalinks when selected from reusable content.
- Preserve visible keyboard focus and approved button variants.

## 16. Accessibility

Target WCAG 2.2 AA for theme-controlled output.

- Full keyboard access for header/mobile menus, theme switch, gallery/lightbox, media controls, widgets, forms, and buttons.
- Correct focus trap/restoration for modal interfaces.
- Visible focus states in both themes.
- Logical landmarks and heading order; one meaningful page-level `h1`.
- Labels, alt text, current states, and live-region messages.
- `prefers-reduced-motion` support for ticker, loader, reveal, parallax, waveform, and orbit motion.
- No autoplay audio/video with sound.
- Color contrast and usable touch targets.
- Elementor controls must not make inaccessible combinations the default.

## 17. Security

- Escape all custom widget output according to context.
- Sanitize and validate Theme Settings and registered post meta.
- Use capability checks and nonces for custom admin writes.
- Do not allow editors to insert arbitrary scripts, PHP, unrestricted iframes, or global CSS.
- Restrict Elementor HTML widget access to trusted administrators if it remains enabled.
- Use allowlists for embeds, icons, styles, and protocols.
- Never store secrets in the repository or Elementor page metadata.
- Keep WordPress, Elementor Free, the form plugin, and custom code updateable.

## 18. Performance

- Preserve or improve current mobile/desktop performance.
- Register widget dependencies and let Elementor load them only for widgets present on the page.
- Do not install broad Elementor add-on packs for one widget.
- Minimize DOM wrappers while retaining Elementor editor compatibility.
- Use responsive images, dimensions, lazy loading, and LCP priority correctly.
- Host stable icons/assets locally.
- Use query limits and cache expensive reusable-content lookups where justified.
- Prevent cumulative layout shift.
- Keep essential content available in server-rendered output.
- Remove unused legacy CSS/JS only after complete visual parity testing.

## 19. SEO and editorial behavior

- Support a free SEO plugin if selected; do not duplicate its controls.
- Maintain one `h1` and a logical heading structure.
- Keep essential text in HTML, not only animations or pseudo-elements.
- Use WordPress permalinks and sitemap behavior.
- Retain drafts, revisions, scheduled publication, preview, and permissions.
- Do not overwrite Elementor content on activation/update.
- Keep developer interface strings translation-ready with the existing text domain.

## 20. Migration requirements

Migration must run on staging, be explicit, and be safe to repeat.

1. Back up files and database.
2. Install/activate Elementor Free and the selected free form plugin.
3. Add theme compatibility and the first custom widget without changing public output.
4. Convert and approve sections one by one in this order:
   - Header/footer global settings;
   - Home Hero;
   - Home Ticker;
   - Featured Podcast;
   - Feature Cards;
   - Blueprint Story;
   - Process Steps;
   - Education Grid;
   - Newsletter CTA;
   - Testing Hero;
   - Testing Pathways/Disclaimer/PGx CTA;
   - Gallery Hero/Gallery.
5. Import content images into the Media Library.
6. Create complete unpublished Elementor versions of existing pages.
7. Compare every section at desktop, tablet, and mobile sizes.
8. Publish/switch only after approval and preserve URLs.
9. Populate Theme Settings and assign WordPress menus.
10. Remove the activation routine that creates Testing/Gallery pages.
11. Remove legacy hard-coded content only after rollback material exists.

The migration must not manipulate Elementor metadata with raw database replacement and must not duplicate pages, attachments, menu items, templates, or reusable records when rerun.

## 21. Suggested code organization

```text
the-optimize-code-1/
├── inc/
│   ├── theme-setup.php
│   ├── assets.php
│   ├── menus.php
│   ├── theme-settings.php
│   ├── template-tags.php
│   ├── elementor/
│   │   ├── bootstrap.php
│   │   ├── category.php
│   │   ├── helpers.php
│   │   └── widgets/
│   │       ├── class-toc-hero.php
│   │       ├── class-toc-ticker.php
│   │       └── ...
│   └── migration.php
├── css/
│   ├── elementor-widgets.css
│   └── ...
├── js/
│   ├── elementor-widgets.js
│   └── ...
├── assets/elementor-templates/
│   ├── home.json
│   ├── testing.json
│   └── gallery.json
├── templates/
│   └── elementor-full-width.php
└── functions.php

packages/toc-core/              # Installable free custom companion plugin
├── toc-core.php
└── inc/
    ├── post-types.php
    ├── meta-boxes.php
    └── capabilities.php
```

## 22. Testing requirements

### 22.1 Section-by-section parity

For each converted widget:

- Capture/reference the legacy section before conversion.
- Test the same content in the Elementor widget.
- Compare desktop, tablet, and mobile structure.
- Verify animations, links, hover/focus states, themes, and reduced motion.
- Test minimum, normal, maximum, missing, and long content.
- Confirm no CSS/JavaScript console error or PHP warning.
- Obtain approval before removing the legacy version.

### 22.2 Elementor editor

- Insert, edit, duplicate, move, hide, save, reload, revise, and delete every custom widget.
- Save and insert each section template.
- Build a new page from a saved page template without code.
- Test editor/frontend parity and responsive controls.
- Test with Elementor Free active, temporarily inactive, and updated in staging.
- Confirm no Pro upgrade is required to edit any project widget field.

### 22.3 Global functionality

- Change every Theme Setting and menu assignment.
- Test missing logos/menus/settings.
- Test forms for success, validation failure, spam, provider failure, and keyboard/screen-reader use.
- Test supported browsers, common mobile devices, logged-in/out views, and admin bar.
- Run PHP syntax, WordPress coding, JavaScript, and CSS checks where configured.
- Check WordPress debug log and browser console.

## 23. Acceptance criteria

The work is complete only when:

1. Elementor Free is the only required page builder and Elementor Pro is not installed or required.
2. No ACF PRO or other paid plugin is required.
3. Every current page section is an editable TOC Elementor widget or suitable standard Elementor Free widget.
4. Editors can add, remove, duplicate, hide, and reorder sections without code.
5. Home, Testing, and Gallery can be edited in Elementor without material visual/structural regression.
6. A matching new page can be created from a saved template without PHP changes.
7. Header logo and menus are controlled through native WordPress settings/menus.
8. Footer content, menus, socials, and legal text are dynamically controlled through free native settings.
9. Gallery content uses the Media Library instead of a hard-coded filename array.
10. Global colors and approved widget styles can be changed without editing CSS.
11. Forms use an approved free, real server-side workflow; fake form behavior is gone.
12. No public business content requires editing PHP, CSS, or JavaScript.
13. Existing responsive design, light/dark mode, motion, accessibility, SEO, and performance remain functional.
14. Activation/update never overwrites, duplicates, or recreates editor content.
15. Saved templates and custom widgets contain no Pro-only control.
16. An administrator guide documents editing workflows and free dependencies.

## 24. Recommended delivery phases

### Phase 1 — Safe foundation

- Backups, audit, Elementor Free compatibility, Theme Settings, menus, logos, semantic tokens, and unchanged public output.

### Phase 2 — Global components

- Dynamic native header, mobile navigation, loader, footer, social links, legal content, and 404 content.

### Phase 3 — Elementor widgets section by section

- Implement one widget, test visual parity, approve it, and then proceed to the next widget in the migration order.

### Phase 4 — Page templates and migration

- Build unpublished Elementor pages, import media, create local templates, compare, and switch after approval.

### Phase 5 — Free forms and reusable content

- Add the selected free form workflow and optional `toc-core` content/query features.

### Phase 6 — Hardening and handoff

- Accessibility, security, SEO, performance, regression, documentation, deployment, and rollback plan.

## 25. Decisions required before implementation

- Confirm Elementor Free as the only page builder.
- Select the free form plugin; Contact Form 7 is the default if no preference exists.
- Decide whether Podcast/Education items need reusable records or may initially remain in widget controls.
- Decide whether PGx is a basic contact request or uses an approved secure external workflow.
- Confirm which roles can change Theme Settings and Elementor pages.
- Confirm browser/device support and performance targets.
- Confirm whether the current light/dark toggle remains user-selectable.

## 26. Official references

- [Elementor custom widgets](https://developers.elementor.com/docs/widgets/)
- [Registering Elementor widgets](https://developers.elementor.com/docs/widgets/add-new-widget/)
- [Elementor repeater control](https://developers.elementor.com/docs/editor-controls/control-repeater/)
- [Elementor widget asset dependencies](https://developers.elementor.com/docs/widgets/widget-dependencies/)
- [Elementor saved page and container templates](https://elementor.com/help/create-templates-for-faster-website-building/)
- [Elementor global colors](https://elementor.com/help/view-and-edit-global-colors/)
- [Elementor global layout settings](https://elementor.com/help/global-layout-settings/)
- [Elementor Shortcode widget](https://elementor.com/help/shortcode-widget/)
- [Elementor Dynamic Tags are a Pro feature](https://elementor.com/help/intro-to-dynamic-content/)
