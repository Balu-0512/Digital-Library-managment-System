<?php
include("inc/connection.php");
if(!isset($_GET["code"]))
{
	exit("Can't find page");
}
$code=$_GET["code"];
$getEmailQuery=mysqli_query($link,"SELECT email FROM resetpassword WHERE code='$code'");
if (mysqli_num_rows($getEmailQuery)==0) {
	exit("Can't find page");
}
$getEmailQuery=mysqli_query($link,"SELECT email FROM resetpassword WHERE code='$code'");
if(isset($_POST["password"]))
{
	$pw=$_POST["password"];
	$row= mysqli_fetch_array($getEmailQuery);
	$email = $row["email"];
	$query=mysqli_query($link,"UPDATE std_registration SET password='$pw' WHERE email='$email'");
	if ($query) {
		$query= mysqli_query($link,"DELETE FROM resetpassword WHERE code='$code'");
		header('location: after-pass-thankyou.php');
	}
	else{
		exit("Something Went Wrong");
	}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Management System</title>
    <link rel="stylesheet" href="inc/css/bootstrap.min.css">
    <link rel="stylesheet" href="inc/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="inc/css/pro1.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600" rel="stylesheet">
    <style>
        .login{
            background-image: url(inc/img/3.jpg);
            margin-bottom: 30px;
            padding: 50px;
            padding-bottom: 70px;
        }
        .reg-header h2{
            color: #DDDDDD;
            z-index: 999999;
        }
        .login-body h4{
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    
    <div class="login registration">
        <div class="wrapper">
            <div class="reg-header text-center">
                <h2>RESET PASSWORD</h2>
                <div class="gap-40"></div>
            </div>
            <div class="gap-30"></div>
            <div class="login-content">
                <div class="login-body">
                    <h4>Password Reset Form</h4>
                    <form action="" method="post">
                        <div class="mb-20">
                            <input type="password" name="password" class="form-control" placeholder="Password" required=""/>
                        </div>
                        <div class="mb-20">
                            <input class="btn btn-info submit" type="submit" name="reset-password" value="Update Password">
                            
                        </div>
                    </form>
                </div>
                 <div class="footer text-center">
        <p>&copy; All rights reserved ! GPT SDPT </p>
    </div>

    <script src="inc/js/jquery-2.2.4.min.js"></script>
    <script src="inc/js/bootstrap.min.js"></script>
    <script src="inc/js/custom.js"></script>
               

