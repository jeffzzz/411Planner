<?php
/**
 * Created by PhpStorm.
 * User: enriqueespaillat
 * Date: 4/15/15
 * Time: 6:09 PM
 */
$yourday = "";
$search = "";
$tasks = "";
$dashboard = "";
switch($selected){
    case "Your Day":
        $yourday = "active";
        break;
    case "Search":
        $search = "active";
        break;
    case "Tasks":
        $tasks = "active";
        break;
	case "Dashboard":
        $dashboard = "active";
        break;
}
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
              <div class="container">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">MyPlanner</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav nav-pills">
                 <li role="presentation" class="<?php echo $yourday;?>"><a href="myplanner.php">Your Day</a></li>
                <li role="presentation" class="<?php echo $search;?>"><a href="search.php">Search</a></li>
                  <li role="presentation" class="<?php echo $tasks;?>"><a href="tasks.php">Tasks</a></li>
                  <li role="presentation" class="<?php echo $dashboard;?>"><a href="dashboard.php">Dash</a></li>

                  <li role="presentation"><a href="#" id="logoff">Log Off</a></li>
            </ul>
        </div><!--/.navbar-collapse -->
    </div>
</nav>
