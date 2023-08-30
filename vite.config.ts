import legacy from "@vitejs/plugin-legacy";
import vue from "@vitejs/plugin-vue";
import laravel from "laravel-vite-plugin";
import path from "path";
import { defineConfig } from "vite";
import checker from "vite-plugin-checker";
import eslint from "vite-plugin-eslint";
import stylelint from "vite-plugin-stylelint";

export default defineConfig({
    build: {
        rollupOptions: {
            output: {
                entryFileNames: `assets/${
                    process.env.NODE_ENV === "local" ? "[name]-" : ""
                }[hash].js`,
                chunkFileNames: `assets/${
                    process.env.NODE_ENV === "local" ? "[name]-" : ""
                }[hash].js`,
                assetFileNames: `assets/${
                    process.env.NODE_ENV === "local" ? "[name]-" : ""
                }[hash].[ext]`,
            },
        },
        chunkSizeWarningLimit: 700,
        emptyOutDir: true,
        sourcemap: process.env.NODE_ENV === "local" ? "inline" : false,
    },
    css: {
        devSourcemap: process.env.NODE_ENV === "local" ? true : false,
        postcss: {
            map: {
                inline: true,
            },
            plugins: [
                require("postcss-discard-comments")({
                    removeAll: true,
                }),
            ],
        },
    },
    plugins: [
        checker({
            enableBuild: true,
            vueTsc: {
                root: ".",
                tsconfigPath: "tsconfig.json",
            },
            typescript: {
                root: ".",
                tsconfigPath: "tsconfig.json",
            },
            eslint: {
                lintCommand:
                    "eslint --fix --quiet -c .eslintrc.json \"./resources\"",
            },
            stylelint: {
                lintCommand:
                    "stylelint -q --config \"./.stylelintrc.json\" --fix \"**/resources/**/*.scss\"",
            },
        }),
        laravel({
            input: [
                "resources/sass/back.scss",
                "resources/ts/back.ts",
                "resources/sass/front.scss",
                "resources/ts/front.ts",
            ],
        }),
        stylelint({
            dev: false,
            build: true,
            cache: false,
            chokidar: true,
            quiet: false,
            include: ["**/resources/**/*.scss", "**/resources/**/*.css"],
            exclude: [
                "**/node_modules/**/*.scss",
                "**/node_modules/**/*.css",
                "**/vendor/**/*.scss",
                "**/vendor/**/*.css",
            ],
            lintOnStart: false,
            emitError: true,
            emitWarning: true,
            emitErrorAsWarning: false,
            emitWarningAsError: true,
        }),
        eslint({
            cache: false,
            extensions: ["js", "ts"],
            include: "**/*.ts",
            lintOnStart: false,
            emitWarning: true,
            emitError: true,
            failOnWarning: false,
            failOnError: false,
        }),
        vue({
            isProduction: process.env.NODE_ENV !== "development" ? true : false,
        }),
        legacy({
            targets: "last 3 version, not dead, >0.3%",
            renderLegacyChunks: false,
        }),
    ],
    resolve: {
        extensions: ["*", ".js", ".ts", ".vue"],
        alias: [
            {
                find: "vue",
                replacement: "vue/dist/vue.runtime.esm-bundler.js",
            },
            {
                find: "@",
                replacement: "/resources/assets",
            },
            {
                find: "~",
                replacement: path.resolve(__dirname, "./node_modules"),
            },
        ],
    },
});