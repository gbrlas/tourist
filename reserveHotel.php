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

    <title>Tourist Agency - Rezervirajte vašu sobu</title>
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
            $upit3 = "SELECT idSmjestajRezervacija FROM smjestaj_rezervacija WHERE tipRezervacije = 1 AND idRezervirano = $roomID AND datumOd = '$date' AND brojDana = $number AND ukupnaCijena = $totalPrice AND idSmjestaj = $hotelID AND idKupac = $customerID";
            $rezultat3 = mysqli_query ($veza, $upit3) or die ("3" . mysqli_error($veza));
            $redak3 = mysqli_fetch_array($rezultat3, MYSQLI_ASSOC);
            $id = $redak3['idSmjestajRezervacija'];

            echo "<div class=\"row\">
                    <div class=\"col-md-6\">
                        <h4 style='color: limegreen'>Soba je uspješno rezervirana. Vaš ID rezervacije je: <b>$id</b></h4>
                        <br>
                        <h4>Pritisnite gumb ispod za povratak na početnu stranicu hotela: </h4><br></div></div>";

            echo "<div class=\"row\">
                        <div class=\"col-md-6\">
                        <a class=\"btn btn-success\" href=\"./learnMoreAccomodation.php?value=$hotelID\">Nastavi <span class=\"glyphicon glyphicon-chevron-right\"></span></a>
                   </div></div>";
        } else {
            echo "<div class=\"row\">
                    <div class=\"col-md-6\">
                        <h4 style='color: red'>Nažalost, vaša rezervacija nije uspjela.</h4>
                        <br>
                        <h4>Molimo vas stisnite gumb ispod i pokušajte ponovno, ili odaberite drugi tip sobe: </h4><br></div></div>";

            echo "<div class=\"row\">
                        <div class=\"col-md-6\">
                        <a class=\"btn btn-success\" href=\"./learnMoreAccomodation.php?value=$hotelID\">Nastavi <span class=\"glyphicon glyphicon-chevron-right\"></span></a>
                   </div></div>";
        }




    } else {
        $id = $_GET['value'];
        $customerID = $_GET['customerID'];

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

        $upit7 = "SELECT MAX(brojOsoba) AS max FROM soba WHERE idSmjestaj = $id";
        $rezultat7 = mysqli_query($veza, $upit7) or die ("3" .   mysqli_error($veza));
        $redak7 = mysqli_fetch_array($rezultat7, MYSQLI_ASSOC);
        $max = $redak7['max'];


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
            <label style='margin-top: 15px;'  for=\"date\" class=\"col-sm-2 control-label\">Datum</label>
            <div style='margin-top: 15px;' class=\"col-sm-6\">
                <input name=\"date\" class=\"form-control\" id=\"date\" placeholder=\"gggg-mm-dd\" required=\"true\"> 
            </div>
        </div>
        
        <div class=\"form-group\">
            <label for=\"number\" class=\"col-sm-2 control-label\">Dani</label>
            <div class=\"col-sm-6\">
                <input name=\"number\" class=\"form-control\" id=\"number\" placeholder=\"Broj dana - max. 10\" required=\"true\"> 
            </div>
        </div>
        
        <div class=\"form-group\">
            <label for=\"people\" class=\"col-sm-2 control-label\">Osobe</label>
            <div class=\"col-sm-6\">
                <input name=\"people\" class=\"form-control\" id=\"people\" placeholder=\"Broj osoba - max. $max\" required=\"true\"> 
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
        <h2 class=\"page-header\">Opis: </h2>
            <p>$opis</p>
        </div>";

            echo "
        <div class=\"col-lg-3\">
            <h2 class=\"page-header\">Hotel nudi: </h2>";

            $upit6 = "SELECT idSadrzaj FROM hotel_nudi WHERE idSmjestaj = $id";
            $rezultat6 = mysqli_query($veza, $upit6) or die (mysqli_error($veza));

            while ($redak6 = mysqli_fetch_array($rezultat6, MYSQLI_ASSOC)) {
                $idSadrzaj = $redak6['idSadrzaj'];

                $upit7 = "SELECT naziv FROM sadrzaj WHERE idSadrzaj = $idSadrzaj";
                $rezultat7 = mysqli_query($veza, $upit7) or die (mysqli_error($veza));
                $redak7 = mysqli_fetch_array($rezultat7, MYSQLI_ASSOC);

                $sadrzaj = $redak7['naziv'];

                echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> $sadrzaj</p>";
            }

            $upit6 = "SELECT SUM(brojSlobodnih) AS slobodne FROM soba WHERE idSmjestaj = $id";
            $rezultat6 = mysqli_query($veza, $upit6) or die (mysqli_error($veza));
            $redak6 = mysqli_fetch_array($rezultat6, MYSQLI_ASSOC);

            $kapacitet = $redak6['slobodne'];

            echo "
        </div><div class=\"col-lg-3\">
            <h2 class=\"page-header\">Dodatne informacije: </h2>
            <p><span class=\"glyphicon glyphicon-triangle-right\"></span> Kapacitet hotela: $kapacitet rooms</p>
            <p><span class=\"glyphicon glyphicon-triangle-right\"></span> Broj obroka: $brojObroka</p>";

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

                echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> <span style='color: limegreen;'> Popust: $popust %</span></p>";

            }

            echo "</div></div>
            
        
        <div class=\"row\">
        <div class=\"col-lg-12\">
            <h2 class=\"page-header\">Dodatne slike: </h2>";
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
            <img class=\"img-responsive nova2\" src=\"./images/$url\" alt=\"\" >
                    </a >
                </div >";
            }



            echo "</div>
    </div>
    <hr>";
        }

        if (isset($_GET['selectedRoom'])) {
            $number = $_GET['number'];
            $startingDate = $_GET['date'];
            $roomID = $_GET['idSoba'];
            $hotelID = $_GET['value'];
            $people = $_GET['people'];

            $upit6 = "SELECT idAkcija FROM smjestaj WHERE idSmjestaj = $id";
            $rezultat6 = mysqli_query($veza, $upit6) or die (mysqli_error($veza));
            $redak6 = mysqli_fetch_array($rezultat6, MYSQLI_ASSOC);
            $idAkcija = $redak6['idAkcija'];
            $popust = 1;

            if (sizeof($redak6['idAkcija']) != 0) {
                $idAkcija = $redak6['idAkcija'];

                $upit6 = "SELECT popust FROM akcija WHERE idAkcija = $idAkcija";
                $rezultat6 = mysqli_query($veza, $upit6) or die (mysqli_error($veza));
                $redak6 = mysqli_fetch_array($rezultat6, MYSQLI_ASSOC);

                $popust = $redak6['popust'];
            }

            $upit7 = "SELECT cijenaPoDanu FROM soba WHERE idSoba = $roomID";
            $rezultat7 = mysqli_query($veza, $upit7) or die (mysqli_error($veza));
            $redak7 = mysqli_fetch_array($rezultat7, MYSQLI_ASSOC);
            $cijenaPoOsobi = $redak7['cijenaPoDanu'];
            $totalPrice = $number * $cijenaPoOsobi * $popust;


            $upit = "SELECT tip, brojSlobodnih FROM soba WHERE idSoba = $roomID";
            $rezultat = mysqli_query($veza, $upit) or die (mysqli_error($veza));
            $redak = mysqli_fetch_array($rezultat, MYSQLI_ASSOC);
            $tipSobe = $redak['tip'];
            $brojSlobodnih = $redak['brojSlobodnih'];


            echo "<div class='col-md-6'>
                <p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Odabrani tip sobe:</b> $tipSobe</p>
                <p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Početni datum:</b> $startingDate</p>
                <p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Broj dana:</b> $number</p>
                <p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Broj osoba:</b> $people</p>
                <p><span class=\"glyphicon glyphicon-triangle-right\"></span> <b>Ukupna cijena:</b> $totalPrice €</p><br>
                <p><b>Ukoliko želite rezervirati ovu sobu, pritisnite NASTAVI, inače pritisnite ODUSTANI.</b></p>
                <a style='margin-left: 120px; margin-top: 25px' class=\"btn btn-success\" href=\"./reserveHotel.php?reserved=true&hotelID=$hotelID&number=$number&date=$startingDate&customerID=$customerID&totalPrice=$totalPrice&roomID=$roomID\">Nastavi <span class=\"glyphicon glyphicon-chevron-right\"></span></a>
                <a style='margin-left: 20px; margin-top: 25px' class=\"btn btn-danger\" href=\"./learnMoreAccomodation.php?value=$hotelID\">Odustani <span class=\"glyphicon glyphicon-chevron-right\"></span></a></div>
                </div>";
            echo "<div class=\"row\">";
            echo "
        <div class=\"col-lg-6\">
        <h2 class=\"page-header\">Opis: </h2>
            <p>$opis</p>
        </div>";
            echo "
        <div class=\"col-lg-3\">
            <h2 class=\"page-header\">Hotel nudi: </h2>";
            $upit6 = "SELECT idSadrzaj FROM hotel_nudi WHERE idSmjestaj = $id";
            $rezultat6 = mysqli_query($veza, $upit6) or die (mysqli_error($veza));
            while ($redak6 = mysqli_fetch_array($rezultat6, MYSQLI_ASSOC)) {
                $idSadrzaj = $redak6['idSadrzaj'];
                $upit7 = "SELECT naziv FROM sadrzaj WHERE idSadrzaj = $idSadrzaj";
                $rezultat7 = mysqli_query($veza, $upit7) or die (mysqli_error($veza));
                $redak7 = mysqli_fetch_array($rezultat7, MYSQLI_ASSOC);
                $sadrzaj = $redak7['naziv'];
                echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> $sadrzaj</p>";
            }
            $upit6 = "SELECT SUM(brojSlobodnih) AS slobodne FROM soba WHERE idSmjestaj = $id";
            $rezultat6 = mysqli_query($veza, $upit6) or die (mysqli_error($veza));
            $redak6 = mysqli_fetch_array($rezultat6, MYSQLI_ASSOC);
            $kapacitet = $redak6['slobodne'];
            echo "
        </div><div class=\"col-lg-3\">
            <h2 class=\"page-header\">Dodatne informacije: </h2>
            <p><span class=\"glyphicon glyphicon-triangle-right\"></span> Kapacitet hotela: $kapacitet rooms</p>
            <p><span class=\"glyphicon glyphicon-triangle-right\"></span> Broj obroka: $brojObroka</p>";

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

                echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> <span style='color: limegreen;'> Popust: $popust %</span></p>";

            }

            echo "</div></div>
            
        
        <div class=\"row\">
        <div class=\"col-lg-12\">
            <h2 class=\"page-header\">Dodatne slike: </h2>";
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

        if (isset($_GET['selectedDate'])) {
            if (isset($_POST['saveForm'])) {
                $number = $_POST['number'];
                $startingDate = $_POST['date'];
                $people = $_POST['people'];
                $hotelID = $_GET['value'];

                echo "<div class='col-md-6' align='center'> <div class=\"dropdown\">
            <button style='margin-top: 100px;' class=\"btn btn-primary dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">
  Odaberite željeni tip sobe</button>
  <ul style='margin-left: 179px;' class=\"dropdown-menu\">";

                $upit = "SELECT idSoba, tip, cijenaPoDanu, brojOsoba FROM soba WHERE idSmjestaj = $id AND brojOsoba >= $people ORDER BY cijenaPoDanu ASC";
                $rezultat = mysqli_query($veza, $upit) or die (mysqli_error($veza));

                while ($redak = mysqli_fetch_array($rezultat, MYSQLI_ASSOC)) {
                    $idSoba = $redak['idSoba'];
                    $tipSobe = $redak['tip'];
                    $cijenaPoDanu = $redak['cijenaPoDanu'];
                    $brojOsoba = $redak['brojOsoba'];

                    $test = true;

                    for ($i = 0; $i < $number; $i++) {
                        $upit2 = "SELECT slobodno FROM soba_rezervacija WHERE idSoba = $idSoba AND datum = DATE(DATE_ADD('$startingDate', INTERVAL $i DAY))";
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
                        echo "<li><a href=\"reserveHotel.php?value=$id&customerID=$customerID&idSoba=$idSoba&number=$number&date=$startingDate&people=$people&selectedRoom=true\">$tipSobe, $cijenaPoDanu € po noći, za $brojOsoba osoba</a></li>";
                    }
                }

                echo "  </ul>
</div></div></div>";

                echo "<div class=\"row\">";

                echo "
        <div class=\"col-lg-6\">
        <h2 class=\"page-header\">Opis: </h2>
            <p>$opis</p>
        </div>";

                echo "
        <div class=\"col-lg-3\">
            <h2 class=\"page-header\">Hotel nudi: </h2>";

                $upit6 = "SELECT idSadrzaj FROM hotel_nudi WHERE idSmjestaj = $id";
                $rezultat6 = mysqli_query($veza, $upit6) or die (mysqli_error($veza));

                while ($redak6 = mysqli_fetch_array($rezultat6, MYSQLI_ASSOC)) {
                    $idSadrzaj = $redak6['idSadrzaj'];

                    $upit7 = "SELECT naziv FROM sadrzaj WHERE idSadrzaj = $idSadrzaj";
                    $rezultat7 = mysqli_query($veza, $upit7) or die (mysqli_error($veza));
                    $redak7 = mysqli_fetch_array($rezultat7, MYSQLI_ASSOC);

                    $sadrzaj = $redak7['naziv'];

                    echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> $sadrzaj</p>";
                }

                $upit6 = "SELECT SUM(brojSlobodnih) AS slobodne FROM soba WHERE idSmjestaj = $id";
                $rezultat6 = mysqli_query($veza, $upit6) or die (mysqli_error($veza));
                $redak6 = mysqli_fetch_array($rezultat6, MYSQLI_ASSOC);

                $kapacitet = $redak6['slobodne'];

                echo "
        </div><div class=\"col-lg-3\">
            <h2 class=\"page-header\">Dodatne informacije: </h2>
            <p><span class=\"glyphicon glyphicon-triangle-right\"></span> Kapacitet hotela: $kapacitet rooms</p>
            <p><span class=\"glyphicon glyphicon-triangle-right\"></span> Broj obroka: $brojObroka</p>";

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

                    echo "<p><span class=\"glyphicon glyphicon-triangle-right\"></span> <span style='color: limegreen;'> Popust: $popust %</span></p>";

                }

                echo "</div></div>
                
        
        <div class=\"row\">
        <div class=\"col-lg-12\">
            <h2 class=\"page-header\">Dodatne slike: </h2>";
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
                <img class=\"img-responsive nova2\" src=\"./images/$url\" alt=\"\">
                    </a >
                </div >";
            }



            echo "</div>
    </div>
    <hr>";
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
