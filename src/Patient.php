<?php

    class Patient
    {
        private $id;
        private $name;
        private $birth_date;
        private $doctor_id;

        function __construct($name, $birth_date, $doctor_id, $id = null)
        {
            $this->name = $name;
            $this->birth_date = $birth_date;
            $this->doctor_id = $doctor_id;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function getBirthDate()
        {
            return $this->birth_date;
        }

        function getDoctorId()
        {
            return $this->doctor_id;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO patients (name, birth_date, doctor_id) VALUES ('{$this->getName()}', '{$this->getBirthDate()}', {$this->getDoctorId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_patients = $GLOBALS['DB']->query("SELECT * FROM patients ORDER BY name;");
            $patients = array();
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

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM patients;");
        }


    }






?>
