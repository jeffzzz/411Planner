<?php
include("db.php");

function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL)
    && preg_match('/@.+\./', $email);
}

if(isset($_COOKIE["email"]))
{
    ob_start();
    header("location: http://myplanner.web.engr.illinois.edu/myplanner.php");
    ob_end_flush();
}
$error_login = ""; //login combination incorrect
$email_error = ""; //signup email wrong or empty
$password_error = "";
if($conn->real_escape_string($_POST['submit']) == "login") {
    //if login submitted
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    if(!empty($email) && !empty($password)) {
        $sql = "SELECT count(*) FROM user WHERE email='" . $email . "' and password=PASSWORD('" . $password . "')";
        $result = $conn->query($sql);
        if ($result->fetch_row()[0] > 0) {
            unset($_COOKIE['email']);
            setcookie('email', $email, strtotime("2 days"), "/");
            $row = $result->fetch_assoc();
            header("location: http://myplanner.web.engr.illinois.edu/myplanner.php");
            exit();
        } else {
            $error_login = "has-error";
        }
    }else{
        $error_login = "has-error";
    }
    $conn->close();
}else if($conn->real_escape_string($_POST['submit']) == "signup")
{
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $university = $conn->real_escape_string($_POST['university']);
    $validEmail = isValidEmail($email);
    $validPass = !empty($password);
    $validUni = !empty($university);
    if($validEmail && $validPass && $validUni)
    {
        $exists = $conn->query("SELECT `email` FROM `user` WHERE `email` = '".$email."'");
        if(mysqli_num_rows($exists))
        {
            $email_error = "has-error";
        }else{
            $sql = "INSERT INTO `user` (`email`, `password`, `university`) VALUES ('" . $email . "' , PASSWORD('" . $password . "'), '" . $university . "')";
             
             $exists = $conn->query($sql);
                        setcookie('email', $email, strtotime("2 days"), "/");
            header("location: http://myplanner.web.engr.illinois.edu/myplanner.php");
        }
    }else{
        if(!$validEmail)
        {
            $email_error = "has-error";
        }
        if(!$validPass)
        {
            $password_error = "has-error";
        }
        if(!$validUni)
        {
            $university_error = "has-error";
        }

    }


}
?>
<!DOCTYPE html>
<html lang="en">
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
            <form class="navbar-form navbar-right" role="form" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                <div class="form-group <?php echo $error_login; ?>">
                    <input type="text" placeholder="Email" name="email" class="form-control" value="<?php echo htmlentities($email); ?>">
                </div>
                <div class="form-group <?php echo $error_login; ?>">
                    <input type="password" placeholder="Password" name="password" class="form-control">
                </div>
                <button type="submit" name="submit" value="login" class="btn btn-success">Sign in</button>
            </form>
        </div><!--/.navbar-collapse -->
    </div>
</nav>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="container">
        <h1>Need an account?</h1>
        <p>Sign up below</p>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h5 class="text-center">
                            SIGN UP</h5>
                        <form class="form form-signup" role="form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" accept-charset="UTF-8">
                            <div class="form-group <?php echo $email_error; ?>">
                                <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                            </span>
                                    <input type="text" name="email" class="form-control" placeholder="Email Address" />
                                </div>
                            </div>
                            <div class="form-group  <?php echo $password_error; ?>">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                    <input name="password" type="password" class="form-control" placeholder="Password" />
                                </div>
                            </div>
                            <div class="form-group <?php echo $university_error; ?>">
                                <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-book"></span>
                        </span>
                                    <input type="text" name="university" class="form-control" placeholder="University" />
                                </div>
                            </div>
                    </div>
                    <div>
                        <?php
                            if(!empty($email_error))
                            {
                                echo '<p style="color:red; font-size:12px; text-align: center;">That is not an email or email already exists.</p>';
                            }if(!empty($password_error))
                            {
                                echo '<p style="color:red; font-size:12px; text-align: center;">You forgot to input a password.</p>';
                            }if(!empty($university_error))
                            {
                                echo '<p style="color:red; font-size:12px; text-align: center;">You forgot to input your university.</p>';
                            }

                        ?>
                    </div>
                    <button type="submit" name="submit" value="signup" class="btn btn-sm btn-primary btn-block" >
                        SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<footer class="text-center">
    <p>&copy; Dat Bass Doe 2015</p>
</footer>
</div> <!-- /container -->        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

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
