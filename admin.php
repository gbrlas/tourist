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
            <a class="navbar-brand" href="./admin.php">ADMIN</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Locations
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="./admin.php?value=addLocation">Add locations</a></li>
                        <li><a href="./admin.php?value=removeLocation">Remove locations</a></li>
                        <li><a href="./admin.php?value=editLocation">Edit locations</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Accomodations
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="./admin.php?value=addAccomodation">Add accomodations</a></li>
                        <li><a href="./admin.php?value=removeAccomodation">Remove accomodations</a></li>
                        <li><a href="./admin.php?value=editAccomodation">Edit accomodations</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Tours
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="./admin.php?value=addTour">Add tours</a></li>
                        <li><a href="./admin.php?value=removeTour">Remove tours</a></li>
                        <li><a href="./admin.php?value=editTour">Edit tours</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Other
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="./admin.php?value=addImage">Add image</a></li>
                        <li><a href="./admin.php?value=addRoom">Add room</a></li>
                        <li><a href="./admin.php?value=addHotelContent">Add hotel content</a></li>
                        <li><a href="./admin.php?value=addAction">Add discount</a></li>
                        <li><a href="./admin.php?value=addCustomer">Add customer</a></li>
                        <li><a href="./admin.php?value=addCountry">Add country</a></li>

                    </ul>
                </li>
                <li>
                    <a href="./index.php">Web-page</a>
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
                        <a class=\"btn btn-primary\" href=\"./learnMore.php?#value=$lokacija\">Learn more <span class=\"glyphicon glyphicon-chevron-right\"></span></a>
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
                    <h1 class=\"page-header\">Remove location</h1>
                </div>
            </div>
            <form class=\"form-horizontal\" action=\"./admin/removeLocations.php\" method=\"post\">
                <div class=\"form-group\">
                    <label for=\"locationid\" class=\"col-sm-2 control-label\">Location id</label>
                    <div class=\"col-sm-9\">
                        <input name=\"locationid\" class=\"form-control\" id=\"loctionid\" placeholder=\"Location ID\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-sm-offset-2 col-sm-10\">
                    <button type=\"submit\" class=\"btn btn-danger\">Remove location</button>
                    </div>
                </div>
             </form>
            ";
        } else if ($test === "removeAccomodation") {
            echo "
            <div class=\"row\">
                <div class=\"col-lg-12\">
                    <h1 class=\"page-header\">Remove accomodation</h1>
                </div>
            </div>
            <form class=\"form-horizontal\" action=\"./admin/removeAccomodations.php\" method=\"post\">
                <div class=\"form-group\">
                    <label for=\"accomodationId\" class=\"col-sm-2 control-label\">Accomodation id</label>
                    <div class=\"col-sm-9\">
                        <input name=\"accomodationId\" class=\"form-control\" id=\"accomodationId\" placeholder=\"Accomodation ID\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-sm-offset-2 col-sm-10\">
                    <button type=\"submit\" class=\"btn btn-danger\">Remove accomodation</button>
                    </div>
                </div>
            </form>
            ";
        } else if ($test === "removeTour") {
            echo "   
            <div class=\"row\">
                <div class=\"col-lg-12\">
                    <h1 class=\"page-header\">Remove tour</h1>
                </div>
            </div>
            <form class=\"form-horizontal\" action=\"./admin/removeTours.php\" method=\"post\">
                <div class=\"form-group\">
                    <label for=\"tourId\" class=\"col-sm-2 control-label\">Tour id</label>
                    <div class=\"col-sm-9\">
                        <input name=\"tourId\" class=\"form-control\" id=\"tourId\" placeholder=\"Tour ID\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-sm-offset-2 col-sm-10\">
                    <button type=\"submit\" class=\"btn btn-danger\">Remove tour</button>
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
                <h1 class="page-header">Add new tour</h1>
            </div>
        </div>
        <form class="form-horizontal" action="./admin/addTours.php" method="post">
            <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-9">
                    <textarea name="description" class="form-control" rows="4" placeholder="Tour description"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="starting" class="col-sm-2 control-label">Starting time</label>
                <div class="col-sm-9">
                    <input name="starting" class="form-control" id="starting" placeholder="Starting time">
                </div>
            </div>
            <div class="form-group">
                <label for="duration" class="col-sm-2 control-label">Tour duration</label>
                <div class="col-sm-9">
                    <input name="duration" class="form-control" id="duration" placeholder="Tour duration">
                </div>
            </div>
            <div class="form-group">
                <label for="price" class="col-sm-2 control-label">Price</label>
                <div class="col-sm-9">
                    <input name="price" class="form-control" id="price" placeholder="Price per person">
                </div>
            </div>
            <div class="form-group">
                <label for="company" class="col-sm-2 control-label">Company</label>
                <div class="col-sm-9">
                    <input name="company" class="form-control" id="company" placeholder="Company name">
                </div>
            </div>
            <div class="form-group">
                <label for="location" class="col-sm-2 control-label">Location</label>
                <div class="col-sm-2">
                    <input name="location" class="form-control" id="location" placeholder="Location ID">
                </div>
            </div>
            <div class="form-group">
                <label for="discount" class="col-sm-2 control-label">Discount</label>
                <div class="col-sm-2">
                    <input name="discount" class="form-control" id="discount" placeholder="Tour discount">
                </div>
            </div>
            <div class="form-group">
                <label for="guide" class="col-sm-2 control-label">Guide</label>
                <div class="col-sm-1">
                    <input name="guide" class="form-control" id="guide" placeholder="Guide">
                </div>
            </div>
            <div class="form-group">
                <label for="meal" class="col-sm-2 control-label">Meal</label>
                <div class="col-sm-1">
                    <input name="meal" class="form-control" id="meal" placeholder="Meal">
                </div>
            </div>
            <div class="form-group">
                <label for="tickets" class="col-sm-2 control-label">Tickets</label>
                <div class="col-sm-1">
                    <input name="tickets" class="form-control" id="tickets" placeholder="Tickets">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button name="saveForm" type="submit" class="btn btn-success">Add Tour</button>
                    <button name='reset' type="reset" class="btn btn-danger">Reset</button>
                </div>
            </div>

        </form>
    <?php endif; ?>

    <?php if($test === "addAccomodation") : ?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add new accomodation</h1>
            </div>
        </div>
        <!-- /.row -->
        <form class="form-horizontal" action="./admin/addAccomodations.php" method="post">
            <div class="form-group">
                <label for="type" class="col-sm-2 control-label">Address</label>
                <div class="col-sm-9">
                    <input name="type" class="form-control" id="type" placeholder="Accomodation address">
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-9">
                    <textarea name="description" class="form-control" rows="4" placeholder="Accomodation description"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="address" class="col-sm-2 control-label">Address</label>
                <div class="col-sm-9">
                    <input name="address" class="form-control" id="address" placeholder="Accomodation address">
                </div>
            </div>
            <div class="form-group">
                <label for="classification" class="col-sm-2 control-label">Clasification</label>
                <div class="col-sm-2">
                    <input name="classification" class="form-control" id="classification" placeholder="Classification">
                </div>
            </div>
            <div class="form-group">
                <label for="location" class="col-sm-2 control-label">Location</label>
                <div class="col-sm-2">
                    <input name="location" class="form-control" id="location" placeholder="Location ID">
                </div>
            </div>
            <div class="form-group">
                <label for="discount" class="col-sm-2 control-label">Discount</label>
                <div class="col-sm-2">
                    <input name="discount" class="form-control" id="discount" placeholder="Discount ID">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button name="saveForm" type="submit" class="btn btn-success">Add accomodation</button>
                    <button name='reset' type="reset" class="btn btn-danger">Reset</button>
                </div>
            </div>

        </form>
    <?php endif; ?>
    
    <?php if($test === "addLocation") : ?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add new location</h1>
            </div>
        </div>
        <!-- /.row -->
        <form class="form-horizontal" action="./admin/addLocations.php" method="post">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-9">
                    <input name="name" class="form-control" id="name" placeholder="Location name">
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-9">
                    <textarea name="description" class="form-control" rows="4" placeholder="Location description"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="state" class="col-sm-2 control-label">State ID</label>
                <div class="col-sm-2">
                    <input name="state" class="form-control" id="state" placeholder="StateID">
                </div>
            </div>
            <div class="form-group">
                <label for="type" class="col-sm-2 control-label">Type</label>
                <div class="col-sm-1">
                    <input name="type" class="form-control" id="type" placeholder="Type">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button name="saveForm" type="submit" class="btn btn-success">Add location</button>
                    <button name='reset' type="reset" class="btn btn-danger">Reset</button>
                </div>
            </div>

        </form>
    <?php endif; ?>

    <?php if($test === "addRoom") : ?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add room</h1>
            </div>
        </div>
        <form class="form-horizontal" action="./admin/addRooms.php" method="post">
            <div class="form-group">
                <label for="number" class="col-sm-2 control-label">Number</label>
                <div class="col-sm-4">
                    <input name="number" class="form-control" id="number" placeholder="Room number">
                </div>
            </div>
            <div class="form-group">
                <label for="size" class="col-sm-2 control-label">Size</label>
                <div class="col-sm-4">
                    <input name="size" class="form-control" id="size" placeholder="Room size">
                </div>
            </div>
            <div class="form-group">
                <label for="price" class="col-sm-2 control-label">Price</label>
                <div class="col-sm-4">
                    <input name="price" class="form-control" id="price" placeholder="Price per day">
                </div>
            </div>
            <div class="form-group">
                <label for="accomodation" class="col-sm-2 control-label">Accomodation</label>
                <div class="col-sm-2">
                    <input name="accomodation" class="form-control" id="accomodation" placeholder="Accomodation ID">
                </div>
            </div>
            <div class="form-group">
                <label for="type" class="col-sm-2 control-label">Type</label>
                <div class="col-sm-1">
                    <input name="type" class="form-control" id="type" placeholder="Room type">
                </div>
            </div>
            <div class="form-group">
                <label for="free" class="col-sm-2 control-label">Free</label>
                <div class="col-sm-1">
                    <input name="free" class="form-control" id="free" placeholder="Free">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button name="saveForm" type="submit" class="btn btn-success">Add room</button>
                    <button name='reset' type="reset" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </form>
    <?php endif; ?>

    <?php if($test === "addHotelContent") : ?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add hotel content</h1>
            </div>
        </div>
        <form class="form-horizontal" action="./admin/addHotelContent.php" method="post">
            <div class="form-group">
                <label for="content" class="col-sm-2 control-label">Content</label>
                <div class="col-sm-4">
                    <input name="content" class="form-control" id="content" placeholder="Hotel content name">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button name="saveForm" type="submit" class="btn btn-success">Add hotel content</button>
                    <button name='reset' type="reset" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </form>
    <?php endif; ?>

    <?php if($test === "addImage") : ?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add image</h1>
            </div>
        </div>
        <form class="form-horizontal" action="./admin/addImages.php" method='post'>
            <div class="form-group">
                <label for="slika1" class="col-sm-2 control-label">Image</label>
                <div class="col-sm-9">
                    <input id="slika1" name="slika1" type="text" class="form-control" placeholder="Image URL">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button name='saveForm' type="submit" class="btn btn-success">Add image</button>
                    <button name='reset' type="reset" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </form>
    <?php endif; ?>

    <?php if($test === "addCountry") : ?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add country</h1>
            </div>
        </div>
        <form class="form-horizontal" action="./admin/addCountry.php" method='post'>
            <div class="form-group">
                <label for="country" class="col-sm-2 control-label">Image</label>
                <div class="col-sm-4">
                    <input id="country" name="country" type="text" class="form-control" placeholder="Country name">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button name='saveForm' type="submit" class="btn btn-success">Add country</button>
                    <button name='reset' type="reset" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </form>
    <?php endif; ?>

    <?php if($test === "addCustomer") : ?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add customer</h1>
            </div>
        </div>
        <form class="form-horizontal" action="./admin/addCustomers.php" method="post">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">First name</label>
                <div class="col-sm-9">
                    <input name="name" class="form-control" id="name" placeholder="First name">
                </div>
            </div>
            <div class="form-group">
                <label for="surname" class="col-sm-2 control-label">Last name</label>
                <div class="col-sm-9">
                    <input name="surname" class="form-control" id="surname" placeholder="Last name">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">E-mail</label>
                <div class="col-sm-9">
                    <input name="email" class="form-control" id="email" placeholder="E-mail">
                </div>
            </div>
            <div class="form-group">
                <label for="year" class="col-sm-2 control-label">Year</label>
                <div class="col-sm-3">
                    <input name="year" class="form-control" id="year" placeholder="Year of birth">
                </div>
            </div>
            <div class="form-group">
                <label for="number" class="col-sm-2 control-label">Number</label>
                <div class="col-sm-3">
                    <input name="number" class="form-control" id="number" placeholder="Phone number">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button name="saveForm" type="submit" class="btn btn-success">Add customer</button>
                    <button name='reset' type="reset" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </form>
    <?php endif; ?>

    <?php if($test === "addAction") : ?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add country</h1>
            </div>
        </div>
        <form class="form-horizontal" action="./admin/addActions.php" method='post'>
            <div class="form-group">
                <label for="action" class="col-sm-2 control-label">Image</label>
                <div class="col-sm-4">
                    <input id="action" name="action" type="text" class="form-control" placeholder="Discount percentage">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button name='saveForm' type="submit" class="btn btn-success">Add discount</button>
                    <button name='reset' type="reset" class="btn btn-danger">Reset</button>
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
