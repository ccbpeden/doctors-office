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

    Class DoctorTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Patient::deleteAll();
            Doctor::deleteAll();
            Specialty::deleteAll();
        }

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

        function test_getAllAndSave()
        {
            $name = "Dr. James Novak";
            $specialty_id = 1;
            $new_doctor = new Doctor($name, $specialty_id);
            $new_doctor->save();

            $name2 = "Dr. Phil Slaughter";
            $specialty_id2 = 2;
            $new_doctor2 = new Doctor($name2, $specialty_id2);
            $new_doctor2->save();

            $result = Doctor::getAll();

            $this->assertEquals([$new_doctor, $new_doctor2], $result);
        }

        function test_getPatients()
        {
            $name = "Dr. James Novak";
            $specialty_id = 1;
            $new_doctor = new Doctor($name, $specialty_id);
            $new_doctor->save();

            $new_doctor_id = $new_doctor->getId();

            $name = "Bob Smith";
            $birth_date = "1950-01-01";
            $doctor_id = $new_doctor_id;
            $new_patient = new Patient($name, $birth_date, $doctor_id);
            $new_patient->save();

            $name2 = "Jane Doe";
            $birth_date2 = "1962-11-11";
            $doctor_id2 = 2;
            $new_patient2 = new Patient($name2, $birth_date2, $doctor_id2);
            $new_patient2->save();

            $result = $new_doctor->getPatients();

            $this->assertEquals([$new_patient], $result);
        }

        function test_findDoctor()
        {
            $name = "Dr. James Novak";
            $specialty_id = 1;
            $new_doctor = new Doctor($name, $specialty_id);
            $new_doctor->save();

            $name2 = "Dr. Phil Slaughter";
            $specialty_id2 = 2;
            $new_doctor2 = new Doctor($name2, $specialty_id2);
            $new_doctor2->save();

            $result = Doctor::findDoctor($new_doctor->getId());

            $this->assertEquals($new_doctor, $result);
        }
    }
?>
