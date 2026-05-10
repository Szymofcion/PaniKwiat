# Local WordPress Stack

This folder contains a local Docker-based WordPress environment for the `pani-kwiat` theme.

## What is included

- `docker-compose.yml`: local WordPress + MariaDB + WP-CLI
- `wp-content/themes/pani-kwiat`: custom theme migrated from the Astro project
- `scripts/setup-local-wordpress.sh`: full bootstrap for local WordPress
- `scripts/bootstrap-content.sh`: idempotent starter content import
- `scripts/import-first-blog-post.php`: imports the first blog post from `wpisy-blogowe/pierwszy wpis`

## First run

```bash
cd wordpress
./scripts/setup-local-wordpress.sh
```

After setup:

- site: `http://localhost:8080`
- admin: `http://localhost:8080/wp-admin`
- login: `admin`
- password: `admin12345`

## What the bootstrap does

- starts MariaDB and WordPress containers
- installs WordPress if needed
- activates the `pani-kwiat` theme
- installs and activates `Polylang`
- creates starter pages for PL / EN / DE
- assigns the pricing template to pricing pages
- creates starter menus for PL / EN / DE
- sets the Polish homepage as the static front page

## Editing plugin

The theme now uses `Carbon Fields`, which is free and installed automatically by `./scripts/setup-local-wordpress.sh`.

Structured editing works without any paid plugin.

## Notes

- Polylang currently resolves translated home pages to:
  - `/en/home-en/`
  - `/de/startseite/`
- The localized content and menus are already working on these routes.
- The bootstrap is safe to run multiple times.

## Import first blog post

After the stack is running, import the prepared first blog post with:

```bash
docker compose run --rm -v "$PWD/wpisy-blogowe:/blog-import:ro" wpcli eval-file /scripts/import-first-blog-post.php
```
