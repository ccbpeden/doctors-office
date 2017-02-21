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

        function getPatients()
        {
            $patients = array();
            $patient_query_string = "SELECT * FROM patients WHERE doctor_id = {$this->getId()};";
            $returned_patients = $GLOBALS['DB']->query($patient_query_string);
            foreach($returned_patients as $patient) {
                $name = $patient['name'];
                $birth_date = $patient['birth_date'];
                $doctor_id = $patient['doctor_id'];
                $id = $patient['id'];
                $new_patient = new Patient($name, $birth_date, $doctor_id, $id);
                array_push($patients, $new_patient);
            }
            return $patients;
        }

        static function findDoctor($search_id)
        {
            $found_doctor = null;
            $doctors = Doctor::getAll();
            foreach($doctors as $doctor) {
                $found_doctor_id = $doctor->getId();
                if ($found_doctor_id == $search_id) {
                    $found_doctor = $doctor;
                }
            }
            return $found_doctor;
        }


    }






?>
