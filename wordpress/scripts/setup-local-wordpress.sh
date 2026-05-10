#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$ROOT_DIR"

if [[ ! -f .env ]]; then
  cp .env.example .env
fi

mkdir -p data/db site packages

set -a
source .env
set +a

docker compose up -d db wordpress

echo "Waiting for WordPress files and database..."
until docker compose run --rm wpcli core version >/dev/null 2>&1; do
  sleep 3
done

if ! docker compose run --rm wpcli core is-installed >/dev/null 2>&1; then
  docker compose run --rm wpcli core install \
    --url="${WORDPRESS_URL}" \
    --title="${WORDPRESS_TITLE}" \
    --admin_user="${WORDPRESS_ADMIN_USER}" \
    --admin_password="${WORDPRESS_ADMIN_PASSWORD}" \
    --admin_email="${WORDPRESS_ADMIN_EMAIL}" \
    --skip-email
fi

docker compose run --rm wpcli rewrite structure '/%postname%/' --hard
docker compose run --rm wpcli option update blog_public 0
docker compose run --rm wpcli theme activate pani-kwiat

if ! docker compose run --rm wpcli plugin is-installed carbon-fields >/dev/null 2>&1; then
  docker compose run --rm wpcli plugin install https://carbonfields.net/zip/latest/ --activate
else
  docker compose run --rm wpcli plugin activate carbon-fields || true
fi

if ! docker compose run --rm wpcli plugin is-installed polylang >/dev/null 2>&1; then
  docker compose run --rm wpcli plugin install polylang --activate
else
  docker compose run --rm wpcli plugin activate polylang
fi

"$ROOT_DIR/scripts/bootstrap-content.sh"

echo "WordPress is ready at ${WORDPRESS_URL}"
echo "Admin login: ${WORDPRESS_ADMIN_USER} / ${WORDPRESS_ADMIN_PASSWORD}"
