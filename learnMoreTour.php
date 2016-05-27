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

    <title>Tourist Agency - Saznajte više o izletima</title>
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



    $upit = "SELECT idIzlet, naziv, opis, trajanje, cijenaPoOsobi, ukljucenVodic, ukljucenObrok, ukljuceneUlaznice, nazivKompanije, idLokacija, idAkcija FROM izlet WHERE idIzlet = $id";
    $rezultat = mysqli_query($veza, $upit) or die ("1" . mysqli_error($veza));

    $redak = mysqli_fetch_array($rezultat, MYSQLI_ASSOC);

    $opis = $redak['opis'];
    $naziv = $redak['naziv'];
    $trajanje = $redak['trajanje'];
    $cijenaPoOsobi = $redak['cijenaPoOsobi'];
    $ukljucenVodic = $redak['ukljucenVodic'];
    $ukljucenObrok = $redak['ukljucenObrok'];
    $ukljuceneUlaznice = $redak['ukljuceneUlaznice'];
    $nazivKompanije = $redak['nazivKompanije'];
    $idLokacija = $redak['idLokacija'];
    $idAkcija = $redak['idAkcija'];

    $upit5 = "SELECT idSlika FROM slike_izlet WHERE idIzlet = $id";
    $rezultat5 = mysqli_query($veza, $upit5) or die ("2" . mysqli_error($veza));
    $redak5 = mysqli_fetch_array($rezultat5, MYSQLI_ASSOC);
    $idSlika = $redak5['idSlika'];

    $upit5 = "SELECT url FROM slika WHERE idSlika = $idSlika";
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
                
                <div class=\"col-md-6\">
            <h2>Opis: </h2>
            <p>$opis</p>
            
            <p>
            <a style='margin-left: 160px; margin-top: 25px' class=\"btn btn-success\" href=\"./addTourCustomer.php?value=$id\">Rezervirajte mjesto <span class=\"glyphicon glyphicon-chevron-right\"></span></a>
</p>
        </div>";


        echo "</div>";

        echo "<div class=\"row\">";

        echo "
        <div class=\"col-lg-6\">
            <h2 class=\"page-header\">Dodatne informacije: </h2>";

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

        echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Trajanje:</b> $trajanje sati</p>";
        echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Cijena po osobi:</b> $cijenaPoOsobi €</p>";
        echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Vodič uključen u cijenu:</b> $vodic</p>";
        echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Obrok uključen u cijenu:</b> $obrok</p>";
        echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Sve ulaznice uključene u cijenu:</b> $ulaznice</p>";
        echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Naziv kompanije:</b> $nazivKompanije</p>";

    $upit6 = "SELECT idAkcija FROM izlet WHERE idIzlet = $id";
    $rezultat6 = mysqli_query($veza, $upit6) or die (mysqli_error($veza));
    $redak6 = mysqli_fetch_array($rezultat6, MYSQLI_ASSOC);
    $idAkcija = $redak6['idAkcija'];

    if (sizeof($redak6['idAkcija']) != 0) {
        $idAkcija = $redak6['idAkcija'];

        $upit6 = "SELECT popust FROM akcija WHERE idAkcija = $idAkcija";
        $rezultat6 = mysqli_query($veza, $upit6) or die (mysqli_error($veza));
        $redak6 = mysqli_fetch_array($rezultat6, MYSQLI_ASSOC);

        $popust = 100 - $redak6['popust'] * 100;

        echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> <span style='color: limegreen;'> Popust: $popust %</span></p>";

    }

    echo "</div>
        
        <div class=\"col-lg-6\">
            <h2 class='page-header'>Vrijeme polaska:</h2>";

            $upit = "SELECT vrijemePolazak, slobodnoMjesta FROM izlet_polazak WHERE idIzlet = $id";
            $rezultat = mysqli_query($veza, $upit) or die ("1" . mysqli_error($veza));

            while ($redak = mysqli_fetch_array($rezultat, MYSQLI_ASSOC)) {
                $vrijemePolaska = $redak['vrijemePolazak'];
                $slobodnoMjesta = $redak['slobodnoMjesta'];
                echo "<p><i class=\"glyphicon glyphicon-triangle-right\" aria-hidden=\"true\"></i> $vrijemePolaska, $slobodnoMjesta mjesta dostupno</p>";
            }

            echo "
        </div>
        </div>";

    echo "<div class=\"row\">
        <div class=\"col-lg-12\">
            <h2 class=\"page-header\">Dodatne slike: </h2>";
            $upit2 = "SELECT idSlika FROM slike_izlet WHERE idIzlet = $id";
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
