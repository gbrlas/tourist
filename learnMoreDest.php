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
             height: 100%;
             max-height: 180px;
             width = 300px;
             border: 2px solid ghostwhite;
             border-radius: 50px;
         }

        .nova2 {
            height: 100%;
            max-height: 300px;
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

    <title>Tourist Agency - Saznajte više o destinaciji</title>
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
                    <a href="./destinations.php?type=summer&page=1">LJETOVANJA</a>
                </li>
                <li>
                    <a href="./destinations.php?type=winter&page=1">ZIMSKE IDILE</a>
                </li>
                <li>
                    <a href="./destinations.php?type=cities&page=1">GRADSKI ODMORI</a>
                </li>
                <li>
                    <a href="./tours.php?page=1">IZLETI</a>
                </li>
                <li>
                    <a href="./accomodations.php">SMJEŠTAJI</a>
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

    $upit2 = "UPDATE lokacija SET pregledi = pregledi + 1 WHERE idLokacija = $id";
    mysqli_query($veza, $upit2) or die ("2" . mysqli_error($veza));



    $upit = "SELECT idLokacija, ime, opis, tip, idDrzava FROM lokacija WHERE idLokacija = $id";
    $rezultat = mysqli_query($veza, $upit) or die ("1" . mysqli_error($veza));

    $redak = mysqli_fetch_array($rezultat, MYSQLI_ASSOC);

    $lokacija = $redak['idLokacija'];
    $ime = $redak['ime'];
    $opis = $redak['opis'];
    $tip = $redak['tip'];



    echo "<div class=\"row\">
        <div class=\"col-lg-12\">
            <h2 class=\"page-header\">$ime</h2>
        </div>
    </div>";

    $upit2 = "SELECT idSlika FROM slike_lokacija WHERE idLokacija = $id";
    $rezultat2 = mysqli_query($veza, $upit2) or die ("2" . mysqli_error($veza));
    $redak2 = mysqli_fetch_array($rezultat2, MYSQLI_ASSOC);
    $idSlika = $redak2['idSlika'];

    $upit3 = "SELECT url FROM slika WHERE idSlika = $idSlika";
    $rezultat3 = mysqli_query($veza, $upit3) or die ("3" .   mysqli_error($veza));
    $redak3 = mysqli_fetch_array($rezultat3, MYSQLI_ASSOC);
    $url = $redak3['url'];

    echo "<div class=\"row\">";
    echo "        
            <div class=\"col-md-2\"></div>
                <div class=\"col-md-8\">
                    <a href=\"#\">
                        <img class=\"img-responsive\" src=\"./images/$url\" width=\"1200\" height=\"400\" alt=\"\">
                    </a>
                </div>
                <div class=\"col-md-2\"></div>";

    echo "</div>";


    echo "<div class=\"row\">
        <div class=\"col-lg-12\">
            <h2 class=\"page-header\">Opis: </h2>
            <p>$opis</p>
        </div>
    </div>";

    $upit = "SELECT idSmjestaj, tip, opis, adresa, klasifikacija, idLokacija, idAkcija FROM smjestaj WHERE $lokacija = idLokacija ORDER BY tip ASC";
    $rezultat = mysqli_query($veza, $upit) or die (mysqli_error($veza));

    $i = 0;

    echo "<div class=\"row\">
        <div class=\"col-lg-12\">
            <h2 class=\"page-header\">Dostupni smještaji: </h2>
        </div>
    </div>";

    while ($redak = mysqli_fetch_array($rezultat, MYSQLI_ASSOC)) {
        $idSmjestaj = $redak['idSmjestaj'];
        $tip;
        if ($i % 2 == 0) {
            echo "<div class=\"row\">";
        }
        if ($redak['tip'] == 1) {
            $tip = "Hotel";

            $upit2 = "SELECT naziv, kapacitetHotela, brojObroka FROM hotel WHERE idSmjestaj = $idSmjestaj ORDER BY naziv ASC";
            $rezultat2 = mysqli_query($veza, $upit2) or die (mysqli_error($veza));
            $redak2 = mysqli_fetch_array($rezultat2, MYSQLI_ASSOC);

            $ime = $redak2['naziv'];
            $klasifikacija = $redak['klasifikacija'];
        } else {
            $tip = "Apartman";

            $upit2 = "SELECT naziv, brojOsoba, cijenaPoDanu FROM apartman WHERE idSmjestaj = $idSmjestaj ORDER BY naziv ASC";
            $rezultat2 = mysqli_query($veza, $upit2) or die (mysqli_error($veza));
            $redak2 = mysqli_fetch_array($rezultat2, MYSQLI_ASSOC);

            $ime = $redak2['naziv'];
            $klasifikacija = $redak['klasifikacija'];
        }

        $upit5 = "SELECT idSlika FROM slike_smjestaj WHERE idSmjestaj = $idSmjestaj";
        $rezultat5 = mysqli_query($veza, $upit5) or die ("2" . mysqli_error($veza));
        $redak5 = mysqli_fetch_array($rezultat5, MYSQLI_ASSOC);
        $idSlika = $redak5['idSlika'];

        $upit5 = "SELECT url FROM slika WHERE idSlika = $idSlika";
        $rezultat5 = mysqli_query($veza, $upit5) or die ("3" .   mysqli_error($veza));
        $redak5 = mysqli_fetch_array($rezultat5, MYSQLI_ASSOC);
        $url = $redak5['url'];

        echo "
                    <div class=\"col-md-3\">
                    <a href=\"#\">
                <img class=\"img-responsive nova\" src=\"./images/$url\" width =\"200\" max-height =\"100\" alt =\"\">
                    </a>
                </div>
                <div class=\"col-md-3\">
                    <h3>$ime</h3>
                        <p>Tip: $tip</p>
                        <p>Ocjena: ";

                for ($j = 0; $j < $klasifikacija; $j++) {
                    echo "<span class=\"glyphicon glyphicon-star\"></span>";
                }

                echo "</p>
                    <a class=\"btn btn-primary\" href=\"./learnMoreAccomodation.php?value=$idSmjestaj\">Saznajte više <span class=\"glyphicon glyphicon-chevron-right\"></span></a>
               </div>";

        $i++;

        if ($i % 2 == 0) {
            echo "</div>";
            echo "<hr>";
        }

    }

    echo "<div class=\"row\">
        <div class=\"col-lg-12\">
            <h2 class=\"page-header\">Dodatne slike: </h2>";

    $upit2 = "SELECT idSlika FROM slike_lokacija WHERE idLokacija = $id";
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
