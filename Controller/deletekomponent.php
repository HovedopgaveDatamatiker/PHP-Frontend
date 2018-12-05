<?php
/**
 * Created by PhpStorm.
 * User: Tas
 * Date: 22-11-2018
 * Time: 14:24
 */

// Twig
require_once '../vendor/autoload.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('../View');
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('redirectdelete.html.twig');
$id = $_REQUEST['Id'];
// set up DELETE request
$URI = "http://storageservice2018.azurewebsites.net/Service1.svc/komponenter?id=".$id;
$req = curl_init($URI); // initlize curl
curl_setopt($req, CURLOPT_CUSTOMREQUEST, "DELETE");   // request method
curl_setopt($req, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json'));
$result = curl_exec($req);  // sends the request and get result
//Get All
$uri = "http://storageservice2018.azurewebsites.net/Service1.svc/komponenter";
$jsonStr = file_get_contents($uri);
$Liste = json_decode($jsonStr);
$twigContent = array("Components" => $Liste); // fill in the content for the page
echo $template->render($twigContent);   // let twig file generate html
