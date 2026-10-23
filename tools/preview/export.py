#!/usr/bin/env python3
"""
Static, view-only preview of the theme for the gh-pages branch.

Renders pages from a local WordPress running this theme (see tools/preview/README.md),
rewrites links to relative paths, copies the assets each page uses, adds noindex and a
"Preview build" badge. Pages that are not exported link to #not-in-preview.

  python3 tools/preview/export.py --base http://localhost:8088 --wp /path/to/wordpress \
      --out /tmp/preview "" physio pilates conditions pilates/mums-and-bubs conditions/sciatica
"""
import argparse
import os
import re
import shutil
import sys
import urllib.request

BADGE = (
    '<div class="solevo-preview-badge" style="position:fixed;left:12px;bottom:12px;z-index:9999;'
    'background:#2C2C2C;color:#FAF7F3;font:500 11px/1 Jost,system-ui,sans-serif;letter-spacing:.14em;'
    'text-transform:uppercase;padding:9px 12px;opacity:.85">Preview build &middot; not the live site</div>'
    '<style>@media(max-width:781px){.solevo-preview-badge{bottom:auto!important;top:84px;left:auto!important;right:8px}}</style>'
)


def page_file(path):
    return 'index.html' if path == '' else path + '.html'


def main():
    ap = argparse.ArgumentParser()
    ap.add_argument('--base', required=True)
    ap.add_argument('--wp', required=True, help='WordPress root on disk (for copying assets)')
    ap.add_argument('--out', required=True)
    ap.add_argument('pages', nargs='+')
    a = ap.parse_args()
    base = a.base.rstrip('/')
    pages = [p.strip('/') for p in a.pages]
    assets = set()

    for path in pages:
        html = urllib.request.urlopen(f'{base}/{path}').read().decode('utf-8')
        depth = path.count('/') if path else 0
        rel = '../' * depth

        def repl(m):
            url = m.group(0)
            target = url[len(base):] or '/'
            frag = ''
            if '#' in target:
                target, frag = target.split('#', 1)
                frag = '#' + frag
            clean = target.split('?')[0]
            if clean.startswith('/wp-content/') or clean.startswith('/wp-includes/'):
                assets.add(clean.lstrip('/'))
                return rel + clean.lstrip('/')
            p = clean.strip('/')
            if p in pages:
                return rel + page_file(p) + frag
            return '#not-in-preview' if p else rel + 'index.html' + frag

        html = re.sub(re.escape(base) + r'[^"\'\s<>),]*', repl, html)
        esc = base.replace('/', '\\/')  # JSON-escaped URLs in inline scripts (import map, settings)
        html = html.replace(esc + '\\/', rel.replace('/', '\\/')).replace(esc, rel.replace('/', '\\/') or '.')
        html = html.replace('<head>', '<head>\n<meta name="robots" content="noindex, nofollow">', 1)
        html = html.replace('</body>', BADGE + '</body>', 1)
        dest = os.path.join(a.out, page_file(path))
        os.makedirs(os.path.dirname(dest), exist_ok=True)
        with open(dest, 'w', encoding='utf-8') as f:
            f.write(html)
        print('page ', '/' + path, '->', page_file(path))

    # Assets, plus fonts referenced from the theme stylesheet.
    assets.update(f'wp-content/themes/solevo/assets/fonts/{f}' for f in os.listdir(os.path.join(a.wp, 'wp-content/themes/solevo/assets/fonts')) if f.endswith('.woff'))
    for asset in sorted(assets):
        src = os.path.join(a.wp, asset)
        if not os.path.isfile(src):
            print('skip ', asset, '(not a file)', file=sys.stderr)
            continue
        dest = os.path.join(a.out, asset)
        os.makedirs(os.path.dirname(dest), exist_ok=True)
        shutil.copyfile(src, dest)
    with open(os.path.join(a.out, 'robots.txt'), 'w') as f:
        f.write('User-agent: *\nDisallow: /\n')
    open(os.path.join(a.out, '.nojekyll'), 'w').close()
    print('assets', len(assets))


if __name__ == '__main__':
    main()
