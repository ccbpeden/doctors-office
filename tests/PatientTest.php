<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Doctor.php";
    require_once "src/Patient.php";
    require_once "src/Specialty.php";

    $server = 'mysql:host=localhost:8889;dbname=office_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class PatientTest extends PHPUnit_Framework_TestCase
    {

        function test_construct()
        {
            $name = "Bob Smith";
            $doctor_id = 1;
            $birth_date = "1950-01-01";
            $new_patient = new Patient($name, $birth_date, $doctor_id);

            $patient_data = array();
            $result = $new_patient->getName();
            $result2 = $new_patient->getBirthDate();
            $result3 = $new_patient->getDoctorId();
            array_push($patient_data, $result, $result2, $result3);

            $this->assertEquals([$name, $birth_date, $doctor_id], $patient_data);
        }
    }







?>
