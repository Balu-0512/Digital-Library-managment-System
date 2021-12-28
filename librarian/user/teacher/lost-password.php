<?php
    include 'inc/connection.php';
    $errors =[];
    use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\SMTP;


    if (isset($_POST["reset-password"])) {
        $email = $_POST['email'];
        $sql = mysqli_query($link,"SELECT * FROM t_registration WHERE email='$email'");
        while($row = mysqli_fetch_array($sql)) {
            $password = $row['password'];
        }
        if (empty($email)) {
            array_push($errors, "Your email is required");
            echo implode(" ",$errors);
        }else if(mysqli_num_rows($sql) <= 0) {
            array_push($errors, "Sorry, no user exists on our system with that email");
            echo implode(" ",$errors);
        }

            

            //Load Composer's autoloader
            require 'PHPMailer/src/Exception.php';
            require 'PHPMailer/src/PHPMailer.php';
            require 'PHPMailer/src/SMTP.php';
            require 'inc/connection.php';
        if (count($errors) == 0) {
          /*  $to = "$email";
            $subject = "Forgot password";
            $message = "Your password is $password";
            $headers = "From: parttimemail18@gmail.com \r\n";
            $headers.= "MIME-Version: 1.0". "\r\n";
            $headers.= "Content-type: text/html; charset-UTF-8". "\r\n";
            mail($to, $subject, $message,$headers);
            header('location: login.php');*/



            if (isset($_POST["email"])) {

                $emailto=$_POST["email"];
                $code=uniqid(true);
                $query=mysqli_query($link,"INSERT INTO resetpassword(email,code) VALUES ('$email','$code')");
                if (!$query) {
                    exit("error");
                }
                $mail = new PHPMailer(true);

            try {
                //Server settings                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                 $mail->Username   = 'canigetyourwhatsappnumber1@gmail.com';                     //SMTP username
                $mail->Password   = 'uuqrajwofvxptwwp';                               //SMTP password
                $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    

                //Recipient
                $mail->setFrom('canigetyourwhatsappnumber1@gmail.com','library');
                $mail->addAddress($emailto);     //Add a recipient
                     


              

                //Content
                $url="http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/reset-password.php?code=$code";
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Your Password Reset Link';
                $mail->Body    = "<h1>YOU REQUESTED A PASSWORD RESET</h1>
                                    Click <a href='$url'>This Link</a> to do so ";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                header('location: reset-thankyou.php');
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            }

        }
        
    }
?>
<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Management System</title>
    <style>
        body{
            background: lightblue;
            padding: 100px;
        }
        .thankyou-content{
            width: 850px;
            margin: 0 auto;
        }
        img{
            margin-top: 15px;
        }

    </style>
</head>
<body>
<form class="login-form" action="lost-password.php" method="post">
    <h2 class="form-title">Reset password</h2>
     form validation messages 

    <div class="form-group">
        <label>Your email address</label> <br>
        <input type="email" name="email">
    </div>
    <div class="form-group">
        <button type="submit" name="reset-password" class="login-btn">Submit</button>
    </div>
</form>
</body>
</html> -->




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
            background-image: url(inc/img/lib.jpg);
            margin-bottom: 30px; 
            padding: 50px;
            padding-bottom: 80px;
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
                    <form action="lost-password.php" method="post">
                        <div class="mb-20">
                            <input type="email" name="email" class="form-control" placeholder="Email" required=""/>
                        </div>
                        <div class="mb-20">
                            <input class="btn btn-info submit" type="submit" name="reset-password" value="Login">
                            
                        </div>
                    </form>
                </div>
                <div class="login-footer text-center">
                    <div class="separator">
                        <p class="change_link">New to site?
                            <a href="registration.php" class="text-right"> Create Account </a>
                        </p>
                    </div>
                </div>

     
