<?php
    class Actor
    {
        private $id;
        private $name;
        private $lastName;
        private $dateOfBirth;
        private $nationality;

        /**
         * @param $id
         * @param $name
         * @param $lastName
         * @param $dateOfBirth
         * @param $nationality
         */
        public function __construct($idActor, $nameActor, $lastNameActor,
                                    $dateOfBirthActor, $nationalityActor)
        {
            $this->id = $idActor;
            $this->name = $nameActor;
            $this->lastName = $lastNameActor;
            $this->dateOfBirth = $dateOfBirthActor;
            $this->nationality = $nationalityActor;
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

        /**
         * @return mixed
         */
        public function getLastName()
        {
            return $this->lastName;
        }

        /**
         * @param mixed $lastName
         */
        public function setLastName($lastName)
        {
            $this->lastName = $lastName;
        }

        /**
         * @return mixed
         */
        public function getDateOfBirth()
        {
            return $this->dateOfBirth;
        }

        /**
         * @param mixed $dateOfBirth
         */
        public function setDateOfBirth($dateOfBirth)
        {
            $this->dateOfBirth = $dateOfBirth;
        }

        /**
         * @return mixed
         */
        public function getNationality()
        {
            return $this->nationality;
        }

        /**
         * @param mixed $nationality
         */
        public function setNationality($nationality)
        {
            $this->nationality = $nationality;
        }
    }
?>