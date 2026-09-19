THE OPTIMIZE CODE WORDPRESS THEME
=================================
A custom, high-performance WordPress theme designed for personalized health education,
wellness insights, and dynamic page building with Elementor Free.

License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

FREE-ONLY ARCHITECTURE
----------------------
This theme is built strictly on 100% free and open-source software:
- WordPress Core (Native Settings API, Nav Menus, Custom Logo, Media Library)
- Elementor Free (WordPress.org)
- One approved free form plugin (e.g., Contact Form 7)
- Optional free companion plugin: TOC Core (`packages/toc-core/`)

NO PAID PLUGINS OR PRO LICENSES ARE REQUIRED.
Never requires Elementor Pro, ACF PRO, Theme Builder, Loop Grid, Dynamic Tags,
Form Builder, Popup Builder, or paid add-ons.

INSTALLATION & SETUP
--------------------
1. Upload & Activate Theme:
   - In WordPress admin, go to Appearance > Themes > Add New > Upload Theme.
   - Upload this theme folder / zip and click Activate.

2. Install Elementor Free:
   - Go to Plugins > Add New.
   - Search for "Elementor", install and activate the free version from WordPress.org.

3. (Optional) Install TOC Core Companion Plugin:
   - If reusable Podcast episodes and Education resources are needed across pages,
     copy or zip `packages/toc-core/` and install it via Plugins > Add New > Upload Plugin.
   - Activate "The Optimize Code — Core Companion".

4. (Optional) Install Form Plugin:
   - Install and activate Contact Form 7 (or your preferred free form plugin).
   - Create your contact / newsletter form and paste its shortcode into the TOC CTA widget.

5. Configure Permalinks:
   - Go to Settings > Permalinks and choose "Post name" (%postname%), then click Save Changes.

6. Configure Navigation Menus:
   - Go to Appearance > Menus.
   - Assign menus to the registered locations:
     * Primary Navigation (header)
     * Footer: Explore
     * Footer: Services
     * Footer: Legal

7. Configure Global Theme Settings:
   - Go to Appearance > Theme Settings.
   - Set up your Brand & Header settings (CTA button, status ticker).
   - Configure Footer text, contact email, social links, and legal disclaimer.
   - Customize Light / Dark mode color tokens and typography if needed.

PAGE EDITING WITH ELEMENTOR FREE
--------------------------------
1. To edit Home, Testing, or Gallery pages:
   - Create or edit a page in WordPress.
   - Set Page Attributes > Template to "Elementor Full Width" (or use front-page/testing/gallery templates).
   - Click "Edit with Elementor".
   - The TOC widget category ("The Optimize Code") contains 15 custom free widgets:
     * TOC Section Header
     * TOC Hero
     * TOC Ticker
     * TOC Featured Podcast
     * TOC Feature Cards
     * TOC Blueprint Story
     * TOC Process Steps
     * TOC Education Grid
     * TOC CTA & Newsletter
     * TOC Testing Hero
     * TOC Testing Pathways
     * TOC Notice & Disclaimer
     * TOC PGx Request
     * TOC Gallery Hero
     * TOC Gallery Wall
2. All widgets feature instant live preview inside the Elementor Free editor.
3. Legacy templates remain active as safe fallbacks until Elementor pages are published.

MIGRATION UTILITY
-----------------
- Go to Tools > TOC Migration to simulate (dry-run) or generate draft Elementor pages
  from legacy layouts, or export local JSON templates.
- Migration is strictly guarded with nonces and admin capabilities; it never runs automatically.
- Re-running migration is completely idempotent and will not duplicate content.

DOCUMENTATION
-------------
For comprehensive administration, editing, and customization instructions,
refer to ADMIN-GUIDE.md included in the theme root.
