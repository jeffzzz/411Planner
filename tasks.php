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
    <script src="js/main.js"></script>
    <script src="js/tasks.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            padding-top: 50px;
            padding-bottom: 20px;
        }
    </style>
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/main.css">

    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<?php
$selected = "Tasks";
include "nav_bar.php";
?>
<div class="container">
    <span class="text-center sm-col-12">
        <?php
        echo "<p> User Connected:" . $_COOKIE['email'] . "</p>";
        ?>
    </span>
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-offset-2 col-md-8 column">
            <form class="form" id="create_assignment">
				  <div class="form-group">
				    <label for="class">Class</label>
				    <input type="text" name='class'  placeholder='Name' class="form-control" id='class'/>
				  </div>
				  <div class="form-group">
				    <label for="desc">Description</label>
                    <input type="text" name='desc' placeholder='i.e. MP1' class="form-control" id='desc'/>
				  </div>
				  <div class="form-group">
				    <label for="due">Due Date</label>
                            <input type="date" name='due' placeholder='When is it due?' creatclass="form-control" id="due"/>
				  </div>
				  <div class="form-group">
				    <label for="est"> Estimated Time?</label>
                            <input type="text" name='est' placeholder='How many hours?' class="form-control" id="est"/>
				  </div>
				  <div class="form-group">
				    <label for="hoursworked">Hours Worked?</label>
                            <input type="text" name='hoursworked' placeholder='[whole number]' class="form-control" id="hoursworked"/>
				  </div>
				  <div class="form-group">
				    <label for="percentcomp">Percent Complete?</label>
                     <input type="text" name='percentcomp' placeholder='0-100?' class="form-control" id="percentcomp"/>
				  </div>
			<button type="button" id="add_row" class="btn btn-default">Add HW</button>
				</form>
				            </div>
        </div>
        <div class="col-md-12 column" style="margin-top:20px;">
            <table style="" class="table table-bordered table-hover" id="task-table">
                <thead>
                <tr >
					<th class="text-center">
                        Due Date
                    </th>
                    <th class="text-center">
                        Class
                    </th>
                    <th class="text-center">
                        Description
                    </th>
                    <th class="text-center">
                        Progress
                    </th>
                    <th class="text-center">

                    </th>
                </tr>
                </thead>
                <tbody>
                	<?php
                	include("load_assignments.php");
                	?>
                </tbody>
            </table>
        </div>
    </div>
    <footer class="text-center">
        <p>&copy; Dat Bass Doe 2015</p>
    </footer>
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