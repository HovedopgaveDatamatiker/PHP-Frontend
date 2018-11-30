<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="Stylesheet/Indexstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="wrapper-left">
    <a href="http://localhost:8080/PHPProjects/Hovedopgave/">STORAGE</a>
    <a href="http://localhost:8080/PHPProjects/Hovedopgave/Reservations.php">RESERVATIONS</a>
    <a href="http://localhost:8080/PHPProjects/Hovedopgave/Production.php">PRODUCTION</a>
    <a href="http://localhost:8080/PHPProjects/Hovedopgave/FinishedProductions.php">FINISHED PRODUCTIONS</a>
</div>




<div class="wrapper-right">
    <h1>Alle i produktion</h1>
    <?php
    /**
     * Created by PhpStorm.
     * User: Tas
     * Date: 22-11-2018
     * Time: 10:57
     */

    //twig
    require_once 'vendor/autoload.php';
    Twig_Autoloader::register();
    //$loader er en variable med navnet "loader"
    $loader = new Twig_Loader_Filesystem('view'); //fortæller hvor template er lokalisert
    $twig = new Twig_Environment($loader, array(
        'auto_reload' => true
    ));
    $template = $twig->loadTemplate('alleproductions.html.twig'); //referer til allecoins.html.twig.twig så den kan bruges
    $uri = "http://storageservice2018.azurewebsites.net/Service1.svc/production";
    $json = file_get_contents($uri);
    $Liste = json_decode($json); //fortæller jeg gerne vil have det i json
    $twigContent = array ("Productions" => $Liste); // laver et array med min variabel $liste
    #print_r($twigContent);
    echo $template->render($twigContent);

    ?>
</div>

</body>
</html>