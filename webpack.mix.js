let mix = require("laravel-mix");
mix.setPublicPath("assets");
mix.setResourceRoot("../../wp-content/plugins/event-management-system/assets");
mix.js("src/main.js", "assets/admin/admin.js").vue({ version: 3 }).sourceMaps(false);
