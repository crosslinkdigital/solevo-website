# Solevo website

WordPress block theme and site setup for **Solevo Physio & Studio**, Brookvale (solevo.com.au).
Built by CrossLink DGTL under the Solevo Website Build Addendum (30 pages, WordPress + GitHub + Bluehost).

- **Live today:** the homepage, a replica of the current solevo.com.au design (Cormorant Garamond + Jost, olive palette, wave dividers), fully editable in WordPress.
- **Set up, ready to fill:** the other 29 pages as drafts, each with URL, template, SEO title, meta description and a content scaffold.
- **Owner:** Solevo owns this repository, the WordPress admin and the Bluehost account (Addendum section 4).

```
solevo-website/
├── theme/solevo/            The WordPress theme (this is what gets deployed)
│   ├── theme.json           Colours, fonts, spacing (design tokens)
│   ├── style.css            Theme header + all front-end CSS
│   ├── functions.php        Bootstrap
│   ├── inc/
│   │   ├── pages.php        THE 30-PAGE SITE MAP: slugs, titles, metas, keywords
│   │   ├── setup.php        Appearance > Solevo setup, and the page scaffolds
│   │   ├── settings.php     Settings > Solevo (booking URLs, phone, hours, GTM)
│   │   ├── booking.php      #cliniko / #mindbody link rewriting + click tracking classes
│   │   ├── seo.php          SEO title, meta, noindex, sitemap (no plugin needed)
│   │   ├── shortcodes.php   Breadcrumbs, NAP, map, timetable, reviews, Instagram
│   │   ├── menus.php        Landing menu and Full site menu
│   │   └── ...
│   ├── patterns/            Homepage sections, reusable in any page (inserter > Solevo)
│   ├── templates/ parts/    Block templates: front page, Service, Condition, Full width
│   └── assets/              Self-hosted fonts, placeholder images, site.js
├── docs/
│   ├── FREELANCER-BRIEF.md  Start here if you are building out the pages
│   └── PAGES.md             The 30 pages at a glance
├── playground/blueprint.json  One-click WordPress Playground preview
└── .github/workflows/deploy.yml  Push to main = deploy to Bluehost staging
```

## 1. Run it (pick one)

**A. WordPress Playground, 5 minutes, nothing to install**
1. Open https://playground.wordpress.net and click the WordPress logo > **Log in** (admin / password).
2. **Appearance > Themes > Add New > Upload Theme**, choose `solevo-theme.zip`, Install, **Activate**.
3. **Appearance > Solevo setup > Run setup.** Visit the site.

Playground lives in your browser tab. It resets unless you use its Save option. Use it to preview, never as the site.
The one-click Playground link (`https://playground.wordpress.net/?blueprint-url=` + the raw URL of `playground/blueprint.json`) only works while the repo is public; with a private repo, use the zip upload above.

**B. Bluehost staging (the real build environment)**
1. In Bluehost, create a **staging** WordPress install (Websites > Staging, or a `staging.solevo.com.au` subdomain with WordPress).
2. In that install: **Settings > Reading > Discourage search engines** ON, and password-protect the folder (cPanel > Directory Privacy). Both stay on until launch day.
3. Upload `solevo-theme.zip` (Appearance > Themes > Upload) or deploy with GitHub Actions (section 4). Activate **Solevo**.
4. **Appearance > Solevo setup > Run setup.**
5. **Settings > Solevo:** add the Cliniko URL, Mindbody URL, phone and opening hours.
6. Recommended in `wp-config.php`: `define( 'DISALLOW_FILE_EDIT', true );` so nobody edits theme code from wp-admin (code changes go through GitHub).

**C. Local (developers)**
Any local WordPress (LocalWP, wp-env, DDEV). Symlink `theme/solevo` into `wp-content/themes/`, activate, then `wp solevo setup`.

## 2. How editing works (no code)

| What | Where |
|---|---|
| Page text, images, sections | Pages > edit. Images: select > **Replace**. The photos shipped with the theme are interim copies taken from the current site at screen resolution; swap in Steph's originals (flagged in the Media Library). |
| Add a section to any page | Block inserter > Patterns > **Solevo** (team, studio classes, pricing, booking, reviews, find us, ...). |
| Booking links | Link any button or text to `#cliniko` (physio) or `#mindbody` (classes). The real URL comes from Settings > Solevo, and the click is tracked. Also `#phone`, `#email`, `#booknow`. |
| Address, phone, email, hours, suburbs | **Settings > Solevo**. Shown everywhere via `[solevo_contact]`, `[solevo_hours]`, `[solevo_suburbs]`, so NAP is always identical. |
| SEO title, meta description, noindex | **Search appearance (SEO)** box under each page. Character counters included. |
| Page template | Page sidebar > Template: **Service page**, **Condition page**, **Full width (no title)**. |
| Menu | Appearance > Solevo setup > switch between **Landing menu** (homepage anchors, live now) and **Full site menu** (Physio, Pilates, Conditions, About, Contact) once pages are published. Edit either in Appearance > Editor > Navigation. |

Shortcodes (use a Shortcode block): `[solevo_breadcrumbs]` `[solevo_contact show="name,address,phone,email"]` `[solevo_hours]` `[solevo_suburbs]` `[solevo_map]` `[solevo_timetable]` `[solevo_child_pages]` `[solevo_reviews]` `[solevo_instagram]` `[solevo_copyright]`.

## 3. Integrations

| Integration | Status | To switch on | Cost |
|---|---|---|---|
| Cliniko (physio booking) | Every physio button points to `#cliniko` | Paste the booking URL in Settings > Solevo | Existing subscription |
| Mindbody (class booking + timetable) | Buttons point to `#mindbody`; timetable slot on Home, /book, campaign pages | Booking URL + paste the Branded Web Tools widget code in Settings > Solevo | Existing subscription |
| Google reviews | Section built, hidden from visitors until connected | Install **Widgets for Google Reviews** (Trustindex), connect the Google Business Profile | Free (10 reviews, manual refresh); paid from about US$65/yr for auto sync |
| Instagram feed | Section and Follow button live; feed slot ready | Switch @solevo.studio to a Business/Creator account linked to a Facebook page, install **Smash Balloon Social Photo Feed**, connect | Free; Pro from US$49/yr |
| Google Tag Manager / GA4 | Container slot ready; dataLayer events wired | Add `GTM-XXXXXXX` in Settings > Solevo | Free |

dataLayer events pushed by `assets/js/site.js`: `click_book_physio`, `click_book_class`, `click_book`, `click_call`, `click_email`, `form_submit`. Booking buttons also carry the classes `solevo-book-physio` / `solevo-book-class` for GTM click triggers. Logged-in editors are not tracked.

## 4. Code workflow (GitHub > Bluehost)

- Branch from `main`, open a pull request, merge. Merging to `main` deploys `theme/solevo` to **staging** (`.github/workflows/deploy.yml`).
- Production: Actions > **Deploy theme** > Run workflow > `production`.
- Secrets needed: `DEPLOY_HOST`, `DEPLOY_PORT`, `DEPLOY_USER`, `DEPLOY_SSH_KEY`, `DEPLOY_STAGING_PATH`, and at launch `DEPLOY_LIVE_PATH` (enable SSH on the host first). Staging runs on CrossLink's Hostinger account; the live site moves to Solevo's Bluehost at launch.
- Content lives in the WordPress database, not in Git. Back it up with Bluehost backups or a plugin (UpdraftPlus) before launch.
- Template changes belong in code. If someone edits a template in the Site Editor, WordPress stores an override in the database; use **Reset** in the Site Editor to go back to the theme file.

## 5. Built-in technical SEO

- Permalinks `/%postname%`, no trailing slash; `/physio/` 301s to `/physio`.
- One H1 per page (inside the hero), self-referencing canonical (WordPress core).
- `/sitemap.xml` 301 to the core sitemap; noindex pages and user/taxonomy sitemaps excluded.
- Breadcrumbs with BreadcrumbList schema on every page except home.
- Old one-page anchors (`/#physio`, `/#pricing`, `/#book`...) forward to the new pages once those pages are published. This runs in the browser, because the `#` part never reaches the server.
- Fonts self-hosted and preloaded; images converted to WebP on upload, lazy-loaded below the fold with width/height set (no layout shift).
- Steps aside automatically if Yoast, Rank Math or AIOSEO is installed later.

## 6. Launch checklist

- [ ] All 30 pages reviewed and published (clinician review line filled on health pages)
- [ ] Real photos replace every placeholder (Media Library shows which)
- [ ] Settings > Solevo complete (booking URLs, phone, hours, GTM ID)
- [ ] Switch to the Full site menu; footer links updated to the new pages
- [ ] Crawl staging (Screaming Frog): no broken links, no missing titles, no redirect chains
- [ ] PageSpeed Insights mobile: LCP ≤ 2.5s, INP ≤ 200ms, CLS ≤ 0.1
- [ ] Point solevo.com.au at the WordPress install (Steph holds the domain login); force HTTPS and one host (www or non-www)
- [ ] Turn off "Discourage search engines" and the folder password
- [ ] Submit `/sitemap.xml` in Search Console; link GA4 and Google Business Profile
