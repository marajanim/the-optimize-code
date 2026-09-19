# The Optimize Code — Administrator & Editor Guide

This guide explains how to manage, edit, and maintain **The Optimize Code** website using **Elementor Free** and native WordPress features—with zero paid licenses or third-party Pro add-ons.

---

## 1. Free Architecture & Plugin Dependencies

The site is built strictly with free and open-source tools:

| Feature | Provider / Technology | Cost |
| :--- | :--- | :--- |
| **Page Layout & Sections** | Elementor Free + Custom TOC Widgets | Free |
| **Global Theme Settings** | Native WordPress Settings API (`Appearance > Theme Settings`) | Free |
| **Header & Footer Menus** | Native WordPress Menus (`Appearance > Menus`) | Free |
| **Site Branding & Logos** | Native WordPress Custom Logo + Theme Settings | Free |
| **Form Submissions** | Contact Form 7 (or any free shortcode form plugin) | Free |
| **Reusable Podcasts / Guides** | Custom `toc-core` companion plugin (`packages/toc-core/`) | Free |

> [!NOTE]
> **No Paid Dependencies**: This website does **not** use or require Elementor Pro, ACF PRO, Theme Builder, Loop Grid, Form Builder, Dynamic Tags, or Pro custom CSS.

---

## 2. Appearance > Theme Settings

Administrators can configure all global site data from **Appearance > Theme Settings**:

### 2.1 General Tab
- **Brand name**: e.g., `THE OPTIMIZE CODE`
- **Short brand name**: e.g., `TOC` (used in mobile views and footer brand)
- **Contact email**: Default inquiries email
- **Default CTA label & URL**: Global fallback action button
- **Global disclaimer**: Educational content notice
- **Copyright text**: Supports `{year}` token (automatically outputs current year)
- **404 Page**: Editable eyebrow, title, message, and home button label

### 2.2 Header Tab
- **Logos**: Select separate Light-background, Dark-background, and Mobile logos from the Media Library.
- **Header CTA**: Change button text, URL, and whether it opens in a new tab.
- **Theme toggle**: Enable or disable the floating light/dark theme switch.
- **Announcement bar**: Enable an optional site-wide banner with text and link.
- **Loading screen**: Configure loader brand text, established year, and status message.

### 2.3 Footer Tab
- **Footer logo & description**: Brand statement.
- **Column titles**: Headings for Explore, Services/Testing, and Social columns.
- **Legal text**: Educational disclaimer.
- **Watermark**: Giant background brand watermark (`OPTIMIZE`) with toggle.

### 2.4 Social Profiles Tab
- Toggle and set URLs for **Facebook**, **TikTok**, **Instagram**, **YouTube**, **LinkedIn**, and **Email**.
- Icons use local SVG/monograms without external CDN dependencies.

### 2.5 Appearance Tab (Colors & Design Tokens)
- Fine-tune semantic colors for both **Light Mode** and **Dark Mode**:
  - Page Background (`--ink`)
  - Surface Color (`--ink-2`)
  - Primary Text (`--sky`)
  - Secondary Text (`--sky-dim`)
  - Border Color (`--line`)
  - Accent Color (`--lime`)
- Automatically injected into CSS via safe inline properties (`wp_add_inline_style`).

### 2.6 Integrations Tab
- **Newsletter form shortcode**: Paste your form plugin shortcode (e.g. `[contact-form-7 id="..."]`).
- **PGx contact form shortcode**: Paste clinician contact form shortcode.

---

## 3. Navigation Menus

Manage menus in **Appearance > Menus**:

- **Primary navigation**: Main header menu. Supports dropdown sub-items, page links, and internal `#anchors`.
- **Footer: Explore**: Left column links in the footer.
- **Footer: Services**: Middle column links (wellness tests, PGx info).
- **Footer: Legal**: Bottom bar legal links (privacy policy, terms).

---

## 4. Editing Pages in Elementor Free

### 4.0 Setting Up the Home Page for Elementor

In standard WordPress, the homepage is initially set to show latest posts, meaning there is no static page assigned to the root URL. To edit your Home page with Elementor:

**Option A (Automatic via TOC Migration Tool):**
1. Go to **Tools > TOC Migration** in WP Admin.
2. Under **Step 2 (Generate Elementor Page Drafts)**:
   - Uncheck *Dry run*.
   - Check *Publish and set Home as the static Front Page in Settings > Reading*.
   - Click **Generate Elementor Draft Pages**.
3. Your Home page is immediately created with all 8 TOC widgets placed, assigned as the Front Page, and ready for editing!

**Option B (Manual Setup):**
1. Go to **Pages > Add New**. Title it **Home**.
2. In the right panel under **Page Attributes**, set **Template** to **Elementor Full Width** (or Front Page). Click **Publish**.
3. Go to **Settings > Reading** in WP Admin.
4. Under **Your homepage displays**, select **A static page (select below)** and set **Homepage:** to **Home**.
5. Click **Save Changes**.
6. Now go to **Pages > All Pages**, hover over **Home**, and click **Edit with Elementor** (or visit your site and click **Edit with Elementor** in the top admin bar).

### 4.1 How to Edit Any Page
1. Go to **Pages > All Pages** in your WordPress dashboard.
2. Click **Edit with Elementor** on the page.
3. In the left panel, scroll to or search for the **The Optimize Code** widget category.

### 4.2 Custom TOC Widget Library

| Widget | Purpose | Key Controls |
| :--- | :--- | :--- |
| **TOC Section Header** | Standalone section titles & kickers | Split (`.feature__head`) or Stacked (`.receipts__head`) layout, eyebrow, title, description, action link |
| **TOC Hero** | Full-height home hero | Kicker lines, dual title lines with accent, buttons, background/mobile image, rail metadata |
| **TOC Ticker** | Continuous scrolling marquee | Repeater text items, speed slider, direction, allowlisted separators (`+`, `·`, `*`, `/`) |
| **TOC Featured Podcast** | Featured podcast card | Artwork, episode number, waveform graphic, tag badges, direct audio player link |
| **TOC Feature Cards** | 4-column perspective grid | Repeater for index, glyph, title, summary, action link |
| **TOC Blueprint Story** | Two-column story section | Stamp, heading, paragraph, button, animated orbit visual or custom image |
| **TOC Process Steps** | Horizontal step cards | Repeater stage label, title, description, auto or custom numbering (`01`, `02`...) |
| **TOC Education Grid** | Resource & article cards | Manual repeater or WordPress query mode, featured card style, category badges |
| **TOC CTA / Newsletter** | Newsletter lead capture | Eyebrow, heading, feature badges, embedded form shortcode, privacy note |
| **TOC Testing Hero** | Testing page top banner | Eyebrow, heading, intro paragraph, compare pathways CTA |
| **TOC Testing Pathways** | Wellness vs. PGx cards | Pathway cards repeater, steps list, direct vs. clinician-connected badges |
| **TOC Notice / Disclaimer** | Educational & medical notice | Heading, body text, border styling |
| **TOC PGx Request CTA** | Clinician pathway callout | Eyebrow, heading, description, outline-lime action button or secure form |
| **TOC Gallery Hero** | Gallery page banner | Eyebrow, heading, meta info line |
| **TOC Gallery / Lightbox** | Responsive photo gallery | Media Library multi-image selection, numbering tags, built-in lightbox |

---

## 5. Adding & Reordering Sections

- **To reorder**: Drag any TOC widget up or down in the Elementor preview or Navigator panel.
- **To duplicate**: Right-click the widget handle and select **Duplicate**.
- **To hide responsively**: Select widget > **Advanced > Responsive** > toggle *Hide on Mobile/Tablet/Desktop*.
- **To delete**: Right-click and select **Delete**.

---

## 6. Creating a New Page with Templates

1. Go to **Pages > Add New**.
2. Set the Page Template to **Elementor Full Width** in the right Page Attributes panel.
3. Click **Edit with Elementor**.
4. Drag any TOC widgets onto the canvas to construct your custom layout.
5. Publish when ready.

---

## 7. Migration & Rollback Tools

Located at **Tools > TOC Migration**:
- **Initialize Theme Settings**: Safely populates default options without overwriting your custom inputs.
- **Generate Elementor Drafts**: Programmatically generates draft Elementor pages for Home, Testing, and Gallery for review.
- **Export Templates JSON**: Download a full JSON backup of all TOC page and section templates.
- **Public Fallback Safety**: Legacy templates remain active as safe fallbacks until the Elementor version is published.
