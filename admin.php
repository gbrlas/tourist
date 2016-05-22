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
            <a class="navbar-brand" href="./admin.php?logged=true">ADMIN</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">LOKACIJE
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="./admin.php?value=addLocation&logged=true">Dodaj lokaciju</a></li>
                        <li><a href="./admin.php?value=removeLocation&logged=true">Obriši lokaciju</a></li>
                        <li><a href="./admin.php?value=editLocation&logged=true">Uredi lokaciju</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">SMJEŠTAJ
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="./admin.php?value=addAccomodation&logged=true">Dodaj smještaj</a></li>
                        <li><a href="./admin.php?value=removeAccomodation&logged=true">Obriši smještaj</a></li>
                        <li><a href="./admin.php?value=editAccomodation&logged=true">Uredi smještaj</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">IZLETI
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="./admin.php?value=addTour&logged=true">Dodaj izlet</a></li>
                        <li><a href="./admin.php?value=removeTour&logged=true">Obriši izlet</a></li>
                        <li><a href="./admin.php?value=editTour&logged=true">Uredi izlet</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">OSTALO
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="./admin.php?value=addImage&logged=true">Dodaj sliku</a></li>
                        <li><a href="./admin.php?value=addRoom&logged=true">Dodaj sobu</a></li>
                        <li><a href="./admin.php?value=addHotelContent&logged=true">Dodaj hotelski sadržaj</a></li>
                        <li><a href="./admin.php?value=addAction&logged=true">Dodaj popust</a></li>
                        <li><a href="./admin.php?value=addCustomer&logged=true">Dodaj korisnika</a></li>
                        <li><a href="./admin.php?value=addCountry&logged=true">Dodaj državu</a></li>

                    </ul>
                </li>
                <li>
                    <a href="./index.php">WEB-STRANICA</a>
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

    if (! isset($_GET['logged'])) {
        echo "<div class=\"container\">
        <div class=\"col-md-4\"></div>

      <div class=\"col-md-4\"> <form class=\"form-signin\" method='post' action='./admin.php?logged=true'>
        <h2 class=\"form-signin-heading\">Prijavite se</h2>
        <label for=\"name\" class=\"sr-only\">Korisničko ime</label>
        <input type=\"name\" id=\"name\" class=\"form-control\" placeholder=\"Username\" required autofocus>
        <label for=\"inputPassword\" class=\"sr-only\">Lozinke</label>
        <input type=\"password\" id=\"inputPassword\" class=\"form-control\" placeholder=\"Password\" required>
        <div class=\"checkbox\">
          <label>
            <input type=\"checkbox\" value=\"remember-me\"> Zapamti me
        </label>
        </div>
        <button class=\"btn btn-lg btn-primary btn-block\" type=\"submit\">Prijava</button>
      </form></div>
    <div class=\"col-md-4\"></div>
    </div> <!-- /container -->";

    } else if ($_GET['logged'] == "true" && count($_GET) == 1) {
            include './admin/spajanje_na_bazu.php';
            include './admin/funkcije.php';
            $upit = "SELECT idLokacija, ime, opis, tip, idDrzava FROM lokacija";
            $rezultat = mysqli_query($veza, $upit) or die (mysqli_error($veza));

            while ($redak = mysqli_fetch_array($rezultat, MYSQLI_ASSOC)) {
                $lokacija = $redak['idLokacija'];
                $ime = $redak['ime'];
                $opis = $redak['opis'];
                $tip = $redak['tip'];

                if ($tip == 5) {
                    continue;
                }

                $upit2 = "SELECT idSlika FROM slike_lokacija WHERE idLokacija = $lokacija";
                $rezultat2 = mysqli_query($veza, $upit2) or die (mysqli_error($veza));
                $redak2 = mysqli_fetch_array($rezultat2, MYSQLI_ASSOC);
                $idSlika = $redak2['idSlika'];

                $upit3 = "SELECT url FROM slika WHERE idSlika = $idSlika";
                $rezultat3 = mysqli_query($veza, $upit3) or die (mysqli_error($veza));
                $redak3 = mysqli_fetch_array($rezultat3, MYSQLI_ASSOC);
                $url = $redak3['url'];

                echo "<div class=\"row\">";
                echo "
                    <div class=\"col-md-6\">
                        <a href=\"#\">
                            <img class=\"img-responsive\" src=\"./images/$url\" width=\"600\" height=\"300\" alt=\"\">
                        </a>
                    </div>";

                echo "<div class=\"col-md-6\">
                        <h3>$ime</h3>
                            <p>$opis</p>
                        <a class=\"btn btn-warning\" href=\"./admin/editLocations.php?value=$lokacija\">Uredi lokaciju <span class=\"glyphicon glyphicon-chevron-right\"></span></a>
                         <a style='margin-left: 25px' class=\"btn btn-danger\" href=\"./admin/removeLocations.php?value=$lokacija\">Obriši lokaciju <span class=\"glyphicon glyphicon-chevron-right\"></span></a>
                   </div>";

                echo "</div>";
                echo "<hr>";
            };

    }

    if (isset($_GET['value'])) {
        $test = $_GET['value'];

        if ($test === "removeLocation") {
            echo "
            <div class=\"row\">
                <div class=\"col-lg-12\">
                    <h1 class=\"page-header\">Brisanje lokacije</h1>
                </div>
            </div>
            <form class=\"form-horizontal\" action=\"./admin/removeLocations.php\" method=\"post\">
                <div class=\"form-group\">
                    <label for=\"locationid\" class=\"col-sm-2 control-label\">ID lokacije</label>
                    <div class=\"col-sm-9\">
                        <input name=\"locationid\" class=\"form-control\" id=\"loctionid\" placeholder=\"ID lokacije\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-sm-offset-2 col-sm-10\">
                    <button type=\"submit\" class=\"btn btn-danger\">Obriši lokaciju</button>
                    </div>
                </div>
             </form>
            ";
        } else if ($test === "removeAccomodation") {
            echo "
            <div class=\"row\">
                <div class=\"col-lg-12\">
                    <h1 class=\"page-header\">Brisanje smještaja</h1>
                </div>
            </div>
            <form class=\"form-horizontal\" action=\"./admin/removeAccomodations.php\" method=\"post\">
                <div class=\"form-group\">
                    <label for=\"accomodationId\" class=\"col-sm-2 control-label\">ID smještaja</label>
                    <div class=\"col-sm-9\">
                        <input name=\"accomodationId\" class=\"form-control\" id=\"accomodationId\" placeholder=\"ID smještaja\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-sm-offset-2 col-sm-10\">
                    <button type=\"submit\" class=\"btn btn-danger\">Obriši smještaj</button>
                    </div>
                </div>
            </form>
            ";
        } else if ($test === "removeTour") {
            echo "   
            <div class=\"row\">
                <div class=\"col-lg-12\">
                    <h1 class=\"page-header\">Brisanje izleta</h1>
                </div>
            </div>
            <form class=\"form-horizontal\" action=\"./admin/removeTours.php\" method=\"post\">
                <div class=\"form-group\">
                    <label for=\"tourId\" class=\"col-sm-2 control-label\">ID izleta</label>
                    <div class=\"col-sm-9\">
                        <input name=\"tourId\" class=\"form-control\" id=\"tourId\" placeholder=\"ID izleta\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-sm-offset-2 col-sm-10\">
                    <button type=\"submit\" class=\"btn btn-danger\">Obriši izlet</button>
                    </div>
                </div>
            </form>
            ";
        }

    } ?>

    <?php

        if (isset($_GET['value'])) {
            $test = $_GET['value']; } else {
            $test = "";
        }
    ?>

    <?php if($test === "addTour") : ?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dodaj novi izlet</h1>
            </div>
        </div>
        <form class="form-horizontal" action="./admin/addTours.php" method="post">
            <div class="form-group">
                <label for="starting" class="col-sm-2 control-label">Naziv</label>
                <div class="col-sm-9">
                    <input name="name" class="form-control" id="name" placeholder="Naziv">
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Opis</label>
                <div class="col-sm-9">
                    <textarea name="description" class="form-control" rows="4" placeholder="Opis izleta"></textarea>
                </div>
             </div>
            <div class="form-group">
                <label for="duration" class="col-sm-2 control-label">Trajanje</label>
                <div class="col-sm-9">
                    <input name="duration" class="form-control" id="duration" placeholder="Trajanje izleta">
                </div>
            </div>
            <div class="form-group">
                <label for="price" class="col-sm-2 control-label">Cijena</label>
                <div class="col-sm-9">
                    <input name="price" class="form-control" id="price" placeholder="Cijena po osobi">
                </div>
            </div>
            <div class="form-group">
                <label for="company" class="col-sm-2 control-label">Kompanija</label>
                <div class="col-sm-9">
                    <input name="company" class="form-control" id="company" placeholder="Naziv kompanije">
                </div>
            </div>
            <div class="form-group">
                <label for="location" class="col-sm-2 control-label">Lokacija</label>
                <div class="col-sm-2">
                    <input name="location" class="form-control" id="location" placeholder="ID lokacije">
                </div>
            </div>
            <div class="form-group">
                <label for="discount" class="col-sm-2 control-label">Discount</label>
                <div class="col-sm-2">
                    <input name="discount" class="form-control" id="discount" placeholder="Tour discount">
                </div>
            </div>
            <div class="form-group">
                <label for="guide" class="col-sm-2 control-label">Vodič</label>
                <div class="col-sm-1">
                    <input name="guide" class="form-control" id="guide" placeholder="Vodič">
                </div>
            </div>
            <div class="form-group">
                <label for="meal" class="col-sm-2 control-label">Obrok</label>
                <div class="col-sm-1">
                    <input name="meal" class="form-control" id="meal" placeholder="Obrok">
                </div>
            </div>
            <div class="form-group">
                <label for="tickets" class="col-sm-2 control-label">Ulaznice</label>
                <div class="col-sm-1">
                    <input name="tickets" class="form-control" id="tickets" placeholder="Ulaznice">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button name="saveForm" type="submit" class="btn btn-success">Dodaj izlet</button>
                    <button name='reset' type="reset" class="btn btn-danger">Poništi</button>
                </div>
            </div>

        </form>
    <?php endif; ?>

    <?php if($test === "addAccomodation") : ?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dodaj novi smještaj</h1>
            </div>
        </div>
        <!-- /.row -->
        <form class="form-horizontal" action="./admin/addAccomodations.php" method="post">
            <div class="form-group">
                <label for="type" class="col-sm-2 control-label">Tip</label>
                <div class="col-sm-2">
                    <input name="type" class="form-control" id="type" placeholder="Tip">
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Opis</label>
                <div class="col-sm-9">
                    <textarea name="description" class="form-control" rows="4" placeholder="Opis smještaja"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="address" class="col-sm-2 control-label">Adresa</label>
                <div class="col-sm-9">
                    <input name="address" class="form-control" id="address" placeholder="Adresa smještaja">
                </div>
            </div>
            <div class="form-group">
                <label for="classification" class="col-sm-2 control-label">Klasifikacija</label>
                <div class="col-sm-2">
                    <input name="classification" class="form-control" id="classification" placeholder="Klasifikacija">
                </div>
            </div>
            <div class="form-group">
                <label for="location" class="col-sm-2 control-label">Lokacija</label>
                <div class="col-sm-2">
                    <input name="location" class="form-control" id="location" placeholder="ID lokacije">
                </div>
            </div>
            <div class="form-group">
                <label for="discount" class="col-sm-2 control-label">Akcija</label>
                <div class="col-sm-2">
                    <input name="discount" class="form-control" id="discount" placeholder="ID akcije">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button name="saveForm" type="submit" class="btn btn-success">Dodaj smještaj</button>
                    <button name='reset' type="reset" class="btn btn-danger">Poništi</button>
                </div>
            </div>

        </form>
    <?php endif; ?>
    
    <?php if($test === "addLocation") : ?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dodaj novu lokaciju</h1>
            </div>
        </div>
        <!-- /.row -->
        <form class="form-horizontal" action="./admin/addLocations.php" method="post">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Naziv</label>
                <div class="col-sm-9">
                    <input name="name" class="form-control" id="name" placeholder="Naziv lokacije">
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Opis</label>
                <div class="col-sm-9">
                    <textarea name="description" class="form-control" rows="4" placeholder="Opis lokacije"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="state" class="col-sm-2 control-label">Država</label>
                <div class="col-sm-2">
                    <input name="state" class="form-control" id="state" placeholder="ID države">
                </div>
            </div>
            <div class="form-group">
                <label for="type" class="col-sm-2 control-label">Tip</label>
                <div class="col-sm-1">
                    <input name="type" class="form-control" id="type" placeholder="Tip">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button name="saveForm" type="submit" class="btn btn-success">Dodaj lokaciju</button>
                    <button name='reset' type="reset" class="btn btn-danger">Poništi</button>
                </div>
            </div>

        </form>
    <?php endif; ?>

    <?php if($test === "addRoom") : ?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dodaj novu sobu</h1>
            </div>
        </div>
        <form class="form-horizontal" action="./admin/addRooms.php" method="post">
            <div class="form-group">
                <label for="size" class="col-sm-2 control-label">Veličina</label>
                <div class="col-sm-4">
                    <input name="size" class="form-control" id="size" placeholder="Veličina sobe">
                </div>
            </div>
            <div class="form-group">
                <label for="type" class="col-sm-2 control-label">Tip</label>
                <div class="col-sm-4">
                    <input name="type" class="form-control" id="type" placeholder="Tip">
                </div>
            </div>
            <div class="form-group">
                <label for="price" class="col-sm-2 control-label">Cijena</label>
                <div class="col-sm-4">
                    <input name="price" class="form-control" id="price" placeholder="Cijena po danu">
                </div>
            </div>
            <div class="form-group">
                <label for="free" class="col-sm-2 control-label">Broj</label>
                <div class="col-sm-4">
                    <input name="free" class="form-control" id="free" placeholder="Broj slobodnih">
                </div>
            </div>
            <div class="form-group">
                <label for="osobe" class="col-sm-2 control-label">Size</label>
                <div class="col-sm-4">
                    <input name="osobe" class="form-control" id="osobe" placeholder="Broj osoba">
                </div>
            </div>
            <div class="form-group">
                <label for="accomodation" class="col-sm-2 control-label">Smještaj</label>
                <div class="col-sm-2">
                    <input name="accomodation" class="form-control" id="accomodation" placeholder="ID smještaj">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button name="saveForm" type="submit" class="btn btn-success">Dodaj sobu</button>
                    <button name='reset' type="reset" class="btn btn-danger">Poništi</button>
                </div>
            </div>
        </form>
    <?php endif; ?>

    <?php if($test === "addHotelContent") : ?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dodaj novi sadržaj</h1>
            </div>
        </div>
        <form class="form-horizontal" action="./admin/addHotelContent.php" method="post">
            <div class="form-group">
                <label for="content" class="col-sm-2 control-label">Sadržaj</label>
                <div class="col-sm-4">
                    <input name="content" class="form-control" id="content" placeholder="Naziv sadržaja">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button name="saveForm" type="submit" class="btn btn-success">Dodaj sadržaj</button>
                    <button name='reset' type="reset" class="btn btn-danger">Poništi</button>
                </div>
            </div>
        </form>
    <?php endif; ?>

    <?php if($test === "addImage") : ?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dodaj novu sliku</h1>
            </div>
        </div>
        <form class="form-horizontal" action="./admin/addImages.php" method='post'>
            <div class="form-group">
                <label for="slika1" class="col-sm-2 control-label">Slika</label>
                <div class="col-sm-9">
                    <input id="slika1" name="slika1" type="text" class="form-control" placeholder="URL slike">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button name='saveForm' type="submit" class="btn btn-success">Dodaj sliku</button>
                    <button name='reset' type="reset" class="btn btn-danger">Poništi</button>
                </div>
            </div>
        </form>
    <?php endif; ?>

    <?php if($test === "addCountry") : ?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dodaj novu državu</h1>
            </div>
        </div>
        <form class="form-horizontal" action="./admin/addCountry.php" method='post'>
            <div class="form-group">
                <label for="country" class="col-sm-2 control-label">Država</label>
                <div class="col-sm-4">
                    <input id="country" name="country" type="text" class="form-control" placeholder="Naziv države">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button name='saveForm' type="submit" class="btn btn-success">Dodaj državu</button>
                    <button name='reset' type="reset" class="btn btn-danger">Poništi</button>
                </div>
            </div>
        </form>
    <?php endif; ?>

    <?php if($test === "addCustomer") : ?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dodaj korisnika</h1>
            </div>
        </div>
        <form class="form-horizontal" action="./admin/addCustomers.php" method="post">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Ime</label>
                <div class="col-sm-9">
                    <input name="name" class="form-control" id="name" placeholder="Ime">
                </div>
            </div>
            <div class="form-group">
                <label for="surname" class="col-sm-2 control-label">Prezime</label>
                <div class="col-sm-9">
                    <input name="surname" class="form-control" id="surname" placeholder="Prezime">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">E-mail</label>
                <div class="col-sm-9">
                    <input name="email" class="form-control" id="email" placeholder="E-mail">
                </div>
            </div>
            <div class="form-group">
                <label for="year" class="col-sm-2 control-label">Godina</label>
                <div class="col-sm-3">
                    <input name="year" class="form-control" id="year" placeholder="Godina rođenja">
                </div>
            </div>
            <div class="form-group">
                <label for="number" class="col-sm-2 control-label">Broj</label>
                <div class="col-sm-3">
                    <input name="number" class="form-control" id="number" placeholder="Broj mobitela">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button name="saveForm" type="submit" class="btn btn-success">Dodaj korisnika</button>
                    <button name='reset' type="reset" class="btn btn-danger">Poništi</button>
                </div>
            </div>
        </form>
    <?php endif; ?>

    <?php if($test === "addAction") : ?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dodaj popust</h1>
            </div>
        </div>
        <form class="form-horizontal" action="./admin/addActions.php" method='post'>
            <div class="form-group">
                <label for="action" class="col-sm-2 control-label">Popust</label>
                <div class="col-sm-4">
                    <input id="action" name="action" type="text" class="form-control" placeholder="Postotak popusta">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button name='saveForm' type="submit" class="btn btn-success">Dodaj popust</button>
                    <button name='reset' type="reset" class="btn btn-danger">Poništi</button>
                </div>
            </div>
        </form>
    <?php endif; ?>
    <?php if($test === "editLocation") : ?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Uredi lokaciju</h1>
            </div>
        </div>
        <form class="form-horizontal" action="./admin/editLocations.php" method='post'>
            <div class="form-group">
                <label for="action" class="col-sm-2 control-label">ID</label>
                <div class="col-sm-4">
                    <input id="id" name="id" type="text" class="form-control" placeholder="ID lokacije">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button name='saveForm' type="submit" class="btn btn-success">Uredi lokaciju</button>
                    <button name='reset' type="reset" class="btn btn-danger">Poništi</button>
                </div>
            </div>
        </form>
    <?php endif; ?>

    <?php if($test === "editTour") : ?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Uredi izlet</h1>
            </div>
        </div>
        <form class="form-horizontal" action="./admin/editTours.php" method='post'>
            <div class="form-group">
                <label for="action" class="col-sm-2 control-label">ID</label>
                <div class="col-sm-4">
                    <input id="id" name="id" type="text" class="form-control" placeholder="ID izleta">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button name='saveForm' type="submit" class="btn btn-success">Uredi izlet</button>
                    <button name='reset' type="reset" class="btn btn-danger">Poništi</button>
                </div>
            </div>
        </form>
    <?php endif; ?>

    <?php if($test === "editAccomodation") : ?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Uredi smještaj</h1>
            </div>
        </div>
        <!-- /.row -->
        <form class="form-horizontal" action="./admin/editAccomodations.php" method='post'>
            <div class="form-group">
                <label for="action" class="col-sm-2 control-label">ID</label>
                <div class="col-sm-4">
                    <input id="id" name="id" type="text" class="form-control" placeholder="ID smještaja">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button name='saveForm' type="submit" class="btn btn-success">Uredi smještaj</button>
                    <button name='reset' type="reset" class="btn btn-danger">Poništi</button>
                </div>
            </div>
        </form>
    <?php endif; ?>

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
