<?php

if (!class_exists('bfwPluginWpScss')) {

    class bfwPluginWpScss {

        /**
         * Change les options du plugin WP-SCSS en mode dev
         */
        public function setDevConfig() {

            $wp_scss_config = [
                "base_compiling_folder" => get_theme_file_path(),
                "scss_dir" => "/assets/scss/",
                "css_dir" => "/assets/css/",
                "compiling_options" => "expanded",
                "sourcemap_options" => "SOURCE_MAP_NONE",
                "errors" => "show",
                "enqueue" => "1",
                "always_recompile" => "1",
            ];

            update_site_option('wpscss_options', $wp_scss_config);
        }

        function setPreprodConfig() {
            $wp_scss_config = [
                "base_compiling_folder" => get_theme_file_path(),
                "scss_dir" => "/assets/scss/",
                "css_dir" => "/assets/css/",
                "compiling_options" => "expanded",
                "sourcemap_options" => "SOURCE_MAP_INLINE",
                "errors" => "show",
                "enqueue" => "1",
                "always_recompile" => "1",
            ];

            update_site_option('wpscss_options', $wp_scss_config);
        }

        function setProdConfig() {
            $wp_scss_config = [
                "base_compiling_folder" => get_theme_file_path(),
                "scss_dir" => "/assets/scss/",
                "css_dir" => "/assets/css/",
                "compiling_options" => "compressed",
                "sourcemap_options" => "SOURCE_MAP_FILE",
                "errors" => "hide",
                "enqueue" => "1",
                "always_recompile" => "1",
            ];

            update_site_option('wpscss_options', $wp_scss_config);
        }
    }

}