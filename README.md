# Minimalio Child

The official child theme for [Minimalio](https://minimalio.org). Use it for your own changes: Minimalio updates never overwrite what's in the child theme.

**[Download the latest version](https://github.com/minimalio-theme/Minimalio-Child-Theme/releases/latest/download/minimalio-child.zip)**, then in WordPress go to **Appearance → Themes → Add New Theme → Upload Theme** and activate **Minimalio Child**. Minimalio itself must be installed too.

> Activate the child theme **before** you change Minimalio's settings in the Customizer. WordPress stores design settings per theme, so settings made while Minimalio itself was active don't carry over.

## Where to put your changes

| What | File |
|---|---|
| CSS | `assets/child-styles.css` (loads after Minimalio's CSS, so it takes priority) |
| JavaScript | `assets/child-script.js` (plain JavaScript recommended; to use jQuery, add `'jquery'` to the script's dependencies in `functions.php`) |
| PHP | `functions.php`, below "Custom code" |
| A changed Minimalio template | copy the file from `minimalio/` to the same path in this theme and edit the copy |

CSS and JavaScript files are versioned by their modification time, so changes show up immediately, even behind caches.

## No automatic updates

On purpose: the child theme holds each website's own code, so an update would overwrite it. Releases are only for new installs.

## Releasing a new version

1. Change `Version:` in `style.css`, for example to `1.1.1`.
2. Commit and push.
3. Create and push a tag with the same number:
   ```
   git tag v1.1.1
   git push origin v1.1.1
   ```

The GitHub Action in `.github/workflows/release.yml` checks the version, builds `minimalio-child.zip` (with a `minimalio-child` folder inside) and publishes it as a release.

## Changes in 1.1.0

- Licence changed to GPL-2.0-or-later (required for a child of a GPL theme).
- CSS and JavaScript versioned by file modification time, so edits aren't hidden by caches.
- No longer loads Minimalio's `style.css` (it contains only the theme header). The child `style.css` and `child-styles.css` are loaded only when they contain CSS.
- `child-script.js` is plain JavaScript, loaded deferred in the footer, and no longer depends on jQuery.
- SVG uploads removed (SVG files can contain scripts).
- Functions renamed with a `minimalio_child_` prefix to avoid clashes.

## License

GPL-2.0-or-later
