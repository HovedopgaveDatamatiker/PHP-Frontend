<?php
/*/**
 * Created by PhpStorm.
 * User: Tas
 * Date: 22-11-2018
 * Time: 14:03
 */
//

// set up twig
/*require_once '../vendor/autoload.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('../view');   // set folder to html/twig files
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('redirect_newreservation.html.twig'); // actual twig file
$con = new stdClass();
$con ->Id = $_REQUEST['Id'];
$con ->Product = $_REQUEST['Product'];
$con ->ScheduledDate = $_REQUEST['ScheduledDate'];
$con ->IsDone = $_REQUEST['IsDone'];
$con ->IsInProduction = $_REQUEST['IsInProduction'];

$json = json_encode($con);
// set up POST request
$URI = 'http://storageservice2018.azurewebsites.net/Service1.svc/reservations'; // URL to REST API
$req = curl_init($URI);  // initlize curl
curl_setopt($req, CURLOPT_CUSTOMREQUEST, "POST"); // request method
curl_setopt($req, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($json))          // insert header i.e mime-type + length
);
curl_setopt($req, CURLOPT_POSTFIELDS, $json);   // insert data in body
curl_setopt($req, CURLOPT_RETURNTRANSFER, true); // do not display json
$result = curl_exec($req); // sends the request and get result
$jsonStr = file_get_contents($URI);
$Liste = json_decode($jsonStr);
$twigContent = array("Reservations" => $Liste);                     // fill in the content for the page
echo $template->render($twigContent);*/ // let twig file generate html*/



// set up twig
require_once '../vendor/autoload.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('../view');   // set folder to html/twig files
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('redirect_newreservation.html.twig'); // actual twig file
$con = new stdClass();
$con ->Id = $_REQUEST['Id'];
$con ->IsDone = false;
$con ->IsInProduction = false;
$con ->Product = $_REQUEST['Product'];
$con ->ScheduledDate = $_REQUEST['ScheduledDate'];


$json = json_encode($con);
// set up POST request
$URI = 'http://storageservice2018.azurewebsites.net/Service1.svc/reservations'; // URL to REST API
$req = curl_init($URI);  // initlize curl
curl_setopt($req, CURLOPT_CUSTOMREQUEST, "POST"); // request method
curl_setopt($req, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($json))          // insert header i.e mime-type + length
);
curl_setopt($req, CURLOPT_POSTFIELDS, $json);   // insert data in body
curl_setopt($req, CURLOPT_RETURNTRANSFER, false); // do not display json
$result = curl_exec($req); // sends the request and get result
$jsonStr = file_get_contents($URI);
$Liste = json_decode($jsonStr);
$twigContent = array("Reservations" => $Liste);                     // fill in the content for the page
echo $template->render($twigContent); // let twig file generate html