<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="Stylesheet/Indexstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<a href="#popup1">
<div class="addbtns">
    <i class="fa fa-plus" style="font-size:24px; text-align: center;margin-left: 34%;margin-top: 30%; color: white"></i>
</div>
</a>
<div class="wrapper-left">
    <a class="active" href="http://localhost:8080/PHPProjects/Hovedopgave/"><i class="fa fa-home"></i> Storage</a>
    <a href="http://localhost:8080/PHPProjects/Hovedopgave/Reservations.php"> Reservation</a>
    <a href="http://localhost:8080/PHPProjects/Hovedopgave/Production.php"> Production</a>
    <a href="http://localhost:8080/PHPProjects/Hovedopgave/FinishedProductions.php"> Finished Production</a>
</div>





<div class="wrapper-right">
    <h1>Alle Komponenter</h1>
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
    $template = $twig->loadTemplate('allekomponenter.html.twig'); //referer til allecoins.html.twig.twig så den kan bruges
    $uri = "http://storageservice2018.azurewebsites.net/Service1.svc/komponenter";
    $json = file_get_contents($uri);
    $Liste = json_decode($json); //fortæller jeg gerne vil have det i json
    $twigContent = array ("Components" => $Liste); // laver et array med min variabel $liste
    #print_r($twigContent);
    echo $template->render($twigContent);

    ?>

<!--    <h1>Slet en komponent</h1>
    <form action="Controller/deletekomponent.php" method="POST">
        Id: <input type="number" value="" name="Id" />
        Send: <input type="submit" value="Slet" name="SletKnap" />
    </form>
-->

</div>

<div id="popup1" class="overlay">
    <div class="popup">
        <div class="login-overskrift">
            <div class="log-intitle-filler"></div>
            <div class="log-intitle">OPRET KOMPONENT</div>
        </div>
        <form class="forming" action="Controller/addkomponent.php" method="POST">
            Id: <input type="text" value="" name="Id" />
            Title: <input type="text" value="" name="Title" />
            Specification: <input type="text" step="0.01" value="" name="Specification" />
            Price: <input type="number" value="" name="Price" />
            Link: <input type="text" value="" name="Link" />
            Note: <input type="text" value="" name="Note" />
            EstDelivery: <input type="number" value="" name="EstDelivery" />
            Quantity: <input type="number" value="" name="Quantity" />
            Send: <input type="submit" value="Tilføj" name="TilføjKnap" />
        </form>
        <a class="close" href="#">&times;</a>
    </div>
</div>

</body>
</html>