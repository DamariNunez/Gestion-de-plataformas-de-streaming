<?php
    class Participate
    {
        private $idSerie;
        private $idActor;
        private $nameActor;
        private $lastNameActor;

        /**
         * @param $idSerie
         * @param $idActor
         */
        public function __construct($idSerieParticipate, $idActorParticipate, $nameActorParticipate, $lastNameActorParticipate)
        {
            $this->idSerie = $idSerieParticipate;
            $this->idActor = $idActorParticipate;
            $this->nameActor = $nameActorParticipate;
            $this->lastNameActor = $lastNameActorParticipate;
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
        public function getIdActor()
        {
            return $this->idActor;
        }

        /**
         * @param mixed $idActor
         */
        public function setIdActor($idActor)
        {
            $this->idActor = $idActor;
        }

        /**
         * @return mixed
         */
        public function getNameActor()
        {
            return $this->nameActor;
        }

        /**
         * @param mixed $nameActor
         */
        public function setNameActor($nameActor)
        {
            $this->nameActor = $nameActor;
        }

        /**
         * @return mixed
         */
        public function getLastNameActor()
        {
            return $this->lastNameActor;
        }

        /**
         * @param mixed $lastNameActor
         */
        public function setLastNameActor($lastNameActor)
        {
            $this->lastNameActor = $lastNameActor;
        }
    }
?>