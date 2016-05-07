<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        div img {
            height:  = 100%;
            max-height: 200px;
            width = 300px;
            border: 2px solid ghostwhite;
            border-radius: 50px;
        }

        .nova {
            height:  = 100%;
            max-height: 180px;
            width = 300px;
            border: 2px solid ghostwhite;
            border-radius: 50px;
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
            <a class="navbar-brand" href="./index.php">Tourist Agency</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="./destinations.php?type=summer">Summer destinations</a>
                </li>
                <li>
                    <a href="./destinations.php?type=winter">Winter resorts</a>
                </li>
                <li>
                    <a href="./destinations.php?type=cities">City-breaks</a>
                </li>
                <li>
                    <a href="./tours.php">Tours</a>
                </li>
                <li>
                    <a href="./accomodations.php">Accomodations</a>
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
        if (!isset($_GET) || empty($_GET)) {
            echo "<div class=\"row\">
                <div class=\"col-lg-12\">
                    <h1 class=\"page-header\">Browse accomodations by location</h1>
                </div>
            </div>
            
            <div class=\"dropdown\">
            <button class=\"btn btn-primary dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">
  Select location</button>
  <ul class=\"dropdown-menu\">";
            include './admin/spajanje_na_bazu.php';
            include './admin/funkcije.php';

            $upit = "SELECT idLokacija, ime, tip FROM LOKACIJA ORDER BY ime ASC";
            $rezultat = mysqli_query($veza, $upit) or die (mysqli_error($veza));

            while ($redak = mysqli_fetch_array($rezultat, MYSQLI_ASSOC)) {
                $tip = $redak['tip'];

                if ($tip == 5) {
                    continue;
                }
                
                $lokacija = $redak['idLokacija'];
                $ime = $redak['ime'];
                echo "<li><a href=\"accomodations.php?value=$lokacija\">$ime</a></li>";
            }

            echo "  </ul>
</div>";
        } else {
            $lokacija = $_GET['value'];

            include './admin/spajanje_na_bazu.php';
            include './admin/funkcije.php';

            $upit = "SELECT idSmjestaj, tip, opis, adresa, klasifikacija, idLokacija, idAkcija FROM SMJESTAJ WHERE $lokacija = idLokacija ORDER BY tip ASC";
            $rezultat = mysqli_query($veza, $upit) or die (mysqli_error($veza));

            $num =  mysql_num_rows($rezultat);

            if ($num == 0) {
                echo "<div class=\"col-md-12\">
                    <h4>Unfortunately, there are no available accomodations for this location.</h4></div>";
            }

            $i = 0;

            while ($redak = mysqli_fetch_array($rezultat, MYSQLI_ASSOC)) {
                $idSmjestaj = $redak['idSmjestaj'];
                $tip;
                if ($i % 2 == 0) {
                    echo "<div class=\"row\">";
                }
                if ($redak['tip'] == 1) {
                    $tip = "Hotel";

                    $upit2 = "SELECT naziv, kapacitetHotela, brojObroka FROM HOTEL WHERE idSmjestaj = $idSmjestaj ORDER BY naziv ASC";
                    $rezultat2 = mysqli_query($veza, $upit2) or die (mysqli_error($veza));
                    $redak2 = mysqli_fetch_array($rezultat2, MYSQLI_ASSOC);

                    $ime = $redak2['naziv'];
                    $klasifikacija = $redak['klasifikacija'];
                } else {
                    $tip = "Apartman";

                    $upit2 = "SELECT naziv, brojOsoba, cijenaPoDanu FROM APARTMAN WHERE idSmjestaj = $idSmjestaj ORDER BY naziv ASC";
                    $rezultat2 = mysqli_query($veza, $upit2) or die (mysqli_error($veza));
                    $redak2 = mysqli_fetch_array($rezultat2, MYSQLI_ASSOC);

                    $ime = $redak2['naziv'];
                    $klasifikacija = $redak['klasifikacija'];
                }

                $upit5 = "SELECT idSlika FROM SLIKE_SMJESTAJ WHERE idSmjestaj = $idSmjestaj";
                $rezultat5 = mysqli_query($veza, $upit5) or die ("2" . mysqli_error($veza));
                $redak5 = mysqli_fetch_array($rezultat5, MYSQLI_ASSOC);
                $idSlika = $redak5['idSlika'];

                $upit5 = "SELECT url FROM SLIKA WHERE idSlika = $idSlika";
                $rezultat5 = mysqli_query($veza, $upit5) or die ("3" .   mysqli_error($veza));
                $redak5 = mysqli_fetch_array($rezultat5, MYSQLI_ASSOC);
                $url = $redak5['url'];

                echo "
                    <div class=\"col-md-3\">
                    <a href=\"#\">
                <img class=\"img-responsive nova\" src=\"$url\" width =\"300\" height =\"200\" alt =\"\">
                    </a>
                </div>
                <div class=\"col-md-3\">
                    <h3>$ime</h3>
                        <p>Type: $tip</p>
                        <p>Rating: ";

                for ($j = 0; $j < $klasifikacija; $j++) {
                    echo "<span class=\"glyphicon glyphicon-star\"></span>";
                }

                echo "</p>
                    <a class=\"btn btn-primary\" href=\"./learnMoreAccomodation.php?value=$idSmjestaj\">Learn more <span class=\"glyphicon glyphicon-chevron-right\"></span></a>
               </div>";

                $i++;

                if ($i % 2 == 0) {
                    echo "</div>";
                    echo "<hr>";
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
