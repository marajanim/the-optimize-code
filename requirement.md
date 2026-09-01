# The Optimize Code — Website Developer Brief

## 1. Brand Overview
**The Optimize Code** is a personalized health, wellness, and health education brand focused on genetics, nutrigenomics, pharmacogenomics (PGx), preventive health, nutrition, longevity, lifestyle, and personalized health education.

- **Sector:** Health & Wellness / Personalized Health / Preventive Health
- **Industry:** Health Education & Personalized Diagnostics
- **Business type:** Health and wellness education + genetic testing platform

**Critical positioning note:** The Optimize Code is **NOT a medical clinic**. It is an education, media, personalized-health, and testing brand. This distinction must stay consistent across every page — copy, design, and flow should never imply the site is diagnosing, treating, or directing medication decisions.

---

## 2. Project Scope
This is a **full website build**, not a landing page. It must include:
- A real, functioning **testing purchase and checkout flow** (not a mockup)
- Two distinct testing pathways (see Section 3)
- An architecture that supports future expansion without a rebuild (see Section 5)

**Priority: quality over speed.** Take the time needed to build this properly.

---

## 3. Testing Flows — Two Separate Systems

### A. Nutrigenomics / Wellness Testing — Direct Purchase
Standard e-commerce flow: product page → cart → checkout → payment → order confirmation → fulfillment trigger to the lab.
*(Note: may vary by specific test/lab and state requirements — confirm case-by-case with client before assuming direct checkout applies.)*

### B. PGx (Pharmacogenomic) Testing — Clinician-Connected Request Flow
**Do not build this as a "buy now" product.** PGx results can affect medication decisions, so the flow must route through provider review:

1. Customer clicks **"Request PGx Testing"** (not "Buy")
2. Customer completes an intake form (personal info + relevant context)
3. Submission routes to a queue for licensed provider review/authorization
4. Once authorized, sample collection is arranged
5. Results are generated and reviewed/interpreted before release

**Important:** We are not building the medical-provider infrastructure itself — only the website-side workflow and the handoff point (e.g., form submission → webhook/API/CRM) that connects to the client's provider process. Confirm with the client what system (CRM, EHR-lite tool, Zapier, etc.) will receive this handoff before finalizing form fields.

**Design rule:** The PGx template must be structurally separate from the e-commerce template — different UI treatment, no cart/checkout styling, so it never visually reads as a standard product purchase.

---

## 4. Compliance & Copy Requirements
- Every testing-related page needs a consistent disclaimer (education vs. diagnosis, "not medical advice," provider-reviewed where applicable)
- Build the disclaimer as a **reusable component**, not copy-pasted text, so legal language stays consistent as more test pages are added
- Use the client-provided ChatGPT content only as a **starting reference** for messaging/structure — final copy and design should be original, professional, and built from scratch

---

## 5. Architecture — Build for Future Expansion
The client plans to add over time: podcast, video content, educational content/blog, "The Optimize Blueprint," additional testing categories, and other services. Build now so these can be added **without rebuilding the site**:

- Use a modular/component-based CMS approach (e.g., Webflow CMS, Sanity, or WordPress with ACF blocks)
- Set up page templates now (even empty/placeholder) for: Podcast, Video/Education Hub, Blog
- Testing hub page should be structured to accept new test categories as line items, not hardcoded

### Suggested initial site map
- Home
- About / Mission
- How It Works
- Testing (hub) → Nutrigenomics/Wellness → PGx
- The Optimize Blueprint
- Education / Blog (shell)
- Podcast (shell)
- Contact
- Legal / Disclaimers

---

## 6. Open Questions for Client (confirm before/during build)
- Which CRM, EHR-lite tool, or integration will receive PGx intake submissions?
- Payment timing for PGx: collected at request, or only after provider approval?
- Which specific labs/tests are launching first, and do any have state-specific purchase restrictions?
- Final visual identity direction (beyond "professional, not stock-clinic, not pastel-DTC")