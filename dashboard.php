<?php
if(!isset($_COOKIE["email"]))
{
    ob_start();
    header("location: http://myplanner.web.engr.illinois.edu/index.php");
    ob_end_flush();
}
include("db_config.php");
$servername = $DB_SERVER_NAME;
$username = $DB_USERNAME;
$password = $DB_PASSWORD;
$dbname = $DB_NAME;
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error)
{
    die('Connection Failed: ' . $conn->connect_error);
}
?>
<html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""><!--<![endif]-->
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
    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script src="js/main.js"></script>
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

<div class="container">
    <span class="text-center sm-col-12">
       
    </span>
    <div class="container">
        <!-- Navigation -->
        <?php
        $selected = "Dashboard";
        include "nav_bar.php";
        ?>
        <div id="page-wrapper">
        <?php
        echo "<p class=\"text-center\"> User Connected:" . $_COOKIE['email'] . "</p>";
        ?>
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>Statistics Overview</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Below You Will Find Some Statistics compared to your schoolmates!</strong>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                            <?php
                                            $query = "SELECT COUNT(university) AS 'count' FROM user WHERE university = (SELECT university FROM user WHERE email='". $_COOKIE['email'] ."' ); ";
                                            $result = $conn->query($query);
                                            $res = $result->fetch_row();
                                            echo $res[0];
                                            ?>
                                        </div>
                                        <div>Students From Your School</div>
                                    </div>
                                </div>
                            </div>
                                <div class="panel-footer">
                                    <span class="pull-left"><?php
                                            $query = "SELECT university FROM user WHERE email = '". $_COOKIE['email'] ."'; ";
                                            $result = $conn->query($query);
                                            $res = $result->fetch_row();
                                            echo "You go to: ".$res[0];
                                            ?></span>
                                    <div class="clearfix"></div>
                                </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                            <?php
                                            $query = "SELECT COUNT(*) AS 'count' FROM assignments WHERE email = '". $_COOKIE['email'] ."'";
                                            $result = $conn->query($query);
                                            $res = $result->fetch_row();
                                            echo $res[0];
                                            ?>
                                        </div>
                                        <div>
                                            Uncompleted Tasks.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="/tasks.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Hours Worked Compared to Your Classmates.</h3>
                                </div>
                                <div class="panel-body">
                                    <div id="morris-area-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> Top 5 Most Time Consuming Classes.</h3>
                                </div>
                                <div class="panel-body">
                                    <div id="morris-donut-chart"></div>
                                    <div class="text-right">
                                        <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-lg-12">

                    	<div class="panel panel-default">
                    	<div class="panel-heading">
                                    <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i>Where You At?</h3>
                                </div>
                    	                    	                                <div class="panel-body">

	                    	<table class="table table-bordered table-hover">
	                    	<thead>
	                    		<tr>
	                    		<th class="text-center">
			                        Class
			                    </th>
			                    <th class="text-center">
			                        Description
			                    </th>
			                    <th class="text-center">
			                        Your Progress
			                    </th>
			                    <th class="text-center">
			                        Class Overall Progress
			                    </th>
			                    </tr>
	                    	</thead>
	                    	<tbody>

<?php
								include("db_config.php");
								 $sql = "SELECT assignid, class, description, progress FROM `assignments` WHERE email= '" . $_COOKIE['email'] . "' ORDER BY duedate";
								$servername = $DB_SERVER_NAME;
								$username = $DB_USERNAME;
								$password = $DB_PASSWORD;
								$dbname = $DB_NAME;
								$conn = new mysqli($servername, $username, $password, $dbname);
								 if ($conn->connect_error)
								{
								 die('Connection Failed: ' . $conn->connect_error);
								} 
								if($result = $conn->query($sql))
								 {
								 	while($row = $result->fetch_array(MYSQL_ASSOC))
									{
										$tr = "<tr id=". $row['assignid'] . ">";
										$tr .= "<td>".$row['class']."</td>";
										$tr .= "<td>".$row['description']."</td>";
										$tr .= "<td class=\"progress_cell\"><div class=\"progress\"><div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"". $row['progress'] ."\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: " . $row['progress'] . "%\"></div></div></td>";
										 $sql2 = "SELECT IFNULL(AVG(progress),0) AS sum ";
										 $sql2 .= "FROM `assignments` AS a INNER JOIN `user` AS u ";
										 $sql2 .= "WHERE a.email = u.email AND university = (SELECT `university` FROM `user` WHERE email = '".$_COOKIE['email']."') ";
										 $sql2 .= "AND class = '".$row['class']."' AND description = '".$row['description']."'; ";
										if($class = $conn->query($sql2))
										{
											$row2 = $class->fetch_array(MYSQL_ASSOC);
											$tr .= "<td class=\"progress_cell\"><div class=\"progress\"><div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"".(int)$row2['sum']."\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: " . $row2['sum'] . "%\"></div></div></td>";
										}
										$tr .= "</tr>";
										echo $tr;
									}
								 }else{
								 	echo alert("error");
								}
								?>
								</tbody>
                    	</table>
                    	</div>
                    	</div>
                    	</div>
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- /#page-wrapper -->

            </div>
        </div>
        <footer class="text-center">
            <p>&copy; Dat Bass Doe 2015</p>
        </footer>
    </div> <!-- /container -->

    <script src="js/vendor/bootstrap.min.js"></script>
    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/charts.js"></script>

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