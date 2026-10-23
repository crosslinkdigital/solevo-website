# Preview build

The gh-pages branch is a static, view-only copy of a few pages, rendered from a local WordPress running this theme.

1. Run WordPress locally with this theme (any local WordPress; SQLite works), activate Solevo, run `wp solevo setup`.
2. Publish the pages to show: `wp solevo publish physio pilates ...`
3. Serve it (for example `php -S localhost:8088` in the WordPress folder).
4. Export: `python3 tools/preview/export.py --base http://localhost:8088 --wp /path/to/wordpress --out /tmp/preview "" physio pilates conditions pilates/mums-and-bubs conditions/sciatica`
5. Commit the contents of `/tmp/preview` to the `gh-pages` branch.

Pages not exported link to `#not-in-preview`. Every page gets `noindex` and a "Preview build" badge.
