<?php
//twig
require_once '../vendor/autoload.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('../View');
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('redirect_movetoproduction.html.twig');
$con = new stdClass();
$con ->Id = $_REQUEST['Id'];
$con ->IsInProduction = true;
$json = json_encode($con);


// set up PUT request
$URI = "http://storageservice2018.azurewebsites.net/Service1.svc/reservationtoproduction";
$req = curl_init($URI); // initlize curl
curl_setopt($req, CURLOPT_CUSTOMREQUEST, "PUT");   // request method
curl_setopt($req, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($json)) // insert header i.e mime-type + length
);
curl_setopt($req, CURLOPT_POSTFIELDS, $json);   // insert data in body
curl_setopt($req, CURLOPT_RETURNTRANSFER, false);    // do not display json
$result = curl_exec($req);  // sends the request and get result
// Get All Reservations
$uri = "http://storageservice2018.azurewebsites.net/Service1.svc/reservations";
$jsonStr = file_get_contents($uri);
$Liste = json_decode($jsonStr);
$twigContent = array("Reservations" => $Liste); // fill in the content for the page
echo $template->render($twigContent);   // let twig file generate html