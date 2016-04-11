<!DOCTYPE html>
<html lang="en">

<head>

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
            <a class="navbar-brand" href="./admin.php">Admin</a>
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
                    </ul>
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
        echo "
    <!-- Page Heading -->
    <div class=\"row\">
        <div class=\"col-lg-12\">
            <h1 class=\"page-header\">Page Heading
                <small>Secondary Text</small>
            </h1>
        </div>
    </div>
    <!-- /.row -->

    <!-- Project One -->
    <div class=\"row\">
        <div class=\"col-md-6\">
            <a href=\"#\">
                <img class=\"img-responsive\" src=\"http://static.kigo.net/1810/images/slider/6.jpg\" alt=\"\">
            </a>
        </div>
        <div class=\"col-md-6\">
            <h3>Barcelona
            </h3>
            <h4>Subheading</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium veniam exercitationem expedita laborum at voluptate. Labore, voluptates totam at aut nemo deserunt rem magni pariatur quos perspiciatis atque eveniet unde.</p>
            <a class=\"btn btn-primary\" href=\"#\">View Project <span class=\"glyphicon glyphicon-chevron-right\"></span></a>
        </div>
    </div>
    <!-- /.row -->

    <hr>

    <!-- Project Two -->
    <div class=\"row\">
        <div class=\"col-md-6\">
            <a href=\"#\">
                <img class=\"img-responsive\" src=\"http://placehold.it/600x300\" alt=\"\">
            </a>
        </div>
        <div class=\"col-md-6\">
            <h3>Goran 2</h3>
            <h4>Subheading</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, odit velit cumque vero doloremque repellendus distinctio maiores rem expedita a nam vitae modi quidem similique ducimus! Velit, esse totam tempore.</p>
            <a class=\"btn btn-primary\" href=\"#\">View Project <span class=\"glyphicon glyphicon-chevron-right\"></span></a>
        </div>
    </div>
    <!-- /.row -->

    <hr>

    <!-- Project Three -->
    <div class=\"row\">
        <div class=\"col-md-6\">
            <a href=\"#\">
                <img class=\"img-responsive\" src=\"http://placehold.it/600x300\" alt=\"\">
            </a>
        </div>
        <div class=\"col-md-6\">
            <h3>Project Three</h3>
            <h4>Subheading</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, temporibus, dolores, at, praesentium ut unde repudiandae voluptatum sit ab debitis suscipit fugiat natus velit excepturi amet commodi deleniti alias possimus!</p>
            <a class=\"btn btn-primary\" href=\"#\">View Project <span class=\"glyphicon glyphicon-chevron-right\"></span></a>
        </div>
    </div>
    <!-- /.row -->

    <hr>

    <!-- Project Four -->
    <div class=\"row\">

        <div class=\"col-md-6\">
            <a href=\"#\">
                <img class=\"img-responsive\" src=\"http://placehold.it/600x300\" alt=\"\">
            </a>
        </div>
        <div class=\"col-md-6\">
            <h3>Project Four</h3>
            <h4>Subheading</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, quidem, consectetur, officia rem officiis illum aliquam perspiciatis aspernatur quod modi hic nemo qui soluta aut eius fugit quam in suscipit?</p>
            <a class=\"btn btn-primary\" href=\"#\">View Project <span class=\"glyphicon glyphicon-chevron-right\"></span></a>
        </div>
    </div>
    <!-- /.row -->

    <hr>

    <!-- Project Five -->
    <div class=\"row\">
        <div class=\"col-md-6\">
            <a href=\"#\">
                <img class=\"img-responsive\" src=\"http://placehold.it/600x300\" alt=\"\">
            </a>
        </div>
        <div class=\"col-md-6\">
            <h3>Project Five</h3>
            <h4>Subheading</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, quo, minima, inventore voluptatum saepe quos nostrum provident ex quisquam hic odio repellendus atque porro distinctio quae id laboriosam facilis dolorum.</p>
            <a class=\"btn btn-primary\" href=\"#\">View Project <span class=\"glyphicon glyphicon-chevron-right\"></span></a>
        </div>
    </div>
    <!-- /.row -->

    <hr>

    <!-- Pagination -->
    <div class=\"row text-center\">
        <div class=\"col-lg-12\">
            <ul class=\"pagination\">
                <li>
                    <a href=\"#\">&laquo;</a>
                </li>
                <li class=\"active\">
                    <a href=\"#\">1</a>
                </li>
                <li>
                    <a href=\"#\">2</a>
                </li>
                <li>
                    <a href=\"#\">3</a>
                </li>
                <li>
                    <a href=\"#\">4</a>
                </li>
                <li>
                    <a href=\"#\">5</a>
                </li>
                <li>
                    <a href=\"#\">&raquo;</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- /.row -->

    <hr>


        ";
    }

    if (isset($_GET['value'])) {
        $test = $_GET['value'];

        if ($test === "addLocation") {
            echo "
<!-- Page Heading -->
    <div class=\"row\">
        <div class=\"col-lg-12\">
            <h1 class=\"page-header\">Add new location</h1>
        </div>
    </div>
    <!-- /.row -->
    <form class=\"form-horizontal\" action=\"./admin/addLocations.php\" method=\"post\">
        <div class=\"form-group\">
            <label for=\"name\" class=\"col-sm-2 control-label\">Name</label>
            <div class=\"col-sm-9\">
                <input name=\"name\" class=\"form-control\" id=\"name\" placeholder=\"Location name\">
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"description\" class=\"col-sm-2 control-label\">Description</label>
            <div class=\"col-sm-9\">
                <textarea name=\"description\" class=\"form-control\" rows=\"4\" placeholder=\"Location description\"></textarea>
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"type\" class=\"col-sm-2 control-label\">Type</label>
            <div class=\"col-sm-9\">
                <input name=\"type\" class=\"form-control\" id=\"type\" placeholder=\"Location type\">
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"state\" class=\"col-sm-2 control-label\">State ID</label>
            <div class=\"col-sm-9\">
                <input name=\"state\" class=\"form-control\" id=\"state\" placeholder=\"StateID\">
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"slika\" class=\"col-sm-2 control-label\">Image</label>
            <div class=\"col-sm-9\">
                <input name=\"slika\" class=\"form-control\" id=\"slika\" placeholder=\"Location image url\">
            </div>
        </div>
        <div class=\"form-group\">
            <div class=\"col-sm-offset-2 col-sm-10\">
                <button type=\"submit\" class=\"btn btn-success\">Add location</button>
            </div>
        </div>
       
    </form>
            
            ";
        } else if ($test === "addAccomodation") {
            echo "
<!-- Page Heading -->
    <div class=\"row\">
        <div class=\"col-lg-12\">
            <h1 class=\"page-header\">Add new accomodation</h1>
        </div>
    </div>
    <!-- /.row -->
    <form class=\"form-horizontal\" action=\"./admin/addAccomodations.php\" method=\"post\">
        <div class=\"form-group\">
            <label for=\"hotel\" class=\"col-sm-2 control-label\">Tip</label>
            <div class=\"col-sm-9\">
                <div class=\"radio-inline\">
                    <label><input type=\"radio\" name=\"type\" value=\"hotel\">Hotel</label>
                </div>
                <div class=\"radio-inline\">
                    <label><input type=\"radio\" name=\"type\" value=\"apartman\">Apartman</label>
                </div>
            </div>
        </div>       
        <div class=\"form-group\">
            <label for=\"description\" class=\"col-sm-2 control-label\">Description</label>
            <div class=\"col-sm-9\">
                <textarea name=\"description\" class=\"form-control\" rows=\"4\" placeholder=\"Accomodation description\"></textarea>
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"address\" class=\"col-sm-2 control-label\">Address</label>
            <div class=\"col-sm-9\">
                <input name=\"address\" class=\"form-control\" id=\"address\" placeholder=\"Accomodation address\">
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"classification\" class=\"col-sm-2 control-label\">Clasification</label>
            <div class=\"col-sm-9\">
                <input name=\"classification\" class=\"form-control\" id=\"classification\" placeholder=\"Accomodation classification\">
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"location\" class=\"col-sm-2 control-label\">Location</label>
            <div class=\"col-sm-9\">
                <input name=\"location\" class=\"form-control\" id=\"location\" placeholder=\"Location id\">
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"discount\" class=\"col-sm-2 control-label\">Discount</label>
            <div class=\"col-sm-9\">
                <input name=\"discount\" class=\"form-control\" id=\"discount\" placeholder=\"Accomodation discount id\">
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"slika\" class=\"col-sm-2 control-label\">Image</label>
            <div class=\"col-sm-9\">
                <input name=\"slika\" class=\"form-control\" id=\"slika\" placeholder=\"Accomodation image url\">
            </div>
        </div>

        <div class=\"form-group\">
            <div class=\"col-sm-offset-2 col-sm-10\">
                <button name=\"submit\" class=\"btn btn-success\">Add location</button>
            </div>
        </div>
        
    </form>
            
            ";
        } else if ($test === "addTour") {
            echo "
<!-- Page Heading -->
    <div class=\"row\">
        <div class=\"col-lg-12\">
            <h1 class=\"page-header\">Add new tour</h1>
        </div>
    </div>
    <!-- /.row -->
    <form class=\"form-horizontal\" action=\"./admin/addTours.php\" method=\"post\">
        <div class=\"form-group\">
            <label for=\"description\" class=\"col-sm-2 control-label\">Description</label>
            <div class=\"col-sm-9\">
                <textarea name=\"description\" class=\"form-control\" rows=\"4\" placeholder=\"Tour description\"></textarea>
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"starting\" class=\"col-sm-2 control-label\">Starting time</label>
            <div class=\"col-sm-9\">
                <input name=\"starting\" class=\"form-control\" id=\"starting\" placeholder=\"Starting time\">
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"duratino\" class=\"col-sm-2 control-label\">Tour duration</label>
            <div class=\"col-sm-9\">
                <input name=\"duration\" class=\"form-control\" id=\"duration\" placeholder=\"Tour duration\">
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"price\" class=\"col-sm-2 control-label\">Price</label>
            <div class=\"col-sm-9\">
                <input name=\"price\" class=\"form-control\" id=\"price\" placeholder=\"Price per person\">
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"company\" class=\"col-sm-2 control-label\">Company</label>
            <div class=\"col-sm-9\">
                <input name=\"company\" class=\"form-control\" id=\"company\" placeholder=\"Company name\">
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"location\" class=\"col-sm-2 control-label\">Location</label>
            <div class=\"col-sm-9\">
                <input name=\"location\" class=\"form-control\" id=\"location\" placeholder=\"Location ID\">
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"discount\" class=\"col-sm-2 control-label\">Discount</label>
            <div class=\"col-sm-9\">
                <input name=\"discount\" class=\"form-control\" id=\"discount\" placeholder=\"Tour discount\">
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"slika\" class=\"col-sm-2 control-label\">Image</label>
            <div class=\"col-sm-9\">
                <input name=\"slika\" class=\"form-control\" id=\"slika\" placeholder=\"Tour image url\">
            </div>
        </div>

        <div class=\"form-group\">
            <label for=\"guide\" class=\"col-sm-2 control-label\">Tour guide included</label>
                <div class=\"checkbox\">
                    <label><input type=\"checkbox\" name=\"guide\" value=\"\"></label>
                </div>
            <label for=\"meal\" class=\"col-sm-2 control-label\">Meal included</label>
                <div class=\"checkbox\">
                    <label><input type=\"checkbox\" name=\"meal\" value=\"\"></label>
                </div>
            <label for=\"tickets\" class=\"col-sm-2 control-label\">Tickets included</label>
                <div class=\"checkbox\">
                    <label><input type=\"checkbox\" name=\"tickets\" value=\"\"></label>
                </div>
        </div> 
        
        <div class=\"form-group\">
            <div class=\"col-sm-offset-2 col-sm-10\">
                <button type=\"submit\" class=\"btn btn-success\">Add location</button>
            </div>
        </div>
        
    </form>
            
            ";
        } else if ($test === "removeLocation") {
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
        } else if ($test === "addRoom") {
            echo "
            <div class=\"row\">
                <div class=\"col-lg-12\">
                    <h1 class=\"page-header\">Add room</h1>
                </div>
            </div>
            <form class=\"form-horizontal\" action=\"./admin/addRooms.php\" method=\"post\">
                <div class=\"form-group\">
                    <label for=\"number\" class=\"col-sm-2 control-label\">Number</label>
                    <div class=\"col-sm-9\">
                        <input name=\"number\" class=\"form-control\" id=\"number\" placeholder=\"Room number\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label for=\"size\" class=\"col-sm-2 control-label\">size</label>
                    <div class=\"col-sm-9\">
                        <input name=\"size\" class=\"form-control\" id=\"size\" placeholder=\"Room size\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label for=\"type\" class=\"col-sm-2 control-label\">Type</label>
                    <div class=\"col-sm-9\">
                        <input name=\"type\" class=\"form-control\" id=\"type\" placeholder=\"Room type\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label for=\"price\" class=\"col-sm-2 control-label\">Price</label>
                    <div class=\"col-sm-9\">
                        <input name=\"price\" class=\"form-control\" id=\"price\" placeholder=\"Price per day\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label for=\"accomodation\" class=\"col-sm-2 control-label\">Accomodation</label>
                    <div class=\"col-sm-9\">
                        <input name=\"accomodation\" class=\"form-control\" id=\"accomodation\" placeholder=\"Accomodation ID\">
                    </div>
                </div>
                <label for=\"free\" class=\"col-sm-2 control-label\">Free</label>
                <div class=\"checkbox\">
                    <label><input type=\"checkbox\" name=\"free\" value=\"\"></label>
                </div>

                <div class=\"form-group\">
                    <div class=\"col-sm-offset-2 col-sm-10\">
                    <button name=\"submit\" class=\"btn btn-success\">Add room</button>
                    </div>
                </div>
            </form>
            ";
        } else if ($test === "addHotelContent") {
            echo "
            <div class=\"row\">
                <div class=\"col-lg-12\">
                    <h1 class=\"page-header\">Add content</h1>
                </div>
            </div>
            <form class=\"form-horizontal\" action=\"./admin/addHotelContent.php\" method=\"post\">
                <div class=\"form-group\">
                    <label for=\"content\" class=\"col-sm-2 control-label\">Content</label>
                    <div class=\"col-sm-9\">
                        <input name=\"content\" class=\"form-control\" id=\"content\" placeholder=\"Hotel content description\">
                    </div>
                </div>

                <div class=\"form-group\">
                    <div class=\"col-sm-offset-2 col-sm-10\">
                    <button name=\"submit\" class=\"btn btn-success\">Add hotel content</button>
                    </div>
                </div>
            </form>
            ";
        } else if ($test === "addAction") {
            echo "
            <div class=\"row\">
                <div class=\"col-lg-12\">
                    <h1 class=\"page-header\">Add discount</h1>
                </div>
            </div>
            <form class=\"form-horizontal\" action=\"./admin/addActions.php\" method=\"post\">
                <div class=\"form-group\">
                    <label for=\"discount\" class=\"col-sm-2 control-label\">Discount</label>
                    <div class=\"col-sm-9\">
                        <input name=\"discount\" class=\"form-control\" id=\"discount\" placeholder=\"Discount percentage\">
                    </div>
                </div>

                <div class=\"form-group\">
                    <div class=\"col-sm-offset-2 col-sm-10\">
                    <button name=\"submit\" class=\"btn btn-success\">Add action</button>
                    </div>
                </div>
            </form>
            ";
        } else if ($test === "addCustomer") {
            echo "
            <div class=\"row\">
                <div class=\"col-lg-12\">
                    <h1 class=\"page-header\">Add customer</h1>
                </div>
            </div>
            <form class=\"form-horizontal\" action=\"./admin/addCustomers.php\" method=\"post\">
                <div class=\"form-group\">
                    <label for=\"name\" class=\"col-sm-2 control-label\">First name</label>
                    <div class=\"col-sm-9\">
                        <input name=\"name\" class=\"form-control\" id=\"name\" placeholder=\"First name\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label for=\"surname\" class=\"col-sm-2 control-label\">Last name</label>
                    <div class=\"col-sm-9\">
                        <input name=\"surname\" class=\"form-control\" id=\"surname\" placeholder=\"Last name\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label for=\"email\" class=\"col-sm-2 control-label\">E-mail</label>
                    <div class=\"col-sm-9\">
                        <input name=\"email\" class=\"form-control\" id=\"email\" placeholder=\"E-mail\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label for=\"year\" class=\"col-sm-2 control-label\">Year</label>
                    <div class=\"col-sm-9\">
                        <input name=\"year\" class=\"form-control\" id=\"year\" placeholder=\"Year of birth\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label for=\"number\" class=\"col-sm-2 control-label\">Number</label>
                    <div class=\"col-sm-9\">
                        <input name=\"number\" class=\"form-control\" id=\"number\" placeholder=\"Phone number\">
                    </div>
                </div>

                <div class=\"form-group\">
                    <div class=\"col-sm-offset-2 col-sm-10\">
                    <button name=\"submit\" class=\"btn btn-success\">Add customer</button>
                    </div>
                </div>
            </form>
            ";
        }

    } ?>

    <?php if($test === "addImage") : ?>
        <form class="form-horizontal" action="" method='post'>
            <div class="form-group">
                <label for="slika1" class="col-sm-2 control-label">Image</label>
                <div class="col-sm-9">
                    <input id="slika1" name="slika1" type="text" class="form-control" placeholder="Image URL">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button name='saveForm' type="submit" class="btn btn-success">Add image</button>
                </div>
            </div>
        </form>
    <?php endif; ?>

    <?php if (isset($_POST['saveForm'])) {
        $img = $_POST['slika1'];
        echo "$img";
    } else {
        echo "nothing posted";
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
