# Pani Kwiat WordPress Theme

Custom theme prepared from the current Astro version.

## Dependencies

- WordPress 6.4+
- PHP 8.1+
- Carbon Fields
- Polylang, if you want `/en/` and `/de/` language versions in the admin

## Files

- `front-page.php`: homepage template
- `template-pricing.php`: pricing page template
- `inc/site-copy.json`: default text content copied from the Astro project
- `inc/pricing-copy.json`: default pricing page content copied from the Astro project
- `assets/site/`: copied images and compiled CSS from the Astro build

## Setup

1. Copy `wordpress/wp-content/themes/pani-kwiat` to your WordPress installation under `wp-content/themes/`.
2. Activate the theme.
3. Install and activate `Carbon Fields`.
4. Optional but recommended: install and configure `Polylang`.
5. Create a page for the homepage and set it as the static front page in `Settings -> Reading`.
6. Create a page for pricing and assign the `Pricing Page` template.
7. Fill or adjust the generated Carbon Fields in the page editor and in `Pani Kwiat` options.
8. Create and assign a menu to the `Primary Navigation` location.

## Notes

- The theme starts with fallback defaults from the current Astro content, so it renders even before Carbon Fields values are filled in.
- Contact form output is shortcode-based in theme options. If the shortcode is empty, the theme falls back to a simple `formsubmit.co` form.
- The navigation is editable from WordPress menus. Menu descriptions are used as the smaller subtitle line under each menu label.
