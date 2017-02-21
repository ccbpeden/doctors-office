<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Doctor.php";
    require_once "src/Patient.php";

    $server = 'mysql:host=localhost:8889;dbname=office_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    Class DoctorTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     Patient::deleteAll();
        //     Doctor::deleteAll();
        // }

        function test_construct()
        {
            $name = "Dr. James Novak";
            $specialty_id = 1;
            $new_doctor = new Doctor($name, $specialty_id);

            $doctor_data = array();
            $result = $new_doctor->getName();
            $result2 = $new_doctor->getSpecialtyId();
            array_push($doctor_data, $result, $result2);

            $this->assertEquals([$name, $specialty_id], $doctor_data);
        }
    }
?>
