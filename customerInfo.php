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
            <a class="navbar-brand" href="#">TOURIST AGENCY</a>
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
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Please provide your information</h2>
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



