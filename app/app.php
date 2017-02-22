<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Doctor.php";
    require_once __DIR__."/../src/Patient.php";
    require_once __DIR__."/../src/Specialty.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=office';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('specialties' => Specialty::getAll()));
    });

    $app->post("/specialties", function() use ($app) {
        $new_specialty = new Specialty($_POST['specialty_name']);
        $new_specialty->save();

        return $app['twig']->render('index.html.twig', array('specialties' => Specialty::getAll()));
    });

    $app->get("specialties/{id}", function($id) use ($app) {
        $search_specialty = Specialty::findSpecialty($id);
        return $app['twig']->render('specialty.html.twig', array('specialty' => $search_specialty, 'doctors' => $search_specialty->getDoctors()));
    });

    $app->post("/doctors", function() use ($app){
        $new_doctor = new Doctor($_POST['doctor_name'], $_POST['specialty_id']);
        $new_doctor->save();
        $specialty = Specialty::findSpecialty($_POST['specialty_id']);
        return $app['twig']->render('specialty.html.twig', array('specialty' => $specialty, 'doctors' => $specialty->getDoctors()));
    });



    return $app;
?>
