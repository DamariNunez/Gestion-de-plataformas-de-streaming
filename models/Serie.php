<?php
    class Serie
    {
        private $id;
	    private $title;
	    private $idPlatform;
        private $namePlatform;

        /**
         * @param $id
         * @param $title
         * @param $idPlatform
         */
        public function __construct($idSerie, $titleSerie, $idPlatformSerie, $namePlatformSerie)
        {
            $this->id = $idSerie;
            $this->title = $titleSerie;
            $this->idPlatform = $idPlatformSerie;
            $this->namePlatform = $namePlatformSerie;
        }

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getTitle()
        {
            return $this->title;
        }

        /**
         * @param mixed $title
         */
        public function setTitle($title)
        {
            $this->title = $title;
        }

        /**
         * @return mixed
         */
        public function getIdPlatform()
        {
            return $this->idPlatform;
        }

        /**
         * @param mixed $idPlatform
         */
        public function setIdPlatform($idPlatform)
        {
            $this->idPlatform = $idPlatform;
        }

        /**
         * @return mixed
         */
        public function getNamePlatform()
        {
            return $this->namePlatform;
        }

        /**
         * @param mixed $namePlatform
         */
        public function setNamePlatform($namePlatform)
        {
            $this->namePlatform = $namePlatform;
        }
    }
?>