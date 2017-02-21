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
        protected function tearDown()
        {
            Patient::deleteAll();
            Doctor::deleteAll();
            Specialty::deleteAll();
        }

        function test_construct()
        {
            $specialty = "OB-GYN";
            $new_specialty = new Specialty($specialty);

            $result = $new_specialty->getSpecialtyName();

            $this->assertEquals($specialty, $result);
        }

        function test_getAllAndSave()
        {
            $specialty_name = "OB-GYN";
            $new_specialty = new Specialty($specialty_name);
            $new_specialty->save();

            $specialty_name2 = "Surgery";
            $new_specialty2 = new Specialty($specialty_name2);
            $new_specialty2->save();

            $result = Specialty::getAll();

            $this->assertEquals([$new_specialty, $new_specialty2], $result);
        }

        function test_findSpecialty()
        {
            $specialty_name = "OB-GYN";
            $new_specialty = new Specialty($specialty_name);
            $new_specialty->save();

            $specialty_name2 = "Surgery";
            $new_specialty2 = new Specialty($specialty_name2);
            $new_specialty2->save();
            $result = Specialty::findSpecialty($new_specialty->getId());


            $this->assertEquals($new_specialty, $result);
        }

        function test_getDoctors()
        {
            $specialty_name = "OB-GYN";
            $id = null;
            $new_specialty = new Specialty($specialty_name);
            $new_specialty->save();

            $new_specialty_id = $new_specialty->getId();

            $name = "Dr. James Novak";
            $new_doctor = new Doctor($name, $new_specialty_id);
            $new_doctor->save();

            $name2 = "Dr. Phil Slaughter";
            $specialty_id2 = 1;
            $new_doctor2 = new Doctor($name2, $specialty_id2);
            $new_doctor2->save();

            $result = $new_specialty->getDoctors();

            $this->assertEquals([$new_doctor], $result);
        }
    }





?>
