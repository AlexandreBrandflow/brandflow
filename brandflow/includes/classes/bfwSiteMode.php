<?php

if (!class_exists('bfwSiteMode')) {

    class bfwSiteMode {

        /* CONSTANTS */

        /**
         * Clé de l'option de site Wordpress pour le mode du thème bfw
         */
        const SITE_MODE_OPTION_KEY = "bfw_SITE_MODE";

        /**
         * Valeur possible du mode du thème bfw
         */
        const SITE_MODE_DEV = "DEV";

        /**
         * Valeur possible du mode du thème bfw
         */
        const SITE_MODE_PREPROD = "PREPROD";

        /**
         * Valeur possible du mode du thème bfw
         */
        const SITE_MODE_PROD = "PROD";

        /* PRIVATE PROPERTIES */

        /**
         * Instance de la classe bfwPluginWpScss
         * @var bfwPluginWpScss
         */
        private $bfwPluginScss;

        /* PUBLIC PROPERTIES */

        /* CONSTRUCTORS */

        /**
         * Constructeur bfwSiteMode
         */
        public function __construct()
        {
            $this->bfwPluginScss = new bfwPluginWpScss();
        }

        /* PRIVATE METHODS */

        /**
         * Récupère le mode actuel du site
         * @return false|mixed
         */
        private  function GetSiteMode()
        {
            return get_site_option(self::SITE_MODE_OPTION_KEY);
        }

        /**
         * Modifie le mode du site par celui passé en paramètre
         * @param string $mode
         */
        private function SetSiteMode($mode = self::SITE_MODE_DEV)
        {
            update_site_option(self::SITE_MODE_OPTION_KEY, $mode);
        }

        /* PUBLIC METHODS */

        /**
         * Détermine si le mode actuel du site est DEV
         * @return bool
         */
        public function isModeDev(): bool
        {
            return $this->GetSiteMode() == self::SITE_MODE_DEV;
        }

        /**
         * Détermine si le mode actuel du site est PREPROD
         * @return bool
         */
        public function isModePreprod(): bool
        {
            return $this->GetSiteMode() == self::SITE_MODE_PREPROD;
        }

        /**
         * Détermine si le mode actuel du site est PROD
         * @return bool
         */
        public function isModeProd(): bool
        {
            return $this->GetSiteMode() == self::SITE_MODE_PROD;
        }

        /**
         * Passes le site en mode DEV
         */
        public function setSiteModeDev()
        {
            $this->SetSiteMode(self::SITE_MODE_DEV);
            $this->bfwPluginScss->setDevConfig();
        }

        /**
         * Passes le site en mode PREPROD
         */
        public function setSiteModePreprod()
        {
            $this->SetSiteMode(self::SITE_MODE_PREPROD);
            $this->bfwPluginScss->setPreprodConfig();
        }

        /**
         * Passes le site en mode PROD
         */
        public function setSiteModeProd()
        {
            $this->SetSiteMode(self::SITE_MODE_PREPROD);
            $this->bfwPluginScss->setProdConfig();
        }

        /**
         * Récupères le mode suivant en fonction du mode courant du site
         * DEV => PREPROD
         * PREPROD => PROD
         * @return string
         */
        public function getNextMode()
        {
            $currentMode = self::SITE_MODE_DEV;

            if ($this->isModeDev()) $currentMode = self::SITE_MODE_PREPROD;
            if ($this->isModePreprod()) $currentMode = self::SITE_MODE_PROD;
            if ($this->isModeProd()) $currentMode = self::SITE_MODE_PROD;

            return $currentMode;
        }

        /**
         * Récupère le mode actuel du site au format texte
         * @return string
         */
        public function getSiteModeText($mode = ''): string
        {
            $textMode = '';

            if (empty($mode))
            {
                if ($this->isModeDev())
                    $textMode = 'développement';
                elseif ($this->isModePreprod())
                    $textMode = 'pré-production';
                elseif ($this->isModePreprod())
                    $textMode = 'production';
            }
            else
            {
                if ($mode == self::SITE_MODE_DEV)
                    $textMode = 'développement';
                elseif ($mode == self::SITE_MODE_PREPROD)
                    $textMode = 'pré-production';
                elseif ($mode == self::SITE_MODE_PROD)
                    $textMode = 'production';
            }

            return $textMode;
        }

        /**
         * Détermine si le site peut être passé dans le mode en paramètre
         * @param string $mode
         * @param array $tasks
         * @return bool
         */
        public function isModeOk($mode = self::SITE_MODE_DEV, &$tasks = []): bool
        {
            $isOk = true;

            //bloque le passage en préprod que depuis un site en mode dev
            if ($mode == self::SITE_MODE_PREPROD && !$this->isModeDev())
                $isOk = false;

            //bloque le passage en prod que depuis un site en preprod
            if ($mode == self::SITE_MODE_PROD && !$this->isModePreprod())
                $isOk = false;

            //vérification de l'accessibilité des moteurs de recherche au site
            $blog_public = in_array($mode, [ self::SITE_MODE_DEV, self::SITE_MODE_PREPROD ]) ? '1' : '0';
            if (get_site_option('blog_public') == $blog_public) {
                $isOk = false;
                array_push($tasks, new bfwSiteModeTask(
                    "Rendez le site inaccessible aux moteurs de recherche pour éviter l'indexation du site",
                    admin_url('options-reading.php')
                ));
            }

            //TODO: AJouter les blocages nécessaires au passage au mode suivant

            $pages = get_posts([
                'numberposts' => '-1',
                'post_type' => 'page',
            ]);

            foreach ($pages as $page) {

                $page_title = get_post_meta($page->ID, '_yoast_wpseo_metadesc', true) ;
                $page_description = get_post_meta($page->ID, '_yoast_wpseo_title', true);

                if (empty($page_title) || empty($page_description)) {
                    array_push($tasks, new bfwSiteModeTask(
                        "La meta title ou description de la page  " . $page->post_title . '('.$page->ID.') n\'est pas renseignée.',
                        get_edit_post_link($page->ID)
                    ));
                }

            }

            return $isOk;
        }
    }

}