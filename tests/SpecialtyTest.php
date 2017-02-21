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

    class SpecialtyTest extends PHPUnit_Framework_TestCase
    {
        function test_construct()
        {
            $specialty = "OB-GYN";
            $new_specialty = new Specialty($specialty);

            $result = $new_specialty->getSpecialty();

            $this->assertEquals($specialty, $result);
        }
    }





?>
