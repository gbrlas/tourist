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
        $hotelID = $_GET['hotelID'];
        $number = $_GET['number'];
        $date = $_GET['date'];
        $customerID = $_GET['customerID'];
        $totalPrice = $_GET['totalPrice'];
        $tipRezervacije = 1;
        $roomID = $_GET['roomID'];

        $upit = "INSERT INTO smjestaj_rezervacija (tipRezervacije, idRezervirano, datumOd, brojDana, ukupnaCijena, idSmjestaj, idKupac) VALUES (1, $roomID, '$date', $number, $totalPrice, $hotelID, $customerID)";
        mysqli_query ($veza, $upit) or die ("1" . mysqli_error($veza));

        $upit = "SELECT brojSlobodnih FROM soba WHERE idSoba = $roomID";
        $rezultat = mysqli_query ($veza, $upit) or die ("2" . mysqli_error($veza));
        $redak = mysqli_fetch_array($rezultat, MYSQLI_ASSOC);

        $brojSlobodnih = $redak['brojSlobodnih'];
        $test = true;

        for ($i = 0; $i < $number; $i++) {
            $upit = "SELECT idSobaRezervacija FROM soba_rezervacija WHERE idSoba = $roomID AND datum = DATE(DATE_ADD('$date', INTERVAL $i DAY))";
            $rezultat = mysqli_query ($veza, $upit) or die ("3" . mysqli_error($veza));
            $redak = mysqli_fetch_array($rezultat, MYSQLI_ASSOC);

            if (mysqli_num_rows($rezultat) == 0) {
                $num = $brojSlobodnih - 1;
                $upit2 = "INSERT INTO soba_rezervacija (idSoba, datum, slobodno) VALUES ($roomID, DATE(DATE_ADD('$date', INTERVAL $i DAY)), $num)";
                mysqli_query ($veza, $upit2) or die ("4" . mysqli_error($veza));
            } else {
                $upit3 = "SELECT slobodno FROM soba_rezervacija WHERE idSoba = $roomID AND datum = DATE(DATE_ADD('$date', INTERVAL $i DAY))";
                $rezultat3 = mysqli_query ($veza, $upit3) or die ("3" . mysqli_error($veza));
                $redak3 = mysqli_fetch_array($rezultat3, MYSQLI_ASSOC);

                $temp = $redak3['slobodno'];

                if ($temp - 1 == 0) {
                    $test = false;
                    break;
                }

                $upit2 = "UPDATE soba_rezervacija SET slobodno = slobodno - 1 WHERE idSoba = $roomID AND datum = DATE(DATE_ADD('$date', INTERVAL $i DAY))";
                mysqli_query ($veza, $upit2) or die ("5" . mysqli_error($veza));
            }
        }

        if ($test) {
            echo "<div class=\"row\">
                    <div class=\"col-md-6\">
                        <h4 style='color: limegreen'>Room successfully reserved.</h4>
                        <br>
                        <h4>Please press the button below to return to the hotel page: </h4><br></div></div>";

            echo "<div class=\"row\">
                        <div class=\"col-md-6\">
                        <a class=\"btn btn-success\" href=\"./learnMoreAccomodation.php?value=$hotelID\">Continue <span class=\"glyphicon glyphicon-chevron-right\"></span></a>
                   </div></div>";
        } else {
            echo "<div class=\"row\">
                    <div class=\"col-md-6\">
                        <h4 style='color: red'>No available rooms of that type during selected period.</h4>
                        <br>
                        <h4>Please press the button below to return to the hotel page and try another room type or date: </h4><br></div></div>";

            echo "<div class=\"row\">
                        <div class=\"col-md-6\">
                        <a class=\"btn btn-success\" href=\"./learnMoreAccomodation.php?value=$hotelID\">Continue <span class=\"glyphicon glyphicon-chevron-right\"></span></a>
                   </div></div>";
        }




    } else {
        $id = $_GET['value'];
        $customerID = $_GET['customerID'];

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

        $upit2 = "SELECT naziv, kapacitetHotela, brojObroka FROM HOTEL WHERE idSmjestaj = $id";
        $rezultat2 = mysqli_query($veza, $upit2) or die (mysqli_error($veza));
        $redak2 = mysqli_fetch_array($rezultat2, MYSQLI_ASSOC);

        $ime = $redak2['naziv'];
        $kapacitet = $redak2['kapacitetHotela'];
        $brojObroka = $redak2['brojObroka'];

        $upit7 = "SELECT ime FROM LOKACIJA WHERE idLokacija = $idLokacija";
        $rezultat7 = mysqli_query($veza, $upit7) or die ("3" .   mysqli_error($veza));
        $redak7 = mysqli_fetch_array($rezultat7, MYSQLI_ASSOC);
        $imeLokacije = $redak7['ime'];


        echo "<div class=\"row\">
        <div class=\"col-lg-12\">
            <h2 class=\"page-header\">$ime, <a href=\"./learnMoreDest.php?value=$idLokacija\">$imeLokacije</a></h2>
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
            echo "<div class='col-md-6'>
            <form class=\"form-horizontal\" action=\"reserveHotel.php?value=$id&customerID=$customerID&selectedDate=true\" method=\"post\">
        <div class=\"form-group\">
            <label style='margin-top: 15px;'  for=\"date\" class=\"col-sm-2 control-label\">Date</label>
            <div style='margin-top: 15px;' class=\"col-sm-6\">
                <input name=\"date\" class=\"form-control\" id=\"date\" placeholder=\"yyyy-mm-dd\" required=\"true\"> 
            </div>
        </div>
        
        <div class=\"form-group\">
            <label for=\"number\" class=\"col-sm-2 control-label\">Days</label>
            <div class=\"col-sm-6\">
                <input name=\"number\" class=\"form-control\" id=\"number\" placeholder=\"Number of days - max. 10\" required=\"true\"> 
            </div>
        </div>
        
        <div class=\"form-group\">
            <label for=\"people\" class=\"col-sm-2 control-label\">People</label>
            <div class=\"col-sm-6\">
                <input name=\"people\" class=\"form-control\" id=\"people\" placeholder=\"Number of people - max. 4\" required=\"true\"> 
            </div>
        </div>

        <div class=\"form-group\">
            <div class=\"col-sm-offset-2 col-sm-10\">
                <button name=\"saveForm\" type=\"submit\" class=\"btn btn-success\">Continue</button>
            </div>
        </div>
    </form></div>";

            echo "
</div>";

            echo "<div class=\"row\">";

            echo "
        <div class=\"col-lg-6\">
        <h2 class=\"page-header\">Description: </h2>
            <p>$opis</p>
        </div>";

            echo "
        <div class=\"col-lg-3\">
            <h2 class=\"page-header\">Hotel offers: </h2>";

            $upit6 = "SELECT idSadrzaj FROM HOTEL_NUDI WHERE idSmjestaj = $id";
            $rezultat6 = mysqli_query($veza, $upit6) or die (mysqli_error($veza));

            while ($redak6 = mysqli_fetch_array($rezultat6, MYSQLI_ASSOC)) {
                $idSadrzaj = $redak6['idSadrzaj'];

                $upit7 = "SELECT naziv FROM SADRZAJ WHERE idSadrzaj = $idSadrzaj";
                $rezultat7 = mysqli_query($veza, $upit7) or die (mysqli_error($veza));
                $redak7 = mysqli_fetch_array($rezultat7, MYSQLI_ASSOC);

                $sadrzaj = $redak7['naziv'];

                echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> $sadrzaj</p>";
            }

            $upit6 = "SELECT SUM(brojSlobodnih) AS slobodne FROM SOBA WHERE idSmjestaj = $id";
            $rezultat6 = mysqli_query($veza, $upit6) or die (mysqli_error($veza));
            $redak6 = mysqli_fetch_array($rezultat6, MYSQLI_ASSOC);

            $kapacitet = $redak6['slobodne'];

            echo "
        </div><div class=\"col-lg-3\">
            <h2 class=\"page-header\">Additional info: </h2>
            <p><span class=\"glyphicon glyphicon-triangle-right\"></span> Hotel capacity: $kapacitet rooms</p>
            <p><span class=\"glyphicon glyphicon-triangle-right\"></span> Number of meals: $brojObroka</p></div>";
            echo "
        
        </div>
        
        <div class=\"row\">
        <div class=\"col-lg-12\">
            <h2 class=\"page-header\">Additional photos: </h2>
        </div>
    </div>
    <hr> ";
        }

        if (isset($_GET['selectedRoom'])) {
            $number = $_GET['number'];
            $startingDate = $_GET['date'];
            $roomID = $_GET['idSoba'];
            $hotelID = $_GET['value'];
            $people = $_GET['people'];


            $upit7 = "SELECT cijenaPoDanu FROM SOBA WHERE idSoba = $roomID";
            $rezultat7 = mysqli_query($veza, $upit7) or die (mysqli_error($veza));
            $redak7 = mysqli_fetch_array($rezultat7, MYSQLI_ASSOC);
            $cijenaPoOsobi = $redak7['cijenaPoDanu'];
            $totalPrice = $number * $cijenaPoOsobi;


            $upit = "SELECT tip, brojSlobodnih FROM SOBA WHERE idSoba = $roomID";
            $rezultat = mysqli_query($veza, $upit) or die (mysqli_error($veza));
            $redak = mysqli_fetch_array($rezultat, MYSQLI_ASSOC);
            $tipSobe = $redak['tip'];
            $brojSlobodnih = $redak['brojSlobodnih'];


            echo "<div class='col-md-6'>
                <p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Selected room type:</b> $tipSobe</p>
                <p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Starting date:</b> $startingDate</p>
                <p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Number of days:</b> $number</p>
                <p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Number of people:</b> $people</p>
                <p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Total price:</b> $totalPrice €</p><br>
                <p><b>If you wish to make a reservation press CONTINUE, otherwise press CANCEL.</b></p>
                <a style='margin-left: 120px; margin-top: 25px' class=\"btn btn-success\" href=\"./reserveHotel.php?reserved=true&hotelID=$hotelID&number=$number&date=$startingDate&customerID=$customerID&totalPrice=$totalPrice&roomID=$roomID\">Continue <span class=\"glyphicon glyphicon-chevron-right\"></span></a>
                <a style='margin-left: 20px; margin-top: 25px' class=\"btn btn-danger\" href=\"./learnMoreAccomodation.php?value=$hotelID\">Cancel <span class=\"glyphicon glyphicon-chevron-right\"></span></a></div>
                </div>";
            echo "<div class=\"row\">";
            echo "
        <div class=\"col-lg-6\">
        <h2 class=\"page-header\">Description: </h2>
            <p>$opis</p>
        </div>";
            echo "
        <div class=\"col-lg-3\">
            <h2 class=\"page-header\">Hotel offers: </h2>";
            $upit6 = "SELECT idSadrzaj FROM HOTEL_NUDI WHERE idSmjestaj = $id";
            $rezultat6 = mysqli_query($veza, $upit6) or die (mysqli_error($veza));
            while ($redak6 = mysqli_fetch_array($rezultat6, MYSQLI_ASSOC)) {
                $idSadrzaj = $redak6['idSadrzaj'];
                $upit7 = "SELECT naziv FROM SADRZAJ WHERE idSadrzaj = $idSadrzaj";
                $rezultat7 = mysqli_query($veza, $upit7) or die (mysqli_error($veza));
                $redak7 = mysqli_fetch_array($rezultat7, MYSQLI_ASSOC);
                $sadrzaj = $redak7['naziv'];
                echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> $sadrzaj</p>";
            }
            $upit6 = "SELECT SUM(brojSlobodnih) AS slobodne FROM SOBA WHERE idSmjestaj = $id";
            $rezultat6 = mysqli_query($veza, $upit6) or die (mysqli_error($veza));
            $redak6 = mysqli_fetch_array($rezultat6, MYSQLI_ASSOC);
            $kapacitet = $redak6['slobodne'];
            echo "
        </div><div class=\"col-lg-3\">
            <h2 class=\"page-header\">Additional info: </h2>
            <p><span class=\"glyphicon glyphicon-triangle-right\"></span> Hotel capacity: $kapacitet rooms</p>
            <p><span class=\"glyphicon glyphicon-triangle-right\"></span> Number of meals: $brojObroka</p></div>";
            echo "
        
        </div>
        
        <div class=\"row\">
        <div class=\"col-lg-12\">
            <h2 class=\"page-header\">Additional photos: </h2>
        </div>
    </div>
    <hr> ";
        }

        if (isset($_GET['selectedDate'])) {
            if (isset($_POST['saveForm'])) {
                $number = $_POST['number'];
                $startingDate = $_POST['date'];
                $people = $_POST['people'];
                $hotelID = $_GET['value'];

                echo "<div class='col-md-6' align='center'> <div class=\"dropdown\">
            <button style='margin-top: 100px;' class=\"btn btn-primary dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">
  Select preferred room type</button>
  <ul style='margin-left: 179px;' class=\"dropdown-menu\">";

                $upit = "SELECT idSoba, tip, cijenaPoDanu, brojOsoba FROM SOBA WHERE idSmjestaj = $id AND brojOsoba >= $people ORDER BY cijenaPoDanu ASC";
                $rezultat = mysqli_query($veza, $upit) or die (mysqli_error($veza));

                while ($redak = mysqli_fetch_array($rezultat, MYSQLI_ASSOC)) {
                    $idSoba = $redak['idSoba'];
                    $tipSobe = $redak['tip'];
                    $cijenaPoDanu = $redak['cijenaPoDanu'];
                    $brojOsoba = $redak['brojOsoba'];

                    $test = true;

                    for ($i = 0; $i < $number; $i++) {
                        $upit2 = "SELECT slobodno FROM soba_rezervacija WHERE idSoba = $idSoba";
                        $rezultat2 = mysqli_query($veza, $upit2) or die (mysqli_error($veza));
                        $redak2 = mysqli_fetch_array($rezultat2, MYSQLI_ASSOC);
                        $temp = $redak2['slobodno'];

                        if (mysqli_num_rows($rezultat2) == 0) {
                            continue;
                        } else if ($temp > 0) {
                            continue;
                        } else {
                            $test = false;
                            break;
                        }
                    }

                    if ($test) {
                        echo "<li><a href=\"reserveHotel.php?value=$id&customerID=$customerID&idSoba=$idSoba&number=$number&date=$startingDate&people=$people&selectedRoom=true\">$tipSobe, $cijenaPoDanu € per night, for $brojOsoba persons</a></li>";
                    }
                }

                echo "  </ul>
</div></div></div>";

                echo "<div class=\"row\">";

                echo "
        <div class=\"col-lg-6\">
        <h2 class=\"page-header\">Description: </h2>
            <p>$opis</p>
        </div>";

                echo "
        <div class=\"col-lg-3\">
            <h2 class=\"page-header\">Hotel offers: </h2>";

                $upit6 = "SELECT idSadrzaj FROM HOTEL_NUDI WHERE idSmjestaj = $id";
                $rezultat6 = mysqli_query($veza, $upit6) or die (mysqli_error($veza));

                while ($redak6 = mysqli_fetch_array($rezultat6, MYSQLI_ASSOC)) {
                    $idSadrzaj = $redak6['idSadrzaj'];

                    $upit7 = "SELECT naziv FROM SADRZAJ WHERE idSadrzaj = $idSadrzaj";
                    $rezultat7 = mysqli_query($veza, $upit7) or die (mysqli_error($veza));
                    $redak7 = mysqli_fetch_array($rezultat7, MYSQLI_ASSOC);

                    $sadrzaj = $redak7['naziv'];

                    echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> $sadrzaj</p>";
                }

                $upit6 = "SELECT SUM(brojSlobodnih) AS slobodne FROM SOBA WHERE idSmjestaj = $id";
                $rezultat6 = mysqli_query($veza, $upit6) or die (mysqli_error($veza));
                $redak6 = mysqli_fetch_array($rezultat6, MYSQLI_ASSOC);

                $kapacitet = $redak6['slobodne'];

                echo "
        </div><div class=\"col-lg-3\">
            <h2 class=\"page-header\">Additional info: </h2>
            <p><span class=\"glyphicon glyphicon-triangle-right\"></span> Hotel capacity: $kapacitet rooms</p>
            <p><span class=\"glyphicon glyphicon-triangle-right\"></span> Number of meals: $brojObroka</p></div>";
                echo "
        
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
