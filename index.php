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
            background:
        }


    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tourist Agency</title>

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
            <a class="navbar-brand" href="./index.php">
                TOURIST AGENCY</a>
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
    
        echo "<div class=\"row\">
        <div class=\"col-lg-12\">
            <h2 class=\"page-header\">TOP 5 DESTINATIONS</h2>
        </div>
    </div>";
        $upit = "SELECT idLokacija, ime, opis, tip, idDrzava FROM lokacija WHERE tip != 5 ORDER BY pregledi DESC";
        $rezultat = mysqli_query($veza, $upit) or die (mysqli_error($veza));

        $i = 0;

        while ($redak = mysqli_fetch_array($rezultat, MYSQLI_ASSOC)) {
            if ($i >= 5) {
                break;
            }

            $lokacija = $redak['idLokacija'];
            $ime = $redak['ime'];
            $opis = $redak['opis'];
            $tip = $redak['tip'];

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
                        <a class=\"btn btn-primary\" href=\"./learnMoreDest.php?value=$lokacija\">Learn more <span class=\"glyphicon glyphicon-chevron-right\"></span></a>
                   </div>";

            echo "</div>";
            echo "<hr>";

            $i++;
        };
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
