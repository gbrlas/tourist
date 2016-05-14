<!DOCTYPE html>
<html lang="en">

<head>

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
    <script src="../https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="../https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
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
            <a class="navbar-brand" href="../admin.php">Admin</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Locations
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../admin.php?value=addLocation">Add locations</a></li>
                        <li><a href="../admin.php?value=removeLocation">Remove locations</a></li>
                        <li><a href="../admin.php?value=editLocation">Edit locations</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Accomodations
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../admin.php?value=addAccomodation">Add accomodations</a></li>
                        <li><a href="../admin.php?value=removeAccomodation">Remove accomodations</a></li>
                        <li><a href="../admin.php?value=editAccomodation">Edit accomodations</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Tours
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../admin.php?value=addTour">Add tours</a></li>
                        <li><a href="../admin.php?value=removeTour">Remove tours</a></li>
                        <li><a href="../admin.php?value=editTour">Edit tours</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Other
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../admin.php?value=addImage">Add image</a></li>
                        <li><a href="../admin.php?value=addRoom">Add room</a></li>
                        <li><a href="../admin.php?value=addHotelContent">Add hotel content</a></li>
                        <li><a href="../admin.php?value=addAction">Add discount</a></li>
                        <li><a href="../admin.php?value=addCustomer">Add customer</a></li>
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
    <div class="row">
        <div class="col-md-5">
            <h4>
                <?php
                include 'spajanje_na_bazu.php';
                include 'funkcije.php';

                if (isset($_POST['saveForm'])) {
                    $content = navodnici($_POST['content']);
                    $upit = "INSERT INTO sadrzaj (naziv) VALUES ($content)";
                    mysqli_query ($veza, $upit) or die (mysqli_error($veza));
                    echo "
                    <div class=\"col-md-6\">
                        <h4>Hotel content added: $content</h4>
                    </div>
                    ";
                }
                ?>
            </h4>
        </div>
    </div>
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
<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>

</body>

</html>






