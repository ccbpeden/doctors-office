<?php

    class Doctor
    {
        private $id;
        private $name;
        private $specialty_id;

        function __construct($name, $specialty_id, $id = null)
        {
            $this->id = $id;
            $this->name = $name;
            $this->specialty_id = $specialty_id;
        }

        function getName()
        {
            return $this->name;
        }

        function getId()
        {
            return $this->id;
        }

        function getSpecialtyId()
        {
            return $this->specialty_id;
        }



    }






?>
