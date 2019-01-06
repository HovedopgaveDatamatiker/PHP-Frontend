<?php
/**
 * Created by PhpStorm.
 * User: Tas
 * Date: 22-11-2018
 * Time: 10:57
 */

//twig
require_once '../vendor/autoload.php';
Twig_Autoloader::register();
//$loader er en variable med navnet "loader"
$loader = new Twig_Loader_Filesystem('../view'); //fortæller hvor template er lokalisert
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('allekomponenter.html.twig'); //referer til allekomponenter.html.twig.twig så den kan bruges
$uri = "http://storageservice2018.azurewebsites.net/Service1.svc/komponenter";
$json = file_get_contents($uri);
$Liste = json_decode($json); //fortæller jeg gerne vil have det i json
$twigContent = array ("Components" => $Liste); // laver et array med min variabel $liste
#print_r($twigContent);
echo $template->render($twigContent);

?>






