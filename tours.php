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
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">TOURS</h2>
        </div>
    </div>
    <!-- /.row -->

    <!-- Project One -->
    <?php
    include './admin/spajanje_na_bazu.php';
    include './admin/funkcije.php';
    $upit = "SELECT idIzlet, naziv, opis FROM izlet ORDER BY naziv ASC";
    $rezultat = mysqli_query($veza, $upit) or die (mysqli_error($veza));
    $page = $_GET['page'];
    if (mysqli_num_rows($rezultat) % 5 == 0) {
        $numberOfPages = intval(mysqli_num_rows($rezultat) / 5);
    } else {
        $numberOfPages = intval(mysqli_num_rows($rezultat) / 5) + 1;
    }
    $skip = 0;
    if ($page != 1) {
        $skip = ($page - 1) * $numberOfPages;
    }
    $itemsPerPage = ceil(mysqli_num_rows($rezultat) / $numberOfPages);
    $number = 0;
    while ($redak = mysqli_fetch_array($rezultat, MYSQLI_ASSOC)) {
        if ($skip != 0) {
            $skip--;
            continue;
        }
        if ($number == $itemsPerPage) {
            break;
        }
        $izlet = $redak['idIzlet'];
        $ime = $redak['naziv'];
        $opis = $redak['opis'];
        $upit2 = "SELECT idSlika FROM slike_izlet WHERE idIzlet = $izlet";
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
                        <a class=\"btn btn-primary\" href=\"./learnMoreTour.php?value=$izlet\">Learn more <span class=\"glyphicon glyphicon-chevron-right\"></span></a>
                        <a style='margin-left: 25px' class=\"btn btn-success\" href=\"./addTourCustomer.php?value=$izlet\">Reserve tour <span class=\"glyphicon glyphicon-chevron-right\"></span></a>
                   </div>";
        echo "</div>";
        echo "<hr>";
        $number++;
    };
    echo "<div class=\"row text-center\">
        <div class=\"col-lg-12\">
            <ul class=\"pagination\">
                <li>";
    if ($page > 1) {
        $before = $page - 1;
    } else {
        $before = $page;
    }
    echo " <a href=\"./tours.php?page=$before\">&laquo;</a></li>";
    for ($j = 1; $j <= $numberOfPages; $j++) {
        $z = $j;
        if ($page == $z) {
            echo "<li class=\"active\">
                            <a href=\"./tours.php?page=$z\">$z</a>
                            </li>";
        } else {
            echo "<li>
                            <a href=\"./tours.php?page=$z\">$z</a>
                            </li>";
        }
    };
    if ($page == $numberOfPages) {
        $after = $page;
    } else {
        $after = $page + 1;
    }
    echo "<li><a href=\"./tours.php?page=$after\">&raquo;</a>
                </li>
            </ul>
        </div>
    </div>";
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