#!/usr/bin/env bash
# Fails if the theme uses a font size outside the type scale (style.css :root --fs-*).
# Allowed: var(--fs-*), em values (icons sized to their text), inherit.
set -euo pipefail
cd "$(dirname "$0")/../../theme/solevo"
bad=$(grep -nE 'font-size\s*:' style.css \
	| grep -vE 'font-size\s*:\s*(var\(--fs-[a-z0-9]+\)|[0-9.]+em|inherit)\s*(!important)?\s*[;}]' \
	| grep -v -- '--fs-' || true)
json=$(python3 - <<'PY'
import json, re
t = json.load(open("theme.json"))
out = [f"preset {p['slug']}: {p['size']}" for p in t["settings"]["typography"]["fontSizes"] if not re.fullmatch(r"var\(--fs-[a-z0-9]+\)", p["size"])]
def walk(o, path):
    if isinstance(o, dict):
        for k, v in o.items():
            if k == "fontSize" and isinstance(v, str) and not re.fullmatch(r"var\(--(fs-[a-z0-9]+|wp--preset--font-size--[a-z-]+)\)", v):
                out.append(f"{path}: {v}")
            walk(v, path + "/" + k)
    elif isinstance(o, list):
        for i in o: walk(i, path)
walk(t.get("styles", {}), "styles")
print("\n".join(out))
PY
)
if [ -n "$bad$json" ]; then
	echo "Font sizes outside the type scale. Use var(--fs-h1|h2|h3|card|lead|body|small|caption|button|label):"
	[ -n "$bad" ] && echo "style.css:" && echo "$bad"
	[ -n "$json" ] && echo "theme.json:" && echo "$json"
	exit 1
fi
echo "Type scale check passed."
