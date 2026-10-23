# Solevo design system and page templates

Version 1.2 of the theme. Covers the rebuild brief deliverables A to F: technical audit, components, template map, the gold-standard Physio page, preview, and how it ships.

Preview (view-only, noindex): https://crosslinkdigital.github.io/solevo-website/physio.html

## A. Technical audit

| Question | Finding |
|---|---|
| Editor | Gutenberg block editor. No page builder, no Elementor. |
| Theme type | Custom **block theme** (Full Site Editing): `theme.json`, HTML templates and template parts, PHP patterns. |
| Templates | `front-page`, `page` (default), `page-service`, `page-condition`, `page-full`, plus `404`, `index`, `single`. v1.2 adds `page-studio`. |
| Reusable parts | Header, footer, booking band (template parts). 15 homepage patterns. v1.2 adds 10 component patterns. |
| CSS | One stylesheet (`style.css`), also loaded in the editor so pages look the same while editing. |
| Plugins | None required. SEO fields, sitemap, breadcrumbs, booking links, tracking and schema are in the theme. Optional: Trustindex (Google reviews), Smash Balloon (Instagram). |
| Booking | Buttons link to `#cliniko` (physio) and `#mindbody` (studio). The real URLs come from Settings > Solevo and every click is pushed to the dataLayer. |
| Content | 30 pages created by Appearance > Solevo setup from `inc/pages.php` (URL, parent, template, SEO title, meta, excerpt, scaffold). |
| Staging | Hostinger. Theme uploaded as a zip on 19 Oct; GitHub auto-deploy waits on SSH secrets. |

**Recommendation: keep the architecture and extend it.** It already meets the brief's preferred outcome (WordPress stays the editor, no page builder, minimal plugins). v1.2 adds a component layer on top rather than replacing anything:

- **Components are PHP functions that write core blocks** (`inc/components.php`). Pages are built from them, so the result is ordinary groups, headings, lists, buttons, images and Details blocks. Editors change copy, links, images, FAQs and prices in the block editor with no code.
- **The look lives in CSS classes** (`style.css`, "Design system" section). One change restyles every page that uses the component.
- **Shared data lives in Settings > Solevo**: both locations, hours, phone, Cliniko and Mindbody links. Location cards, chips, schema and booking buttons read from there, so name, address and phone are identical everywhere.
- **Context-aware chrome**: the header button, final booking band and mobile sticky bar read the page's booking path from `inc/pages.php`. Physio pages say Book Physio (Cliniko), studio pages say Book Studio (Mindbody). Nobody has to remember to set it.

## B. Components

| Component | Function | Inserter pattern | Notes |
|---|---|---|---|
| Hero with locations | `solevo_c_hero()` | Solevo components > Hero with locations | H1, lead, buttons, both location chips, trust line, photo. Photo hidden under 600px so the CTA stays above the fold. |
| Question boxes | `solevo_c_help_grid()` | Question boxes | Core Details blocks, tap to open, no JavaScript. Icon set: back, shoulder, knee, sport, tendon, surgery, womens, strength. |
| Service cards | `solevo_c_service_cards()` | Service cards | Links down to child pages (category to child linking rule). |
| Care pathway | `solevo_c_pathway()` | (inside Service cards) | Physio, Clinical Pilates, Studio classes, and which system books each. |
| Patient journey | `solevo_c_journey()` | Patient journey | Three steps plus "Your first appointment" facts. |
| Why Solevo | `solevo_c_why()` | Why Solevo | Four reasons and a row of short points. |
| Facilities and assessment | `solevo_c_facilities()` | Facilities and assessment | Olive band, benefit-led list, 1 to 3 photos. |
| Practitioner and trust | `solevo_c_practitioner()` | Practitioner and trust | Qualifications and compliant trust points. No testimonials. |
| Fees, funding and FAQs | `solevo_c_fees_faq()` | Fees, funding and FAQs | Fee card beside an accordion. |
| FAQ | `solevo_c_faq()` | FAQ accordion | For condition, studio and info pages. |
| Location cards | `solevo_c_locations()` + `[solevo_locations]` | Location cards | Per-location Book Physio button (`#cliniko-location1`, `#cliniko-location2`) and directions. |
| Final booking band | `[solevo_cta_band]` in the booking band part | automatic | Matches the page: Book Physio, Book Studio, or both. |
| Mobile sticky booking bar | `inc/booking.php` | automatic | Appears once the hero buttons scroll away, hides at the final band. |
| Breadcrumbs | `[solevo_breadcrumbs]` | in templates | With BreadcrumbList schema. |
| Related pages | `solevo_c_related()` | | Pills linking related services and conditions. |
| Reviewed by | `[solevo_reviewed by="" role="" date=""]` | | Shows nothing until a clinician is filled in. |
| Editor notes | `[solevo_todo]...[/solevo_todo]` | | "To confirm" notes only logged-in editors see. |

Design tokens (`:root` in `style.css`): body 17px mobile to 18px desktop; charcoal text `#333230` (12:1 on linen); secondary `#57534C` (7.2:1); olive `#5F6B52` for buttons (white text 5.7:1); small olive text `#4C573F` (7.2:1). Every text and button pair meets WCAG AA. H1 to body ratio is about 3.5:1 on desktop, smaller on mobile. Buttons: primary (olive), outline, and an uppercase text link. Minimum tap target 48px.

### Client readability feedback (23 Oct), applied site-wide

| Feedback | Done |
|---|---|
| Light grey on cream, pale copy on olive | Body text charcoal `#333230`, no 300-weight body copy. Text on olive is solid `#F6F3EC` (5.1:1), eyebrows `#EEF0E8` (4.9:1). Footer text 6.5 to 9.4:1. All pairs WCAG AA. |
| Body 17 to 18px, descriptors, bullets, links, footer up too | Body 17px mobile, 18px desktop everywhere. Descriptors, bullets and FAQ answers 17px; small labels 15px minimum; booking links and buttons 14px uppercase; footer 15 to 16px. |
| Smaller heading gap, more line spacing, strong buttons | H2 now 32 to 44px (was up to 54px), hero H1 up to 78px (was 100px). Line height 1.7. Buttons olive with white (5.7:1) or cream with dark olive (8.2:1). |
| Oversized empty space, mobile layout, sticky booking | Section padding 48 to 72px (was 64 to 96px); booking band no longer forced to 44rem; homepage hero capped and auto height on mobile; tighter gaps between headings, photos and team profiles. Sticky Book Physio / Book Studio bar on mobile on the homepage and every service, condition and studio page. |

## C. Page and template map

| Page type | Template | Pages |
|---|---|---|
| Homepage (bespoke) | `front-page` | `/` (phase 5 moves it onto the design system) |
| Service | `page-service` | `/physio` (gold standard), `/physio/sports-physiotherapy`, `/physio/pregnancy-physiotherapy`, `/physio/postnatal-physiotherapy`, `/physio/pelvic-floor-physiotherapy`, `/physio/seniors-physiotherapy` |
| Condition | `page-condition` | the 10 `/conditions/*` pages |
| Studio / class | `page-studio` | `/pilates` and its 8 children (Clinical Pilates is the reference page) |
| General / info | `page-full` | `/book`, `/contact`, `/about`, and `/conditions` as an index |

Pages already on staging keep their current template until rebuilt; selecting the template in the page sidebar is enough.

## D. Physio page decisions

Built from `inc/scaffold-physio.php` in the brief's order: hero, what can we help you with, services (with the Physio / Clinical Pilates / Studio pathway), journey, why Solevo, facilities, practitioner and trust, fees and FAQs, locations, final Book Physio band.

- H1 is "Physiotherapy in Brookvale & Terrey Hills". SEO title "Physio Brookvale & Terrey Hills | Solevo Physio" (47), meta 150 characters. Slug unchanged.
- No shockwave, dry needling or compression. The "Adjunct therapies" row is also removed from the homepage services pattern for future use (the published homepage still has it until phase 5).
- No reviews or testimonials on the page (Ahpra advertising rules). The Google reviews section stays available for non-clinical pages only.
- Emma is the only person shown.
- Facts not yet confirmed are kept generic for visitors and flagged with `[solevo_todo]` for editors. See open items.

## E. Preview

https://crosslinkdigital.github.io/solevo-website/physio.html, rendered from a local WordPress running this exact theme, then exported with `tools/preview/export.py`. Booking buttons point at the placeholder until the Cliniko URL is in Settings.

## F. From GitHub to Hostinger staging, and future edits

1. Code changes land on a branch, then a pull request into `main`.
2. Merging to `main` runs `.github/workflows/deploy.yml`: PHP lint, then rsync of `theme/solevo` to Hostinger over SSH. Until the SSH secrets are added, upload `solevo-theme.zip` in Appearance > Themes instead.
3. In WordPress: **Appearance > Solevo setup**, tick **Rebuild /physio**, Run setup. The old content stays under Revisions. Other pages are untouched.
4. **Settings > Solevo**: confirm the Terrey Hills address, add the Cliniko URL (and per-location Cliniko links if wanted).
5. Check the theme version in Appearance > Themes matches `style.css` (1.2.0) so staging matches GitHub.

Future edits:

| Change | Where | Who |
|---|---|---|
| Copy, images, FAQs, prices, page CTAs | Page editor | Website manager / Thanh Hien |
| Hours, phone, addresses, booking links | Settings > Solevo | Website manager |
| Add a section to any page | Inserter > Patterns > Solevo components | Website manager |
| SEO title, meta, noindex | SEO box under the page | Thanh Hien |
| Styles, components, templates, new page types | GitHub pull request | Developer (Claude) |

Never edit theme files in wp-admin or override templates in the Site Editor: the next deploy would overwrite them, and GitHub must stay the source of truth.

## Open items (do not guess)

| Item | Where it shows |
|---|---|
| Terrey Hills Medical Centre street address | Settings > Solevo, location card, schema |
| Cliniko booking URL, and per-location deep links | Every Book Physio button |
| Physio prices ($160 / $110) and on-the-spot claiming (HICAPS) | Fees card |
| Appointment lengths (initial, follow-up) | Journey, FAQ |
| Workers compensation and CTP accepted? | Workplace injuries card, funding list |
| Who sees women's health and pelvic floor patients | Women's health cards and pages |
| Brookvale opening hours and phone | Location card, header Call, schema |
| Authentic clinic photos (treatment, rehab gym, reformer studio, Terrey Hills) | Facilities section, hero |
| Condition pages the brief names but the 30-page list does not have (neck, shoulder, hip and knee, tendon, post-surgical) | Question boxes link to the closest existing page for now |
| Emma's profile on the homepage lists Dry Needling | Homepage team section (phase 5) |
