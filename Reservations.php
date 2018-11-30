<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="Stylesheet/Indexstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .poptitle{
            position: absolute;
            top: 3px;
            left: 6.5%;
            transition: all 200ms;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }

        .popup {
            margin: 70px auto;
            background: #fff;
            border-radius: 1px;
            width: 40%;
            position: relative;
            transition: all 5s ease-in-out;
        }

        .popup h2 {
            margin-top: 0;
            color: #333;
            font-family: Tahoma, Arial, sans-serif;
        }
        .popup .close {
            position: absolute;
            top: 3px;
            right: 10px;
            transition: all 200ms;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }
        .popup .close:hover {
            color: #ED6347;;
        }
        .popup .content {
            max-height: 30%;
            overflow: auto;
        }


        a { color:red } /* Globally */

        .icon-bar {
            width: 90px;
            background-color: #555;
            height: 100vh;
        }

        .icon-bar a {
            display: block;
            text-align: center;
            padding: 16px;
            transition: all 0.3s ease;
            color: white;
            font-size: 36px;
        }

        .icon-bar a:hover {
            background-color: #000;
        }

        .active {
            background-color: #4CAF50;}

        .row{
            margin-left: 3%;
            width: 93%;
        }

        /* necessary to give position: relative to parent. */
        input[type="text"] {
            font: 15px/24px 'Muli', sans-serif; color: #333; width: 80%; box-sizing: border-box; letter-spacing: 1px;    margin-left: 9%;}

        :focus{outline: none;}

        .col-3 {     float: left;
            width: 100%;
            margin: 19px 0%;
            position: relative;}
        #nr1 {     margin-top: 14%}

        .effect-1 {
            border: 0; padding: 7px 0; border-bottom: 1px solid #ccc;}

        .effect-1 ~ .focus-border {
            position: absolute; bottom: 0; left: 0; width: 0; height: 2px; background-color: #4caf50; transition: 0.4s;}

        .effect-1:focus ~ .focus-border {
            width: 100%; transition: 0.4s;}

        #bg_1 {
            margin-left: 3%;
            width: 93%;
        }
    </style>
</head>
<body>
<a href="#popup1">
    <div class="addbtns">
        <i class="fa fa-plus" style="font-size:24px; text-align: center;margin-left: 34%;margin-top: 30%; color: white"></i>
    </div>
</a>
<div class="wrapper-left">
    <a href="http://localhost:8080/PHPProjects/Hovedopgave/">STORAGE</a>
    <a href="http://localhost:8080/PHPProjects/Hovedopgave/Reservations.php">RESERVATIONS</a>
    <a href="http://localhost:8080/PHPProjects/Hovedopgave/Production.php">PRODUCTION</a>
    <a href="http://localhost:8080/PHPProjects/Hovedopgave/FinishedProductions.php">FINISHED PRODUCTIONS</a>
</div>





<div class="wrapper-right">
    <h1>Alle Reservationer</h1>
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
    $template = $twig->loadTemplate('allereservationer.html.twig'); //referer til allecoins.html.twig.twig så den kan bruges
    $uri = "http://storageservice2018.azurewebsites.net/Service1.svc/reservations";
    $json = file_get_contents($uri);
    $Liste = json_decode($json); //fortæller jeg gerne vil have det i json
    $twigContent = array ("Reservations" => $Liste); // laver et array med min variabel $liste
    #print_r($twigContent);
    echo $template->render($twigContent);

    ?>



</div>

<!--<div id="popup1" class="overlay">-->
<!--    <div class="popup">-->
<!--        <div class="login-overskrift">-->
<!--            <div class="log-intitle-filler"></div>-->
<!--            <div class="log-intitle">OPRET KOMPONENT</div>-->
<!--        </div>-->
<!--        <form class="forming" action="Controller/addreservation.php" method="POST">-->
<!--            Id: <input type="number" value="" name="Id" />-->
<!--            Title: <input type="text" value="" name="Product" />-->
<!--            ScheduledDate: <input type="number" step="0.01" value="" name="ScheduledDate" />-->
<!--            IsDone: <input type="checkbox" value=0 name="IsDone" />-->
<!---->
<!--            Send: <input type="submit" value="Tilføj" name="TilføjKnap" />-->
<!--        </form>-->
<!--        <a class="close" href="#">&times;</a>-->
<!--    </div>-->
<!--</div>-->

<div id="popup1" class="overlay">
    <div class="popup">
        <p class="poptitle">CREATE RESERVATION</p>
        <div class="row bg_1">
            <div class="col-3" id="nr1">
                <input class="effect-1" type="text" placeholder="ID">
                <span class="focus-border"></span>
            </div>
            <div class="col-3">
                <input class="effect-1" type="text" placeholder="Product">
                <span class="focus-border"></span>
            </div>
            <div class="col-3">
                <input class="effect-1" type="text" placeholder="Scheduled Date">
                <span class="focus-border"></span>
            </div>
        </div>
        <input type="submit" value="Tilføj" name="TilføjKnap" />
        <a class="close" href="#">&times;</a>
    </div>
</div>


</body>
</html>