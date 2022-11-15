<?php
    class Platform
    {
        private $id;
        private $name;

        /**
         * @param $id
         * @param $name
         */
        public function __construct($idPlatform, $namePlatform)
        {
            $this->id = $idPlatform;
            $this->name = $namePlatform;
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
        public function getName()
        {
            return $this->name;
        }

        /**
         * @param mixed $name
         */
        public function setName($name)
        {
            $this->name = $name;
        }
    }
?>