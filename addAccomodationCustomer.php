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

    <title>Tourist - Dodavanje korisnika</title>
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

    include "./admin/spajanje_na_bazu.php";
    include "./admin/funkcije.php";

    if (!isset($_GET['customerType'])) {
        $accomodationID = $_GET['accomodationID'];
        $type = $_GET['type'];

        echo "
                <div class=\"row\">
        <div class=\"col-lg-6\">
        <h4>Ako ste novi korisnik, pritisnite sljedeći gumb:</h4>
            
            <div class=\"col-md-4\">
            </div>
           <div class=\"col-md-6\">
            <a class=\"btn btn-success\" href=\"./addAccomodationCustomer.php?value=$accomodationID&customerType=2&type=$type\">Nastavite <span class=\"glyphicon glyphicon-chevron-right\"></span></a>
           </div>
        </div>
        </div><br>";

        echo "<div class=\"row\">
        <div class=\"col-lg-12\">
        <h4>Inače, ako ste već postojeći korisnik, unesite vaš ID:</h4>
        <br>
        
        
        <form class=\"form-horizontal\" action=\"./addAccomodationCustomer.php?accomodationID=$accomodationID&type=$type&existing=true&customerType=1\" method=\"post\">
        <div class=\"form-group\">
            <label for=\"number\" class=\"col-sm-2 control-label\">ID</label>
            <div class=\"col-sm-3\">
                <input name=\"number\" class=\"form-control\" id=\"number\" placeholder=\"Korisnički ID\" required=\"true\"> 
            </div>
        </div>
        <div class=\"form-group\">
            <div class=\"col-sm-offset-2 col-sm-10\">
                <button name=\"saveForm\" type=\"submit\" class=\"btn btn-success\">Nastavite <span class=\"glyphicon glyphicon-chevron-right\"></span></button>
            </div>
        </div>
    </form></div></div>";

    } else if (isset($_GET['existing'])) {
        $id = $_POST['number'];
        $idAccomodation = $_GET['accomodationID'];
        $type = $_GET['type'];

        echo "<div class=\"row\">
                    <div class=\"col-md-6\">
                        <h4 style='color: limegreen'>Podatci uspješno uneseni.</h4>
                        <br>
                        <h4>Pritisnite sljedeći gumb za nastavak rezervacije: </h4><br></div></div>";

        echo "<div class=\"row\">
                        <div class=\"col-md-6\">
                        <a class=\"btn btn-success\" href=\"./reserve$type.php?value=$idAccomodation&customerID=$id\">Nastavi <span class=\"glyphicon glyphicon-chevron-right\"></span></a>
                   </div></div>";

    } else if (!isset($_GET['addCustomer'])) {
        $accomodationID = $_GET['value'];
        $type = $_GET['type'];

        echo "
                <div class=\"row\">
        <div class=\"col-lg-12\">
            <h2 class=\"page-header\">Unesite vaše podatke: </h2>
        </div>
    </div>
    <form class=\"form-horizontal\" action=\"./addAccomodationCustomer.php?value=$accomodationID&type=$type&addCustomer=true&customerType=2\" method=\"post\">
        <div class=\"form-group\">
            <label for=\"name\" class=\"col-sm-2 control-label\">Ime</label>
            <div class=\"col-sm-9\">
                <input name=\"name\" class=\"form-control\" id=\"name\" placeholder=\"Ime\" required=\"true\">
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"surname\" class=\"col-sm-2 control-label\">Prezime</label>
            <div class=\"col-sm-9\">
                <input name=\"surname\" class=\"form-control\" id=\"surname\" placeholder=\"Prezime\" required=\"true\">
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"email\" class=\"col-sm-2 control-label\">E-mail</label>
            <div class=\"col-sm-9\">
                <input name=\"email\" class=\"form-control\" id=\"email\" placeholder=\"E-mail\" required=\"true\">
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"year\" class=\"col-sm-2 control-label\">Godina</label>
            <div class=\"col-sm-3\">
                <input name=\"year\" class=\"form-control\" id=\"year\" placeholder=\"Godina rođenja\" required=\"true\">
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"number\" class=\"col-sm-2 control-label\">Broj</label>
            <div class=\"col-sm-3\">
                <input name=\"number\" class=\"form-control\" id=\"number\" placeholder=\"Broj mobitela\" required=\"true\"> 
            </div>
        </div>

        <div class=\"form-group\">
            <div class=\"col-sm-offset-2 col-sm-10\">
                <button name=\"saveForm\" type=\"submit\" class=\"btn btn-success\">Nastavi</button>
                <button style='margin-left: 10px' name='reset' type=\"reset\" class=\"btn btn-danger\">Poništi</button>
            </div>
        </div>
    </form>
            ";
    } else if (isset($_GET['addCustomer'])) {
        if (isset($_POST['saveForm'])) {
            $name = navodnici($_POST['name']);
            $surname = navodnici($_POST['surname']);
            $email = navodnici($_POST['email']);
            $year = $_POST['year'];
            $phone = $_POST['number'];

            $idAccomodation = $_GET['value'];
            $type = $_GET['type'];

            $upit = "SELECT idKupac FROM kupac WHERE ime = $name AND prezime = $surname AND e_mail = $email AND godinaRodjenja = $year AND kontakt = $phone";
            $rezultat = mysqli_query($veza, $upit) or die ("2" . mysqli_error($veza));

            if (mysqli_num_rows($rezultat) == 0) {
                $upit = "INSERT INTO kupac (ime, prezime, e_mail, godinaRodjenja, kontakt) VALUES ($name, $surname, $email, $year, $phone)";
                mysqli_query ($veza, $upit) or die (mysqli_error($veza));
            }

            $upit = "SELECT idKupac FROM kupac WHERE ime = $name AND prezime = $surname AND e_mail = $email AND godinaRodjenja = $year AND kontakt = $phone";
            $rezultat = mysqli_query($veza, $upit) or die ("2" . mysqli_error($veza));
            $redak = mysqli_fetch_array($rezultat, MYSQLI_ASSOC);
            $idKupac = $redak['idKupac'];

            echo "<div class=\"row\">
                    <div class=\"col-md-6\">
                        <h4 style='color: limegreen'>Podatci uspješno uneseni. Vaš korisnički ID je: <b>$idKupac</b></h4>
                        <br>
                        <h4>Pritisnite gumb ispod da bi nastavili: </h4><br></div></div>";

            echo "<div class=\"row\">
                        <div class=\"col-md-6\">
                        <a class=\"btn btn-success\" href=\"./reserve$type.php?value=$idAccomodation&customerID=$idKupac\">Nastavite <span class=\"glyphicon glyphicon-chevron-right\"></span></a>
                   </div></div>";
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



