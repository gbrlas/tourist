<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        div img {
            height:  = 100%;
            max-height: 300px;
            width = 600px;
            border: 2px solid ghostwhite;
            border-radius: 50px;
        }
    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TRAVEL TIME ADMIN - Uređivanje lokacija</title>

    <link rel="icon" href="../images/holiday.jpg">


    <link href="../css/custom.css" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/1-col-portfolio.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../admin.php?logged=true">ADMIN</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">LOKACIJE
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../admin.php?value=addLocation&logged=true">Dodaj lokaciju</a></li>
                        <li><a href="../admin.php?value=removeLocation&logged=true">Obriši lokaciju</a></li>
                        <li><a href="../admin.php?value=editLocation&logged=true">Uredi lokaciju</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">SMJEŠTAJ
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../admin.php?value=addAccomodation&logged=true">Dodaj smještaj</a></li>
                        <li><a href="../admin.php?value=removeAccomodation&logged=true">Obriši smještaj</a></li>
                        <li><a href="../admin.php?value=editAccomodation&logged=true">Uredi smještaj</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">IZLETI
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../admin.php?value=addTour&logged=true">Dodaj izlet</a></li>
                        <li><a href="../admin.php?value=removeTour&logged=true">Obriši izlet</a></li>
                        <li><a href="../admin.php?value=editTour&logged=true">Uredi izlet</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">OSTALO
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../admin.php?value=addImage&logged=true">Dodaj sliku</a></li>
                        <li><a href="../admin.php?value=addRoom&logged=true">Dodaj sobu</a></li>
                        <li><a href="../admin.php?value=addHotelContent&logged=true">Dodaj hotelski sadržaj</a></li>
                        <li><a href="../admin.php?value=addAction&logged=true">Dodaj popust</a></li>
                        <li><a href="../admin.php?value=addCustomer&logged=true">Dodaj korisnika</a></li>
                        <li><a href="../admin.php?value=addCountry&logged=true">Dodaj državu</a></li>

                    </ul>
                </li>
                <li>
                    <a href="../index.php">WEB-STRANICA</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">



    <?php
    include "spajanje_na_bazu.php";
    include "funkcije.php";

    $id = $_GET['value'];

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    }

    if (! isset($_GET['changed'])) {
        $upit = "SELECT idLokacija, ime, opis, tip, idDrzava FROM lokacija WHERE idLokacija = $id";
        $rezultat = mysqli_query($veza, $upit) or die ("1" . mysqli_error($veza));

        $redak = mysqli_fetch_array($rezultat, MYSQLI_ASSOC);

        $lokacija = $redak['idLokacija'];
        $ime = $redak['ime'];
        $opis = $redak['opis'];
        $tip = $redak['tip'];
        $idDrzava = $redak['idDrzava'];

        echo "<form class=\"form-horizontal\" action=\"./editLocations.php?value=$id&changed=true\" method=\"post\">
            <div class=\"form-group\">
                <label for=\"name\" class=\"col-sm-2 control-label\">Ime</label>
                <div class=\"col-sm-9\">
                    <input name=\"name\" class=\"form-control\" id=\"name\" value=\"$ime\">
                </div>
            </div>
            <div class=\"form-group\">
                <label for=\"description\" class=\"col-sm-2 control-label\">Opis</label>
                <div class=\"col-sm-9\">
                    <textarea name=\"description\" class=\"form-control\" rows=\"6\">$opis</textarea>
                </div>
            </div>
            <div class=\"form-group\">
                <label for=\"state\" class=\"col-sm-2 control-label\">ID države</label>
                <div class=\"col-sm-2\">
                    <input name=\"state\" class=\"form-control\" id=\"state\" value=\"$idDrzava\">
                </div>
            </div>
            <div class=\"form-group\">
                <label for=\"type\" class=\"col-sm-2 control-label\">Tip</label>
                <div class=\"col-sm-1\">
                    <input name=\"type\" class=\"form-control\" id=\"type\" value=\"$tip\">
                </div>
            </div>
            <div class=\"form-group\">
                <div class=\"col-sm-offset-2 col-sm-10\">
                    <button name=\"saveForm\" type=\"submit\" class=\"btn btn-success\">Uredi lokaciju</button>
                    <button name='reset' type=\"reset\" class=\"btn btn-danger\">Poništi</button>
                </div>
            </div>

        </form>";
    } else {

        $name = navodnici($_POST['name']);
        $description = navodnici($_POST['description']);
        $type = $_POST['type'];
        $state = $_POST['state'];

        $upit = "UPDATE lokacija SET ime = $name, opis = $description, tip = $type, idDrzava = $state WHERE idLokacija = $id";
        mysqli_query($veza, $upit) or die ("2" . mysqli_error($veza));

        echo "<div class=\"row\">
                    <div class=\"col-md-6\">
                        <h4 style='color: limegreen'>Lokacija <b>$id</b> uspješno uređena. </h4></div></div>";
    }
    ?>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; 2016 Goran Brlas. All rights reserved.</p>
            </div>
        </div>
        <!-- /.row -->
    </footer>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
