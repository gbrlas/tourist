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

        body {
            background-image: url(./images/background-grey100.png);
        }
    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tourist Agency</title>

    <link href="css/custom.css" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/1-col-portfolio.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./index.php">TOURIST AGENCY</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="./destinations.php?type=summer&page=1">SUMMER DESTINATIONS</a>
                </li>
                <li>
                    <a href="./destinations.php?type=winter&page=1">WINTER RESORTS</a>
                </li>
                <li>
                    <a href="./destinations.php?type=cities&page=1">CITY-BREAKS</a>
                </li>
                <li>
                    <a href="./tours.php?page=1">TOURS</a>
                </li>
                <li>
                    <a href="./accomodations.php">ACCOMODATIONS</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">

    <!-- Page Heading -->
    <!-- /.row -->

    <!-- Project One -->
    <?php
    include './admin/spajanje_na_bazu.php';
    include './admin/funkcije.php';

    if (isset($_GET['reserved'])) {

    } else {
        $id = $_GET['value'];
        $customerID = $_GET['customerID'];
        $type = $_GET['type'];

        $upit = "SELECT idSmjestaj, tip, opis, adresa, klasifikacija, idLokacija, idAkcija FROM SMJESTAJ WHERE idSmjestaj = $id";
        $rezultat = mysqli_query($veza, $upit) or die ("1" . mysqli_error($veza));

        $redak = mysqli_fetch_array($rezultat, MYSQLI_ASSOC);

        $idLokacija = $redak['idLokacija'];
        $opis = $redak['opis'];
        $adresa = $redak['adresa'];
        $klasifikacija = $redak['klasifikacija'];
        $idAkcija = $redak['idAkcija'];

        $upit5 = "SELECT idSlika FROM SLIKE_SMJESTAJ WHERE idSmjestaj = $id";
        $rezultat5 = mysqli_query($veza, $upit5) or die ("2" . mysqli_error($veza));
        $redak5 = mysqli_fetch_array($rezultat5, MYSQLI_ASSOC);
        $idSlika = $redak5['idSlika'];

        $upit5 = "SELECT url FROM SLIKA WHERE idSlika = $idSlika";
        $rezultat5 = mysqli_query($veza, $upit5) or die ("3" .   mysqli_error($veza));
        $redak5 = mysqli_fetch_array($rezultat5, MYSQLI_ASSOC);
        $url = $redak5['url'];
        
        
        echo "<div class=\"row\">
        <div class=\"col-lg-12\">
            <h2 class=\"page-header\">$naziv</h2>
        </div>
    </div>";

        echo "<div class=\"row\">";
        echo " <div class=\"col-md-6\">
                    <a href=\"#\">
                        <img class=\"img-responsive nova\" src=\"./images/$url\" width=\"1200\" height=\"400\" alt=\"\">
                    </a>
                 
                </div>
               ";

        if (! isset($_GET['selectedRoom']) && ! isset($_GET['selectedDate'])) {
            echo "<div class='col-md-6' align='center'> <div class=\"dropdown\">
            <button style='margin-top: 100px;' class=\"btn btn-primary dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">
  Select starting date and time</button>
  <ul style='margin-left: 175px;' class=\"dropdown-menu\">";

            $upit = "SELECT idSoba, tip, brojSlobodnih FROM SOBA WHERE idSmjestaj = $id";
            $rezultat = mysqli_query($veza, $upit) or die (mysqli_error($veza));

            while ($redak = mysqli_fetch_array($rezultat, MYSQLI_ASSOC)) {
                $idSoba = $redak['idSoba'];
                $tipSobe = $redak['tip'];
                $brojSlobodnih = $redak['tip'];

                echo "<li><a href=\"reserveTour.php?value=$id&customerID=$customerID&idSoba=$idSoba&selectedRoom=true\">$tipSobe, $brojSlobodnih rooms available</a></li>";
            }

            echo "  </ul>
</div></div></div>";

            echo "<div class=\"row\">";


            $upit6 = "SELECT idSadrzaj FROM HOTEL_NUDI WHERE idSmjestaj = $id";
            $rezultat6 = mysqli_query($veza, $upit6) or die (mysqli_error($veza));

            echo "
        <div class=\"col-lg-6\">
            <h2 class=\"page-header\">Hotel offers: </h2>";

            while ($redak6 = mysqli_fetch_array($rezultat6, MYSQLI_ASSOC)) {
                $idSadrzaj = $redak6['idSadrzaj'];

                $upit7 = "SELECT naziv FROM SADRZAJ WHERE idSadrzaj = $idSadrzaj";
                $rezultat7 = mysqli_query($veza, $upit7) or die (mysqli_error($veza));
                $redak7 = mysqli_fetch_array($rezultat7, MYSQLI_ASSOC);

                $sadrzaj = $redak7['naziv'];

                echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> $sadrzaj</p>";
            }

            echo "
        </div>";

            $upit6 = "SELECT tip, brojSlobodnih FROM SOBA WHERE idSmjestaj = $id ORDER BY cijenaPoDanu DESC";
            $rezultat6 = mysqli_query($veza, $upit6) or die (mysqli_error($veza));

            echo "
        <div class=\"col-lg-6\">
            <h2 class=\"page-header\">Room types: </h2>";

            while ($redak6 = mysqli_fetch_array($rezultat6, MYSQLI_ASSOC)) {
                $roomType = $redak6['tip'];
                $brojSlobodnih = $redak6['brojSlobodnih'];

                echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> $roomType, $brojSlobodnih rooms available</p>";
            }

            echo "
        </div>
        <div class=\"col-lg-6\">
        <h2 class=\"page-header\">Description: </h2>
            <p>$opis</p>
        </div>
        </div>
        
        <div class=\"row\">
        <div class=\"col-lg-12\">
            <h2 class=\"page-header\">Additional photos: </h2>
        </div>
    </div>
    <hr> ";

        }

        if (isset($_GET['selectedDate'])) {
            $idIzletPolazak = $_GET['polazak'];

            $upit = "SELECT vrijemePolazak, slobodnoMjesta FROM IZLET_POLAZAK WHERE idIzletPolazak = $idIzletPolazak";
            $rezultat = mysqli_query($veza, $upit) or die (mysqli_error($veza));
            $redak = mysqli_fetch_array($rezultat, MYSQLI_ASSOC);

            $vrijemePolazak = $redak['vrijemePolazak'];
            $slobodnoMjesta = $redak['slobodnoMjesta'];

            echo "<div class='col-md-6'>
                <p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Starting date and time:</b> $vrijemePolazak</p>
                <p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Available seats:</b> $slobodnoMjesta</p>";

            echo "<form class=\"form-horizontal\" action=\"reserveTour.php?value=$id&customerID=$customerID&polazak=$idIzletPolazak&selectedPeople=true\" method=\"post\">
        <div class=\"form-group\">
            <label for=\"number\" class=\"col-sm-2 control-label\">Number</label>
            <div class=\"col-sm-6\">
                <input name=\"number\" class=\"form-control\" id=\"number\" placeholder=\"Number of people - max. 4\" required=\"true\"> 
            </div>
        </div>

        <div class=\"form-group\">
            <div class=\"col-sm-offset-2 col-sm-10\">
                <button name=\"saveForm\" type=\"submit\" class=\"btn btn-success\">Continue</button>
            </div>
        </div>
    </form></div></div>";

            echo "<div class=\"row\">";

            echo "
        <div class=\"col-lg-6\">
            <h2 class=\"page-header\">Additional info: </h2>";

            if ($ukljucenVodic == 1) {
                $vodic = "<span class=\"glyphicon glyphicon-ok\"></span>";
            } else if ($ukljucenVodic == 2) {
                $vodic = "<span class=\"glyphicon glyphicon-remove\"></span>";
            }

            if ($ukljucenObrok == 1) {
                $obrok = "<span class=\"glyphicon glyphicon-ok\"></span>";
            } else if ($ukljucenObrok == 2) {
                $obrok = "<span class=\"glyphicon glyphicon-remove\"></span>";
            }

            if ($ukljuceneUlaznice == 1) {
                $ulaznice = "<span class=\"glyphicon glyphicon-ok\"></span>";
            } else if ($ukljuceneUlaznice == 2) {
                $ulaznice = "<span class=\"glyphicon glyphicon-remove\"></span>";
            }

            echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Duration:</b> $trajanje hours</p>";
            echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Price per person:</b> $cijenaPoOsobi €</p>";
            echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Tour Guide included:</b> $vodic</p>";
            echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Meal included:</b> $obrok</p>";
            echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>All tickets included:</b> $ulaznice</p>";
            echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Company name:</b> $nazivKompanije</p>";

            echo "
        </div>
        <div class=\"col-lg-6\">
        <h2 class=\"page-header\">Description: </h2>
            <p>$opis</p>
        </div>
        </div>
        
        <div class=\"row\">
        <div class=\"col-lg-12\">
            <h2 class=\"page-header\">Additional photos: </h2>
        </div>
    </div>
    <hr> ";

        }

        if (isset($_GET['selectedPeople'])) {
            if (isset($_POST['saveForm'])) {
                $number = $_POST['number'];
                $totalPrice = $number * $cijenaPoOsobi;
                $customerID = $_GET['customerID'];
                $idIzletPolazak = $_GET['polazak'];
                $idIzlet = $_GET['value'];

                $upit = "SELECT vrijemePolazak, slobodnoMjesta FROM IZLET_POLAZAK WHERE idIzletPolazak = $idIzletPolazak";
                $rezultat = mysqli_query($veza, $upit) or die (mysqli_error($veza));
                $redak = mysqli_fetch_array($rezultat, MYSQLI_ASSOC);

                $vrijemePolazak = $redak['vrijemePolazak'];


                echo "<div class='col-md-6'>
                <p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Starting date and time:</b> $vrijemePolazak</p>
                <p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Number of reserved seats:</b> $number</p>
                <p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Total price:</b> $totalPrice €</p><br>
                <p><b>If you wish to make a reservation press CONTINUE, otherwise press CANCEL.<b></b></p>
                <a style='margin-left: 120px; margin-top: 25px' class=\"btn btn-success\" href=\"./reserveTour.php?reserved=true&tourID=$idIzlet&number=$number&polazak=$idIzletPolazak&customerID=$customerID&totalPrice=$totalPrice\">Continue <span class=\"glyphicon glyphicon-chevron-right\"></span></a>
                <a style='margin-left: 20px; margin-top: 25px' class=\"btn btn-danger\" href=\"./learnMoreTour.php?value=$id\">Cancel <span class=\"glyphicon glyphicon-chevron-right\"></span></a></div>
                </div>
                ";

                echo "<div class=\"row\">";

                echo "
        <div class=\"col-lg-6\">
            <h2 class=\"page-header\">Additional info: </h2>";

                if ($ukljucenVodic == 1) {
                    $vodic = "<span class=\"glyphicon glyphicon-ok\"></span>";
                } else if ($ukljucenVodic == 2) {
                    $vodic = "<span class=\"glyphicon glyphicon-remove\"></span>";
                }

                if ($ukljucenObrok == 1) {
                    $obrok = "<span class=\"glyphicon glyphicon-ok\"></span>";
                } else if ($ukljucenObrok == 2) {
                    $obrok = "<span class=\"glyphicon glyphicon-remove\"></span>";
                }

                if ($ukljuceneUlaznice == 1) {
                    $ulaznice = "<span class=\"glyphicon glyphicon-ok\"></span>";
                } else if ($ukljuceneUlaznice == 2) {
                    $ulaznice = "<span class=\"glyphicon glyphicon-remove\"></span>";
                }

                echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Duration:</b> $trajanje hours</p>";
                echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Price per person:</b> $cijenaPoOsobi €</p>";
                echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Tour Guide included:</b> $vodic</p>";
                echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Meal included:</b> $obrok</p>";
                echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>All tickets included:</b> $ulaznice</p>";
                echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Company name:</b> $nazivKompanije</p>";

                echo "
        </div>
        <div class=\"col-lg-6\">
        <h2 class=\"page-header\">Description: </h2>
            <p>$opis</p>
        </div>
        </div>
        
        <div class=\"row\">
        <div class=\"col-lg-12\">
            <h2 class=\"page-header\">Additional photos: </h2>
        </div>
    </div>
    <hr> ";
            }
        }
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