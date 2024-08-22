<?php

if (!class_exists('bfwSiteSettings')) {

    class bfwSiteSettings {

        /* CONSTANTS */

        const TAG_MANAGER = 'tag_manager';

        const MAPS_API_TOKEN = 'maps_api_token';

        /* PRIVATE PROPERTIES */

        private $GoogleServices;

        /* PUBLIC PROPERTIES */

        /* CONSTRUCTORS */

        /**
         * Constructeur bfwSiteMode
         */
        public function __construct() {

            $this->GoogleServices = get_option('bfw_options_google_services');

        }

        /* PRIVATE METHODS */

        /* PUBLIC METHODS */

        public function getGoogleServicesTagManager() {
            return  isset($this->GoogleServices) && isset($this->GoogleServices[$this::TAG_MANAGER]) ? $this->GoogleServices[$this::TAG_MANAGER] : '';
        }

        public function isGoogleServicesTagManagerOk() {

            return !empty($this->getGoogleServicesTagManager());

        }

        public function getGoogleServicesMapsApiToken() {
            return  isset($this->GoogleServices) && isset($this->GoogleServices[$this::MAPS_API_TOKEN]) ? $this->GoogleServices[$this::MAPS_API_TOKEN] : '';
        }

        public function isGoogleServicesMapsApiTokenOk() {

            return !empty($this->getGoogleServicesMapsApiToken());

        }

        public function isSeoMetasOk() {

            return false; //TODO: Mettre en place la vérification des métas dans le site

        }
    }

}