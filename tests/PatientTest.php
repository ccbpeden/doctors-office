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
        protected function tearDown()
        {
            Patient::deleteAll();
            Doctor::deleteAll();
            Specialty::deleteAll();
        }

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

        function test_getAllAndSave()
        {
            $name = "Bob Smith";
            $birth_date = "1950-01-01";
            $doctor_id = 1;
            $new_patient = new Patient($name, $birth_date, $doctor_id);
            $new_patient->save();
            echo("new patient is: ");
            var_dump($new_patient);

            $name2 = "Jane Doe";
            $birth_date2 = "1962-11-11";
            $doctor_id2 = 2;
            $new_patient2 = new Patient($name2, $birth_date2, $doctor_id2);
            $new_patient2->save();
            echo("new patient2 is: ");
            var_dump($new_patient2);

            $result = Patient::getAll();

            $this->assertEquals([$new_patient, $new_patient2], $result);
        }
    }







?>
