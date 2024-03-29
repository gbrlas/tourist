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


    <?php
    if (isset($_GET['type'])) {
        $temp = ucfirst($_GET['type']);

        echo "<title>Tourist Agency - $temp</title>";
    }
    ?>

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

    <!-- Project One -->
    <?php
        if (isset($_GET['type'])) {
            $temp = $_GET['type'];
            $page = $_GET['page'];
            $type;

            if ($temp == "summer") {
                echo "
                    <div class=\"row\">
        <div class=\"col-lg-12\">
            <h2 class=\"page-header\">LJETNE DESTINACIJE</h2>
        </div>
    </div>";
                $type = 1;
            } elseif ($temp == "winter") {
                echo "
                    <div class=\"row\">
        <div class=\"col-lg-12\">
            <h2 class=\"page-header\">ZIMSKE DESTINACIJE</h2>
        </div>
    </div>";
                $type = 2;
            } else if ($temp == "cities") {
                echo "
                    <div class=\"row\">
        <div class=\"col-lg-12\">
            <h2 class=\"page-header\">GRADSKE DESTINACIJE</h2>
        </div>
    </div>";
                $type = 3;
            }

            include './admin/spajanje_na_bazu.php';
            include './admin/funkcije.php';
            $upit = "SELECT idLokacija, ime, opis, tip, idDrzava FROM lokacija WHERE tip = $type ORDER BY ime";
            $rezultat = mysqli_query($veza, $upit) or die (mysqli_error($veza));

            if (mysqli_num_rows($rezultat) % 5 == 0) {
                $numberOfPages = intval(mysqli_num_rows($rezultat) / 5);
            } else {
                $numberOfPages = intval(mysqli_num_rows($rezultat) / 5) + 1;
            }

            $skip = 0;



            $itemsPerPage = 5;
            if ($page != 1) {
                $skip = ($page - 1) * $itemsPerPage;
            }

            $number = 0;
            while ($redak = mysqli_fetch_array($rezultat, MYSQLI_ASSOC)) {
                if ($skip != 0) {
                    $skip--;
                    continue;
                }

                if ($number == $itemsPerPage) {
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
                            <img class=\"img-responsive\" src=\"./images/$url\" width=\"600\" height=\"300\" alt=\"\">
                    </div>";

                echo "<div class=\"col-md-6\">
                        <h3>$ime</h3>
                            <p>$opis</p>
                        <a class=\"btn btn-primary\" href=\"./learnMoreDest.php?value=$lokacija\">Saznajte više <span class=\"glyphicon glyphicon-chevron-right\"></span></a>
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

                   echo " <a href=\"./destinations.php?type=$temp&page=$before\"><b>&laquo;</b></a></li>";

                    for ($j = 1; $j <= $numberOfPages; $j++) {
                        $z = $j;

                        if ($page == $z) {
                            echo "<li class=\"active\">
                            <a href=\"./destinations.php?type=$temp&page=$z\">$z</a>
                            </li>";
                        } else {
                            echo "<li>
                            <a href=\"./destinations.php?type=$temp&page=$z\">$z</a>
                            </li>";
                        }
                    };

                    if ($page == $numberOfPages) {
                        $after = $page;
                    } else {
                        $after = $page + 1;
                    }

                    echo "<li><a href=\"./destinations.php?type=$temp&page=$after\"><b>&raquo;</b></a>
                </li>
            </ul>
        </div>
    </div>";

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
