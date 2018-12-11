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
            left: 11%;
            transition: all 200ms;
            font-size: 30px;

            text-decoration: none;
            color: #333;
            font-family: monospace;
            font-weight: 600;
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
        #nr1 {     margin-top: 14%;    margin-left: 9%;}
        #nr2 {      margin-left: 9%;}

        .effect-1 {
            border: 0; padding: 7px 0; border-bottom: 1px solid #ccc;width: 80%;}

        .effect-1 ~ .focus-border {
            position: absolute; bottom: 0; left: 0; width: 0; height: 2px; background-color: #4caf50; transition: 0.4s;}

        .effect-1:focus ~ .focus-border {
            transition: 0.4s;margin-left: 9%;
            width: 80%;
        }

        .effect-2 {
            border: 0; padding: 7px 0; border-bottom: 1px solid #ccc;width: 80%;}

        .effect-2 ~ .focus-border {
            position: absolute; bottom: 0; left: 0; width: 0; height: 2px; background-color: #4caf50; transition: 0.4s;}

        .effect-2:focus ~ .focus-border {
            transition: 0.4s;
            width: 80%;
        }

        #bg_1 {
            margin-left: 3%;
            width: 93%;
        }

        .thisbutton{    background-color: #a52a2a;
            padding-top: 13px;
            padding-bottom: 13px;
            padding-left: 30px;
            padding-right: 30px;
            margin-left: 11%;
            margin-bottom: 6%;
            margin-top: 3%;}

        .button1{
            display: inline-block;
            /* padding: 0.35em 1.2em; */
            padding: 13px 30px 13px 30px;
            border: 0.1em solid #FFFFFF;
            margin: 0 0.3em 0.3em 0;
            border-radius: 0.12em;
            box-sizing: border-box;
            text-decoration: none;
            font-family: 'Roboto',sans-serif;
            font-weight: 300;
            color: #FFFFFF;
            text-align: center;
            transition: all 0.2s;
            background-color: #30a954;
            cursor: pointer;
            margin-left: 11%;
            margin-bottom: 6%;
            margin-top: 3%;
        }
        .button1:hover{
            color:#FFFFFF;
            background-color:#27673a;
            transition: all 0.2s;
        }
        @media all and (max-width:30em){
             .button1{
                display:block;
                margin:0.4em auto;
                 }
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
    <a href="http://localhost:8080/PHPProjects/Hovedopgave/"><i class="fa fa-home"></i> Storage</a>
    <a class="active" href="http://localhost:8080/PHPProjects/Hovedopgave/Reservations.php"> Reservation</a>
    <a href="http://localhost:8080/PHPProjects/Hovedopgave/Production.php"> Production</a>
    <a href="http://localhost:8080/PHPProjects/Hovedopgave/FinishedProductions.php"> Finished Production</a>
</div>

<div class="wrapper-right">
    <h1>Reservations</h1>
    <?php
    //twig
    require_once 'vendor/autoload.php';
    Twig_Autoloader::register();
    //$loader er en variable med navnet "loader"
    $loader = new Twig_Loader_Filesystem('view'); //fortæller hvor template er lokalisert
    $twig = new Twig_Environment($loader, array(
        'auto_reload' => true
    ));
    $template = $twig->loadTemplate('allereservationer.html.twig'); //referer til allereservationer.html.twig.twig så den kan bruges
    $uri = "http://storageservice2018.azurewebsites.net/Service1.svc/reservations";
    $json = file_get_contents($uri);
    $Liste = json_decode($json); //fortæller jeg gerne vil have det i json
    $twigContent = array ("Reservations" => $Liste); // laver et array med min variabel $liste
    #print_r($twigContent);
    echo $template->render($twigContent);
    ?>
</div>
<div id="popup1" class="overlay">
    <div class="popup">
        <div class="login-overskrift">
            <div class="log-intitle-filler"></div>
            <div class="log-intitle">Create reservation</div>
        </div>
        <form class="forming" action="Controller/addreservation.php" method="POST">
            Id: <input type="text" value="" name="Id" />
            Product: <input type="text" value="" name="Product" />
            <input type="submit" value="Tilføj" name="TilføjKnap" />
        </form>
        <a class="close" href="#">&times;</a>
    </div>
</div>




<!--<div id="popup1" class="overlay">
    <div class="popup">
        <p class="poptitle">CREATE RESERVATION</p>
        <form class="forming" action="http://localhost:8080/PHPProjects/Hovedopgave/Controller/addreservation.php" method="POST">
        <div class="row bg_1">
            <div class="col-3" id="nr1">
                <input class="effect-1" value="" name="Id" type="number" placeholder="ID">
                <span class="focus-border"></span>
            </div>
            <div class="col-3">
                <input class="effect-1"  value="" name="Product" type="text" placeholder="Product">
                <span class="focus-border"></span>
            </div>
            <div class="col-3" id="nr2">
                <input class="effect-2" value="" name="ScheduledDate" type="datetime-local" placeholder="Scheduled Date">
                <span class="focus-border"></span>
            </div>
            <div class="col-3" id="nr2">
                <input class="effect-2" value="false" name="IsInProduction" type="hidden" placeholder="IsInProduction">
                <span class="focus-border"></span>
            </div>
            <div class="col-3" id="nr2">
                <input class="effect-2" value="false" name="IsDone" type="hidden" placeholder="IsDone">
                <span class="focus-border"></span>
            </div>

        </div>

        <input class="button1" type="submit" value="Tilføj" name="TilføjKnap" />
            </form>
        <a class="close" href="#">&times;</a>

    </div>
</div>-->


<div id="popup3" class="overlay">
    <div class="popup">
        <div class="login-overskrift">
            <div class="log-intitle-filler"></div>
            <div class="log-intitle"><b>Edit Component<b></div>
        </div>

        <form class="forming" action="Controller/updatereservation.php" method="POST">
            Id: <input type="text" value="" name="Id" />
            Product: <input type="text" value="" name="Product" />
            Send: <input type="submit" value="Edit" name="EditKnap" />
        </form>
        <a class="close" href="#">&times;</a>
    </div>
</div>
</body>
</html>