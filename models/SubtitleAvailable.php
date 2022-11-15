<?php
    class SubtitleAvailable
    {
        private $idLanguage;
        private $idSerie;
        private $nameLanguage;

        /**
         * @param $idLanguage
         * @param $idSerie
         */
        public function __construct($idLanguageSubtitleAvailable, $idSerieSubtitleAvailable, $nameLanguageSubtitleAvailable)
        {
            $this->idLanguage = $idLanguageSubtitleAvailable;
            $this->idSerie = $idSerieSubtitleAvailable;
            $this->nameLanguage = $nameLanguageSubtitleAvailable;
        }

        /**
         * @return mixed
         */
        public function getIdLanguage()
        {
            return $this->idLanguage;
        }

        /**
         * @param mixed $idLanguage
         */
        public function setIdLanguage($idLanguage)
        {
            $this->idLanguage = $idLanguage;
        }

        /**
         * @return mixed
         */
        public function getIdSerie()
        {
            return $this->idSerie;
        }

        /**
         * @param mixed $idSerie
         */
        public function setIdSerie($idSerie)
        {
            $this->idSerie = $idSerie;
        }

        /**
         * @return mixed
         */
        public function getNameLanguage()
        {
            return $this->nameLanguage;
        }

        /**
         * @param mixed $nameLanguage
         */
        public function setNameLanguage($nameLanguage)
        {
            $this->nameLanguage = $nameLanguage;
        }
    }
?>