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

    <title>Tourist Agency</title>

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
        $upit = "SELECT idIzlet, naziv, opis, trajanje, cijenaPoOsobi, ukljucenVodic, ukljucenObrok, ukljuceneUlaznice, nazivKompanije, idLokacija, idAkcija FROM izlet WHERE idIzlet = $id";
        $rezultat = mysqli_query($veza, $upit) or die ("1" . mysqli_error($veza));

        $redak = mysqli_fetch_array($rezultat, MYSQLI_ASSOC);

        $naziv = $redak['naziv'];
        $trajanje = $redak['trajanje'];
        $opis = $redak['opis'];
        $cijenaPoOsobi = $redak['cijenaPoOsobi'];
        $ukljucenVodic = $redak['ukljucenVodic'];
        $ukljucenObrok = $redak['ukljucenObrok'];
        $ukljuceneUlaznice = $redak['ukljuceneUlaznice'];
        $nazivKompanije = $redak['nazivKompanije'];
        $idLokacija = $redak['idLokacija'];
        $idAkcija = $redak['idAkcija'];

        echo "<div class=\"row\">
            <div class=\"col-lg-12\">
                <h1 class=\"page-header\">Uredi izlet</h1>
            </div>
        </div>
        <form class=\"form-horizontal\" action=\"./editTours.php?changed=true&value=$id\" method=\"post\">
            <div class=\"form-group\">
                <label for=\"starting\" class=\"col-sm-2 control-label\">Naziv</label>
                <div class=\"col-sm-9\">
                    <input name=\"name\" class=\"form-control\" id=\"name\" value=\"$naziv\">
                </div>
            </div>
            <div class=\"form-group\">
                <label for=\"description\" class=\"col-sm-2 control-label\">Opis</label>
                <div class=\"col-sm-9\">
                    <textarea name=\"description\" class=\"form-control\" rows=\"6\" >$opis</textarea>
                </div>
            </div><div class=\"form-group\">
                <label for=\"starting\" class=\"col-sm-2 control-label\">Trajanje</label>
                <div class=\"col-sm-9\">
                    <input name=\"starting\" class=\"form-control\" id=\"starting\" value=\"$trajanje\">
                </div>
            </div>
            <div class=\"form-group\">
                <label for=\"price\" class=\"col-sm-2 control-label\">Cijena po osobi</label>
                <div class=\"col-sm-9\">
                    <input name=\"price\" class=\"form-control\" id=\"price\" value=\"$cijenaPoOsobi\">
                </div>
            </div>
            <div class=\"form-group\">
                <label for=\"company\" class=\"col-sm-2 control-label\">Kompanija</label>
                <div class=\"col-sm-9\">
                    <input name=\"company\" class=\"form-control\" id=\"company\" value=\"$nazivKompanije\">
                </div>
            </div>
            <div class=\"form-group\">
                <label for=\"location\" class=\"col-sm-2 control-label\">Lokacija</label>
                <div class=\"col-sm-2\">
                    <input name=\"location\" class=\"form-control\" id=\"location\" value=\"$idLokacija\">
                </div>
            </div>
            <div class=\"form-group\">
                <label for=\"discount\" class=\"col-sm-2 control-label\">Popust</label>
                <div class=\"col-sm-2\">
                    <input name=\"discount\" class=\"form-control\" id=\"discount\" value=\"$idAkcija\">
                </div>
            </div>
            <div class=\"form-group\">
                <label for=\"guide\" class=\"col-sm-2 control-label\">Vodič</label>
                <div class=\"col-sm-1\">
                    <input name=\"guide\" class=\"form-control\" id=\"guide\" value=\"$ukljucenVodic\">
                </div>
            </div>
            <div class=\"form-group\">
                <label for=\"meal\" class=\"col-sm-2 control-label\">Obrok</label>
                <div class=\"col-sm-1\">
                    <input name=\"meal\" class=\"form-control\" id=\"meal\" value=\"$ukljucenObrok\">
                </div>
            </div>
            <div class=\"form-group\">
                <label for=\"tickets\" class=\"col-sm-2 control-label\">Ulaznice</label>
                <div class=\"col-sm-1\">
                    <input name=\"tickets\" class=\"form-control\" id=\"tickets\" value=\"$ukljuceneUlaznice\">
                </div>
            </div>

            <div class=\"form-group\">
                <div class=\"col-sm-offset-2 col-sm-10\">
                    <button name=\"saveForm\" type=\"submit\" class=\"btn btn-success\">Uredi izlet</button>
                    <button name='reset' type=\"reset\" class=\"btn btn-danger\">Poništi</button>
                </div>
            </div>

        </form>";
    } else {

        $starting = navodnici($_POST['starting']);
        $description = navodnici($_POST['description']);
        $duration = $_POST['duration'];
        $price = $_POST['price'];
        $company = navodnici($_POST['company']);
        $discount = $_POST['discount'];
        $location = $_POST['location'];
        $guide = $_POST['guide'];
        $meal = $_POST['meal'];
        $tickets = $_POST['tickets'];
        $naziv = navodnici($_POST['name']);

        $upit = "UPDATE izlet SET naziv = $naziv, opis = $description, trajanje = $starting, cijenaPoOsobi = $price, ukljucenVodic = $guide, ukljucenObrok = $meal, ukljuceneUlaznice = $tickets, nazivKompanije = $company, idLokacija = $location, idAkcija = $discount WHERE idIzlet = $id";
        mysqli_query($veza, $upit) or die ("2" . mysqli_error($veza));

        echo "<div class=\"row\">
                    <div class=\"col-md-6\">
                        <h4 style='color: limegreen'>Izlet <b>$id</b> uspješno uređen. </h4></div></div>";
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
