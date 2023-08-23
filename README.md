# Formidable Coding Challenge

## Plugin

1. Run `cd plugin && npm install`
2. Run `npm run plugin-zip`
3. Upload `dist/coding-challenge.zip` as WordPress plugin
4. Use `[challenge_table]` shortcode to display table on frontend
5. Use `wp fcs cache_flush` via WP CLI to refresh API data

**Notes:**

Regarding the display of the list table in the admin area, I was unsure exactly how it was intended to be displayed but I figured using the methods from the Formidable plugin directly is what was intended.

## Frontend

1. Run `cd frontend && npm install`
2. Run `npm run build`
3. Open **index.html** in `dist`
