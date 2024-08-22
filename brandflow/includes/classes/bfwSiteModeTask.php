<?php

if (!class_exists('bfwSiteModeTask')) {

    class bfwSiteModeTask {

        /* CONSTANTS */

        /* PRIVATE PROPERTIES */

        /* PUBLIC PROPERTIES */

        /**
         * Message de la tâche à accomplir
         * @var string
         */
        public $message;

        /**
         * Lien de la tâche à accomplir
         * @var string
         */
        public $link;

        /* CONSTRUCTORS */

        /**
         * Constructeur bfwSiteModeTask
         */
        public function __construct($message, $link) {
            $this->message = $message;
            $this->link = $link;
        }

        /* PRIVATE METHODS */

        /* PUBLIC METHODS */
    }
    
}