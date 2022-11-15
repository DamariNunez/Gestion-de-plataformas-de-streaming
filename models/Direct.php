<?php
    class Direct
    {
        private $idDirector;
        private $idSerie;
        private $nameDirector;
        private $lastNameDirector;

        /**
         * @param $idDirector
         * @param $idSerie
         */
        public function __construct($idDirectorDirect, $idSerieDirect, $nameDirectorDirect, $lastNameDirectorDirect)
        {
            $this->idDirector = $idDirectorDirect;
            $this->idSerie = $idSerieDirect;
            $this->nameDirector = $nameDirectorDirect;
            $this->lastNameDirector = $lastNameDirectorDirect;
        }

        /**
         * @return mixed
         */
        public function getIdDirector()
        {
            return $this->idDirector;
        }

        /**
         * @param mixed $idDirector
         */
        public function setIdDirector($idDirector)
        {
            $this->idDirector = $idDirector;
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
        public function getNameDirector()
        {
            return $this->nameDirector;
        }

        /**
         * @param mixed $nameDirector
         */
        public function setNameDirector($nameDirector)
        {
            $this->nameDirector = $nameDirector;
        }

        /**
         * @return mixed
         */
        public function getLastNameDirector()
        {
            return $this->lastNameDirector;
        }

        /**
         * @param mixed $lastNameDirector
         */
        public function setLastNameDirector($lastNameDirector)
        {
            $this->lastNameDirector = $lastNameDirector;
        }
    }
?>