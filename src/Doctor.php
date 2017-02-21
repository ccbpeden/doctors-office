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

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO doctors (name, specialty_id) VALUES ('{$this->getName()}', {$this->getSpecialtyId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_doctors = $GLOBALS['DB']->query("SELECT * FROM doctors ORDER BY name;");
            $doctors = array();
            foreach($returned_doctors as $doctor) {
                $id = $doctor['id'];
                $name = $doctor['name'];
                $specialty_id = $doctor['specialty_id'];
                $new_doctor = new Doctor($name, $specialty_id, $id);
                array_push($doctors, $new_doctor);
            }
            return $doctors;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM doctors;");
        }



    }






?>
