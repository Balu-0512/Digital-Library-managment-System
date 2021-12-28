<?<?php  ?>
//    $res = mysqli_query($link, "select * from std_registration where id=$id");
//    while($row = mysqli_fetch_array($res)){
//        $email      = $row['email']; 
//    }
    
    require "phpmailer/PHPMailerAutoload.php";
    $mail = new PHPMailer;
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'canigetyourwhatsappnumber1@gmail.com';                 // SMTP username
    $mail->Password = 'iuqlredxfrohopzs';                           // SMTP password
    $mail->SMTPSecure = 'tcl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('canigetyourwhatsappnumber1@gmail.com');
    $mail->addAddress('canigetyourwhatsappnumber1@gmail.com');     // Add a recipient
    $mail->addReplyTo('parttimemail18@gmail.com');

    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';


    if(!$mail->send()) {
        echo 'Message could not be sent.';

    } else {
        echo 'Message has been sent';
    }



?>
