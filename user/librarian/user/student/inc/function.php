<?php
		use PHPMailer\PHPMailer\PHPMailer;
         use PHPMailer\PHPMailer\SMTP;

	if (isset($_POST["submit"])) {
		$name = $_POST["name"];
		$username = $_POST["username"];                   
		$password = $_POST["password"];
		$email = $_POST["email"];
		$phone = $_POST["phone"];
		$sem = $_POST["sem"];
		$dept = $_POST["dept"];
		$session = $_POST["session"];
		$regno = $_POST["regno"];
		$address = $_POST["address"];
		if ($name == "" | $username =="" | $password =="" | $email == "" | $phone == "" | $sem == "" | $dept == "" | $session == "" | $regno == "" | $address == "") {
			$error_m= "<b>Error !</b> <span>Feild mustn't be empty</span>";

		}
		$photo = "upload/avatar.jpg";
		$utype = "student";
		
         
//          elseif(preg_match('/[^a-z0-9_-]+/i', $username)){
//             $error_msg = "<div class='alert alert-danger'><strong>Error ! </strong>username Must be contain numerical alphabet, dashes, number and Underscore</div>";
//            }
		$sql_u= mysqli_query($link,"select * from std_registration where username= '$username'");
		$sql_e= mysqli_query($link,"select * from std_registration where email= '$email'");
		$sql_p= mysqli_query($link,"select * from std_registration where phone= '$phone'");
		$sql_r= mysqli_query($link,"select * from std_registration where regno= '$regno'");
	
        
        
		$sql2_u= mysqli_query($link,"select * from t_registration where username= '$username'");
        $sql2_e= mysqli_query($link,"select * from t_registration where email= '$email'");
        $sql2_p= mysqli_query($link,"select * from t_registration where phone= '$phone'");
        
		if(mysqli_num_rows($sql_u) > 0){
			$error_uname = "Username already exist";
		}
        if(mysqli_num_rows($sql2_u) > 0){
			$error_uname = "Username already exist";
		}
        elseif(mysqli_num_rows($sql_e) > 0){
            $error_email = "Email already exist";
        }elseif(mysqli_num_rows($sql2_e) > 0){
            $error_email = "Email already exist";
        }elseif(mysqli_num_rows($sql_p) > 0){
            $error_phone = "Phone already registered";
        }elseif(mysqli_num_rows($sql2_p) > 0){
            $error_phone = "Phone already registered";
        }elseif(mysqli_num_rows($sql_r) > 0){
            $error_reg = "This regno already registered";
        }
		elseif(strlen($username) < 6 ){
            $error_ua ="<b>Username too short !</b> <span>Your username must be 6-16 character </span>";
        }
		elseif(strlen($username) > 16 ){
            $error_ua ="<b>Username too big !</b> <span>Your username must be 6-16 character</span>";
        }
		 elseif(strlen($password) < 6 ){
            $error_pw ="<b>Password too short !</b> <span>Your password must be 6-16 character</span>";
        }
		elseif(strlen($password) > 16 ){
            $error_pw ="<b>Password too big !</b> <span>Your password must be 6-16 character</span>";
        }elseif (filter_var($email, FILTER_VALIDATE_EMAIL)== false) {
				$e_msg = "<strong>Error ! </strong> <span>Email Address Not Valid</span>";
		} else{
		    $vkey = md5(time().$username);
		    $insert = mysqli_query($link, "insert into std_registration values('','$name','$username','$password','$email','$phone','$sem','$dept','$session','$regno','$address','$utype','$photo','pending','$vkey','no')");
            if($insert){
               /* $to = "$email";
                $subject = "Email Verification";
                $message = "<a href='http://localhost/lms/Source/librarian/user/student/verify.php?vkey=$vkey'>Verify Email</a>";
                $headers = "From: parttimemail18@gmail.com \r\n";
                $headers.= "MIME-Version: 1.0". "\r\n";
                $headers.= "Content-type: text/html; charset-UTF-8". "\r\n";
                mail($to, $subject, $message,$headers);
                header('location: thankyou.php');
            }else{
                echo $mysqli->error;
            }*/





    
   		 

    	/*if (isset($_POST["submit"])) {
        $email = $_POST['email'];
        $sql = mysqli_query($link,"SELECT * FROM std_registration WHERE email='$email'");
        while($row = mysqli_fetch_array($sql)) {
            $password = $row['password'];
        }
        if (empty($email)) {
            array_push($errors, "Your email is required");
            echo implode(" ",$errors);
        }else if(mysqli_num_rows($sql) <= 0) {
            array_push($errors, "Sorry, no user exists on our system with that email");
            echo implode(" ",$errors);
        }*/

            

            //Load Composer's autoloader
            require 'PHPMailer/src/Exception.php';
            require 'PHPMailer/src/PHPMailer.php';
            require 'PHPMailer/src/SMTP.php';
            require 'inc/connection.php';
            if (isset($_POST["email"])) {

                $emailto=$_POST["email"];
               //  $vkey= mysqli_query($link,"SELECT vkey FROM std_registration WHERE email='email');
               //$vkey=$_POST["vkey"];
           
              // $query=mysqli_query($link,"SELECT vkey FROM std_registration WHERE email='$email'");
            
                //if (!$query) {
                  //  exit("error");
                //}
                $mail = new PHPMailer(true);

            try {
                                   
                $mail->isSMTP();                                            
                $mail->Host       = 'smtp.gmail.com';                     
                $mail->SMTPAuth   = true;                                   
                 $mail->Username   = 'canigetyourwhatsappnumber1@gmail.com';                     
                $mail->Password   = 'uuqrajwofvxptwwp';                               
                $mail->SMTPSecure = 'ssl';            
                $mail->Port       = 465;                                    

            
                $mail->setFrom('canigetyourwhatsappnumber1@gmail.com','library');
                $mail->addAddress($emailto);   
                $url= "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/verify.php?vkey=$vkey";
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'verification link';
                $mail->Body    = "<h1>YOU REQUESTED A STUDENT REGISTRATION </h1>
                                    Click <a href='$url'>this Link </a>  to do so ";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                header('location: thankyou.php');
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            }

        }
        
    }


		}
	

?>
