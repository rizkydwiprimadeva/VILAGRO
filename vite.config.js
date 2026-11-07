import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    server: {
        host: "127.0.0.1",
        port: 5173,
        strictPort: true,
    },
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/css/auth.css",
                "resources/css/map.css",
                "resources/js/map.js",
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
