<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        div img {
            height:  = 100%;
            max-height: 400px;
            width = 1200px;
            border: 2px solid ghostwhite;
            border-radius: 50px;
        }

        .nova {
            height:  = 100%;
            max-height: 400px;
            width = 300px;
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

    <title>Tourist Agency - Learn More About Accomodations</title>
    <link rel="icon" href="./images/holiday.jpg">

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
            <a class="navbar-brand" href="./index.php">TRAVEL TIME</a>
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

    $id = $_GET['value'];



    $upit = "SELECT idSmjestaj, tip, opis, adresa, klasifikacija, idLokacija, idAkcija FROM smjestaj WHERE idSmjestaj = $id";
    $rezultat = mysqli_query($veza, $upit) or die ("1" . mysqli_error($veza));

    $redak = mysqli_fetch_array($rezultat, MYSQLI_ASSOC);

    $idLokacija = $redak['idLokacija'];
    $opis = $redak['opis'];
    $adresa = $redak['adresa'];
    $klasifikacija = $redak['klasifikacija'];
    $idAkcija = $redak['idAkcija'];

    $upit5 = "SELECT idSlika FROM slike_smjestaj WHERE idSmjestaj = $id";
    $rezultat5 = mysqli_query($veza, $upit5) or die ("2" . mysqli_error($veza));
    $redak5 = mysqli_fetch_array($rezultat5, MYSQLI_ASSOC);
    $idSlika = $redak5['idSlika'];

    $upit5 = "SELECT url FROM slika WHERE idSlika = $idSlika";
    $rezultat5 = mysqli_query($veza, $upit5) or die ("3" .   mysqli_error($veza));
    $redak5 = mysqli_fetch_array($rezultat5, MYSQLI_ASSOC);
    $url = $redak5['url'];

    if ($redak['tip'] == 1) {
        $tip = "Hotel";

        $upit2 = "SELECT naziv, kapacitetHotela, brojObroka FROM hotel WHERE idSmjestaj = $id";
        $rezultat2 = mysqli_query($veza, $upit2) or die (mysqli_error($veza));
        $redak2 = mysqli_fetch_array($rezultat2, MYSQLI_ASSOC);

        $ime = $redak2['naziv'];
        $kapacitet = $redak2['kapacitetHotela'];
        $brojObroka = $redak2['brojObroka'];

        $upit7 = "SELECT ime FROM lokacija WHERE idLokacija = $idLokacija";
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
                
                <div class=\"col-md-6\">
            <h2>Description: </h2>
            <p>$opis</p>
            
            <p>
            <a style='margin-left: 160px; margin-top: 25px' class=\"btn btn-success\" href=\"./addAccomodationCustomer.php?accomodationID=$id&type=Hotel\">Book your room<span class=\"glyphicon glyphicon-chevron-right\"></span></a>
</p>
        </div>";


        echo "</div>";

        echo "<div class=\"row\">";


        $upit6 = "SELECT idSadrzaj FROM hotel_nudi WHERE idSmjestaj = $id";
        $rezultat6 = mysqli_query($veza, $upit6) or die (mysqli_error($veza));

        echo "
        <div class=\"col-lg-4\">
            <h2 class=\"page-header\">Hotel offers: </h2>";

        while ($redak6 = mysqli_fetch_array($rezultat6, MYSQLI_ASSOC)) {
            $idSadrzaj = $redak6['idSadrzaj'];

            $upit7 = "SELECT naziv FROM sadrzaj WHERE idSadrzaj = $idSadrzaj";
            $rezultat7 = mysqli_query($veza, $upit7) or die (mysqli_error($veza));
            $redak7 = mysqli_fetch_array($rezultat7, MYSQLI_ASSOC);

            $sadrzaj = $redak7['naziv'];

            echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> $sadrzaj</p>";
        }

        echo "
        </div>";

        $upit6 = "SELECT SUM(brojSlobodnih) AS slobodne FROM soba WHERE idSmjestaj = $id";
        $rezultat6 = mysqli_query($veza, $upit6) or die (mysqli_error($veza));
        $redak6 = mysqli_fetch_array($rezultat6, MYSQLI_ASSOC);

        $kapacitet = $redak6['slobodne'];

        echo "<div class=\"col-lg-4\">
            <h2 class=\"page-header\">Additional info: </h2>
            <p><span class=\"glyphicon glyphicon-triangle-right\"></span> Hotel capacity: $kapacitet rooms</p>
            <p><span class=\"glyphicon glyphicon-triangle-right\"></span> Number of meals: $brojObroka</p>";

        $upit6 = "SELECT idAkcija FROM smjestaj WHERE idSmjestaj = $id";
        $rezultat6 = mysqli_query($veza, $upit6) or die (mysqli_error($veza));
        $redak6 = mysqli_fetch_array($rezultat6, MYSQLI_ASSOC);
        $idAkcija = $redak6['idAkcija'];

        if (sizeof($redak6['idAkcija']) != 0) {
            $idAkcija = $redak6['idAkcija'];

            $upit6 = "SELECT popust FROM akcija WHERE idAkcija = $idAkcija";
            $rezultat6 = mysqli_query($veza, $upit6) or die (mysqli_error($veza));
            $redak6 = mysqli_fetch_array($rezultat6, MYSQLI_ASSOC);

            $popust = 100 - $redak6['popust'] * 100;

            echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> <span style='color: limegreen;'> Discount: $popust %</span></p>";

        }

        echo "</div>
            ";

        $upit6 = "SELECT tip, cijenaPoDanu FROM soba WHERE idSmjestaj = $id ORDER BY cijenaPoDanu DESC";
        $rezultat6 = mysqli_query($veza, $upit6) or die (mysqli_error($veza));

        echo "
        <div class=\"col-lg-4\">
            <h2 class=\"page-header\">Room types: </h2>";

        while ($redak6 = mysqli_fetch_array($rezultat6, MYSQLI_ASSOC)) {
            $roomType = $redak6['tip'];
            $cijenaPoDanu = $redak6['cijenaPoDanu'];

            echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> $roomType, $cijenaPoDanu € per night</p>";
        }

        echo " </div>";

        echo "<div class=\"row\">
        <div class=\"col-lg-12\">
            <h2 class=\"page-header\">Additional photos: </h2>";
            $upit2 = "SELECT idSlika FROM slike_smjestaj WHERE idSMJESTAJ = $id";
            $rezultat2 = mysqli_query($veza, $upit2) or die (mysqli_error($veza));

            $i = 0;
            while ($redak2 = mysqli_fetch_array($rezultat2, MYSQLI_ASSOC)) {
                if ($i == 0) {
                    $i++;
                    continue;
                }

                $idSlika = $redak2['idSlika'];
                $upit3 = "SELECT url FROM slika WHERE idSlika = $idSlika";
                $rezultat3 = mysqli_query($veza, $upit3) or die (mysqli_error($veza));
                $redak3 = mysqli_fetch_array($rezultat3, MYSQLI_ASSOC);
                $url = $redak3['url'];

                echo "<div class=\"col-lg-4\">
                    <a href=\"#\">
        <img class=\"img-responsive nova2\" src = \"./images/$url\" alt=\"\" >
                    </a >
                </div >";
            }



            echo "</div>
    </div>
    <hr>";

    } else {
        $tip = "Apartman";

        $upit2 = "SELECT naziv, brojOsoba, cijenaPoDanu, brojSoba FROM apartman WHERE idSmjestaj = $id";
        $rezultat2 = mysqli_query($veza, $upit2) or die (mysqli_error($veza));
        $redak2 = mysqli_fetch_array($rezultat2, MYSQLI_ASSOC);

        $ime = $redak2['naziv'];
        $brojOsoba = $redak2['brojOsoba'];
        $brojSoba = $redak2['brojSoba'];
        $cijenaPoDanu = $redak2['cijenaPoDanu'];

        $upit7 = "SELECT ime FROM lokacija WHERE idLokacija = $idLokacija";
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
                
                <div class=\"col-md-6\">
            <h2>Description: </h2>
            <p>$opis</p>
            
            <p>
            <a style='margin-left: 160px; margin-top: 25px' class=\"btn btn-success\" href=\"./addAccomodationCustomer.php?accomodationID=$id&type=Apartment\">Reserve your room<span class=\"glyphicon glyphicon-chevron-right\"></span></a>
</p>
        </div></div>";

        echo "<div class=\"row\">
        <div class=\"col-lg-6\">
            <h2 class=\"page-header\">Additional information: </h2>
            <p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Number of rooms:</b> $brojSoba</p>
            <p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Max. people per room:</b> $brojOsoba </p>
            <p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Price per day:</b> $cijenaPoDanu </p>";

        $upit6 = "SELECT idAkcija FROM smjestaj WHERE idSmjestaj = $id";
        $rezultat6 = mysqli_query($veza, $upit6) or die (mysqli_error($veza));
        $redak6 = mysqli_fetch_array($rezultat6, MYSQLI_ASSOC);
        $idAkcija = $redak6['idAkcija'];

        if (sizeof($redak6['idAkcija']) != 0) {
            $idAkcija = $redak6['idAkcija'];

            $upit6 = "SELECT popust FROM akcija WHERE idAkcija = $idAkcija";
            $rezultat6 = mysqli_query($veza, $upit6) or die (mysqli_error($veza));
            $redak6 = mysqli_fetch_array($rezultat6, MYSQLI_ASSOC);

            $popust = 100 - $redak6['popust'] * 100;

            echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> <span style='color: limegreen;'> Discount: $popust %</span></p>";

        }

        echo "</div></div>
            ";

        echo "<div class=\"row\">
        <div class=\"col-lg-12\">
            <h2 class=\"page-header\">Additional photos: </h2>";
            $upit2 = "SELECT idSlika FROM slike_smjestaj WHERE idSMJESTAJ = $id";
            $rezultat2 = mysqli_query($veza, $upit2) or die (mysqli_error($veza));

            $i = 0;
            while ($redak2 = mysqli_fetch_array($rezultat2, MYSQLI_ASSOC)) {
                if ($i == 0) {
                    $i++;
                    continue;
                }

                $idSlika = $redak2['idSlika'];
                $upit3 = "SELECT url FROM slika WHERE idSlika = $idSlika";
                $rezultat3 = mysqli_query($veza, $upit3) or die (mysqli_error($veza));
                $redak3 = mysqli_fetch_array($rezultat3, MYSQLI_ASSOC);
                $url = $redak3['url'];

                echo "<div class=\"col-lg-4\">
                    <a href=\"#\">
        <img class=\"img-responsive nova2\" src = \"./images/$url\" alt=\"\" >
                    </a >
                </div >";
            }



            echo "</div>
    </div>
    <hr>";
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
