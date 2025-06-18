import { defineConfig } from "vite"
import tailwindcss from "@tailwindcss/vite"
import laravel from "laravel-vite-plugin"
import react from "@vitejs/plugin-react"
import path from "path"
import { VitePWA } from "vite-plugin-pwa"

const serverConfig = {
    port: 5173,
    hmr: {
        host: "localhost",
    },
}

const manifestIcons = [
    {
        src: "/pwa-64x64.png",
        sizes: "64x64",
        type: "image/png",
    },
    {
        src: "/pwa-192x192.png",
        sizes: "192x192",
        type: "image/png",
    },
    {
        src: "/pwa-512x512.png",
        sizes: "512x512",
        type: "image/png",
        purpose: "any",
    },
    {
        src: "/maskable-icon-512x512.png",
        sizes: "512x512",
        type: "image/png",
        purpose: "maskable",
    },
]

const publicIcons = [
    { src: "/favicon.ico" },
    { src: "/favicon.svg" },
    { src: "/apple-touch-icon-180x180.png" },
]

export default defineConfig({
    server: serverConfig,
    plugins: [
        tailwindcss(),
        react(),
        // laravel plugin
        laravel({
            input: [
                "resources/js/app.jsx",
                "resources/js/main.js",
                "resources/js/Contabilidad/viatico.js",
                "resources/css/app.css",
            ],
            refresh: [
                {
                    paths: [
                        "app/**/*.php",
                        "resources/**/*.js",
                        "resources/**/*.jsx",
                        "resources/**/*.css",
                        "resources/views/**/*.blade.php",
                    ],
                    config: { delay: 100 },
                },
            ],
        }),
        // PWA PLUGIN
        VitePWA({
            buildBase: "/build/",

            // Define the scope and the base so that the PWA can run from the
            // root of the domain, even though the files live in /build.
            // This requires the service worker to be served with
            // a header `Service-Worker-Allowed: /` to authorise it.
            // @see server.php
            scope: "/",
            base: "/",
            registerType: "autoUpdate",
            devOptions: {
                enabled: true,
                type: "module",
            },
            injectRegister: "auto",
            includeAssets: [],
            workbox: {
                globPatterns: [
                    "**/*.{js,css,html,ico,jpg,png,svg,woff,woff2,ttf,eot}",
                ],

                navigateFallback: null,
                navigateFallbackDenylist: [],
                additionalManifestEntries: [
                    // Cache the icons defined above for the manifest
                    ...manifestIcons.map((i) => {
                        return { url: i.src, revision: `${Date.now()}` }
                    }),

                    // Cache the other offline icons defined above
                    ...publicIcons.map((i) => {
                        return { url: i.src, revision: `${Date.now()}` }
                    }),
                ],

                maximumFileSizeToCacheInBytes: 3000000,
            },

            manifest: {
                // Metadata
                name: "Finanssoreal",
                short_name: "Finanssoreal",
                description: "Control Finanssoreal",
                theme_color: "#0A0A0B",
                background_color: "#0A0A0B",
                orientation: "portrait",
                display: "standalone",
                scope: "/",
                start_url: "/",
                id: "/",
                icons: [...manifestIcons],
            },
        }),
    ],
    // alias resolver
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "resources/js"),
            "!": path.resolve(__dirname, "resources/images"),
            "#": path.resolve(__dirname, "resources/css"),
        },
    },
})
