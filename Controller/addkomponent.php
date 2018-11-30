<?php
/**
 * Created by PhpStorm.
 * User: Tas
 * Date: 22-11-2018
 * Time: 14:03
 */
//

// set up twig
require_once '../vendor/autoload.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('../view');   // set folder to html/twig files
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('redirect.html.twig'); // actual twig file
$con = new stdClass();
$con ->Id = $_REQUEST['Id'];
$con ->Title = $_REQUEST['Title'];
$con ->Specification = $_REQUEST['Specification'];
$con ->Price = $_REQUEST['Price'];
$con ->Link = $_REQUEST['Link'];
$con ->Note = $_REQUEST['Note'];
$con ->EstDelivery = $_REQUEST['EstDelivery'];
$con ->Quantity = $_REQUEST['Quantity'];
$json = json_encode($con);
// set up POST request
$URI = 'http://storageservice2018.azurewebsites.net/Service1.svc/komponenter'; // URL to REST API
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
$twigContent = array("Components" => $Liste);                     // fill in the content for the page
echo $template->render($twigContent); // let twig file generate html