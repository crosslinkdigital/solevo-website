# Freelancer brief: Solevo build-out

**Client:** Solevo Physio & Studio, 4/42-46 Mitchell Rd, Brookvale NSW 2100 (shares the space with The Foot Company podiatry)
**Account lead:** Hayo, CrossLink DGTL
**Target launch:** within 2.5 weeks of approval (Addendum). Fixed scope: **30 pages**, listed in `PAGES.md`.

## What is already done

- Theme, design system, header, footer, booking band, 404, breadcrumbs, SEO fields, sitemap, tracking hooks.
- Homepage rebuilt from the old one-page site with all current copy, team, services, classes and pricing.
- All 30 pages created with the agreed URL, parent, template, SEO title, meta description and excerpt.
- Each draft page has a **scaffold** that follows the agreed page template. Anything in `[square brackets]` is yours to write.

## Your job, per page

1. Open the draft (Pages, or Appearance > Solevo setup > Edit).
2. Replace every `[bracketed]` placeholder with final copy. Keep the section order; delete a section only if it has nothing true to say.
3. Keep **one H1** (already in the hero). It contains the primary keyword and Brookvale. Do not add another.
4. Check the SEO box under the page: title ≤ 60 characters, meta 140 to 155. They are pre-filled; adjust only if the copy changes the angle.
5. Booking buttons: physio pages use `#cliniko`, class pages use `#mindbody`. Never paste raw booking URLs into buttons.
6. Images: select the placeholder > **Replace** > upload the real photo with descriptive alt text. Upload JPG or PNG; WordPress serves WebP.
7. Health pages (all `/conditions/*` and physio services): fill the **Reviewed by** line with the clinician's name, qualification and review date, and keep the red-flags block on condition pages.
8. Update the **Excerpt** (page sidebar) if needed. It is the one-line text on the cards on `/physio`, `/pilates` and `/conditions`.
9. Preview on mobile, then **Publish**.

Recommended order (KPI pages first): `/pilates/mums-and-bubs`, `/pilates/seniors`, `/physio`, `/pilates`, `/book`, `/contact`, `/about`, then the remaining Pilates and Physio services, then conditions.
When Physio, Pilates and Conditions are published: Appearance > Solevo setup > **Switch to Full site menu**.

## Rules (from the SEO foundations doc)

- **Slugs never change.** If one must, add a 301. Never create pages outside the 30 without sign-off from Hayo.
- One page = one search intent. If two pages would answer the same query, flag it rather than writing both.
- No suburb landing pages. Suburbs live on `/contact` (Settings > Solevo > Suburbs served).
- Link down from category pages to children, and back up to the parent with the parent's keyword as anchor text (the scaffolds already do this).
- Link to The Foot Company once per relevant page, in body text, with a descriptive anchor. Foot, heel, orthotic and gait-for-footwear questions go to TFC.
- Only real Google reviews. No invented testimonials.
- No outcome promises in health copy. Name the reviewing clinician.
- Content edits happen in WordPress. Code and template changes go through GitHub pull requests, never the wp-admin file editor or Site Editor template overrides.

## Access you will get

- WordPress admin on Bluehost **staging** (Editor role is enough for content; Administrator if you also connect plugins).
- GitHub repository access for code changes. Merging to `main` deploys to staging automatically.

## Open items to confirm with the client (do not guess)

| Item | Where it shows |
|---|---|
| Cliniko and Mindbody booking URLs, Mindbody timetable widget code | Settings > Solevo, every booking button |
| Phone number and opening hours | Header Call button (hidden until set), footer, Contact |
| Physio prices ($160 initial, $110 follow-up) and health fund rebates | Physio service pages, Price section |
| Seniors Pilates price and format; over-50s class timetable | `/pilates/seniors`, `/pilates/over-50s-fitness` |
| What runs under Mums and Bubs; can babies attend | `/pilates/mums-and-bubs` FAQ and steps |
| Which clinician sees pregnancy, postnatal and pelvic floor patients | Practitioner block on those pages |
| Parking and access details; suburbs served list | `/contact` |
| **Shin splints ownership.** The Foot Company keyword plan makes "shin splints" (18,100/mo) TFC's top new condition page, and Solevo also has `/conditions/shin-splints`. Two sites chasing one keyword will compete. Hayo to decide which site owns it before either page is written. | `/conditions/shin-splints` |
