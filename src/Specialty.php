<?php

    class Specialty
    {
        private $id;
        private $specialty;

        function __construct($specialty, $id = null)
        {
            $this->specialty = $specialty;
            $this->id = $id;
        }

        function getSpecialty()
        {
            return $this->specialty;
        }

        function getId()
        {
            return $this->id;
        }



    }

?>
