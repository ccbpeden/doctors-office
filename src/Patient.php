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


    }






?>
