<?php
if(!isset($_COOKIE["email"]))
{
    ob_start();
    header("location: http://myplanner.web.engr.illinois.edu/index.php");
    ob_end_flush(); 
}
?>
<html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel='stylesheet' href='bower_components/fullcalendar/dist/fullcalendar.css' />
    <script src='bower_components/jquery/dist/jquery.min.js'></script>
    <script src='bower_components/moment/moment.js'></script>
    <script src='bower_components/fullcalendar/dist/fullcalendar.js'></script>
    <script src='bower_components/jquery-cookie/jquery.cookie.js'></script>
    <script src="js/search.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            padding-top: 50px;
            padding-bottom: 20px;
        }
    </style>
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/main.css">
    
    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js">
    </script>
</head>
<body>

        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]-->
        <?php
        $selected = "Search";
        include "nav_bar.php";
        ?>
</nav>
<div class="container">
<div class="row">
<span class="text-center sm-col-12">
<?php 
echo "<p> User Connected:" . $_COOKIE['email'] . "</p>";
?>
</span>
</div>
<div class="row"> 
        <form role="form" class="form-search" method="post">
            <div class="form-group">
                <div class="col-sm-8 col-sm-offset-2">
                    <input type="text" class="form-control" id="title-search" placeholder="Title">
                </div>
            </div>
        </form>
</div>
<div class="row">
    <div class="col-sm-12 col-md-8 col-md-offset-2 centered">
        <table id="results-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>date</th>
                    <th>start time</th>
                    <th>end time</th>
                    <th class="minimal-cell"></th>
                </tr>
            </thead>
            <tbody id="results">

            </tbody>
        </table>
    <div>
</div>


        <footer class="text-center">
            <p>&copy; Dat Bass Doe 2015</p>
        </footer>
        </div>

    </div> <!-- /container -->        
    <script src="js/vendor/bootstrap.min.js"></script>
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
        (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='//www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
        ga('create','UA-XXXXX-X','auto');ga('send','pageview');
    </script>

</body>
</html>