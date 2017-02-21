<?php

    class Specialty
    {
        private $id;
        private $specialty_name;

        function __construct($specialty_name, $id = null)
        {
            $this->specialty_name = $specialty_name;
            $this->id = $id;
        }

        function getSpecialtyName()
        {
            return $this->specialty_name;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO specialties (specialty_name) VALUES ('{$this->getSpecialtyName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_specialties = $GLOBALS['DB']->query("SELECT * FROM specialties ORDER BY specialty_name;");
            $specialties = array();
            foreach ($returned_specialties as $specialty) {
                $specialty_name = $specialty['specialty_name'];
                $id = $specialty['id'];
                $new_specialty = new Specialty($specialty_name, $id);
                array_push($specialties, $new_specialty);
            }
            return $specialties;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM specialties;");
        }

        static function findSpecialty($search_id)
        {
            $found_specialty = null;
            $specialties = Specialty::getAll();
            foreach ($specialties as $specialty) {
                $found_specialty_id = $specialty->getId();
                if ($found_specialty_id == $search_id) {
                    $found_specialty = $specialty;
                }
            }
            return $found_specialty;
        }

        function getDoctors()
        {
            $doctors = array();
            $returned_doctors = $GLOBALS['DB']->query("SELECT * FROM doctors WHERE specialty_id = {$this->getId()};");
            foreach($returned_doctors as $doctor) {
                $name = $doctor['name'];
                $id = $doctor['id'];
                $specialty_id = $doctor['specialty_id'];
                $new_doctor = new Doctor($name, $specialty_id, $id);
                array_push($doctors, $new_doctor);
            }
            return $doctors;
        }

    }

?>
