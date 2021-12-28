/*
<?php
/*        //include 'inc/connection.php';
        if (isset($_GET['vkey'])){
        $vkey = $_GET['vkey'];
        $mysqli= NEW MySQLi('localhost','root','','project');
    
        $resultSet = $mysqli->query("SELECT vkey, verified FROM std_registration WHERE vkey='$vkey' AND vefified ='no' LIMIT 1");
        if ($resultSet->num_rows==1) {
            $update= $mysqli->query( "UPDATE std_registration SET verified='yes' where vkey='$vkey' LIMIT 1");
        if($update){
            header('location: verification.php');
         }
         else{
           echo $resultSet->error;
        }
        }
     else
    {
         echo "This account is invalid or already verified.";
        
    }
    }  
    else{
          die("Something Went Wrong");
       }   
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verification</title>
</head>
<body>

</body>
</html>
*/
















    include 'inc/connection.php';
    if (isset($_GET['vkey'])){
        $vkey = $_GET['vkey'];
    }else{
        die("Something went wrong");
    }

    $resultSet = mysqli_query($link,"SELECT vkey, verified FROM std_registration WHERE vkey='$vkey' AND vefified ='no' LIMIT 1");
    $update= mysqli_query($link, "update std_registration set verified='yes' where vkey='$vkey' LIMIT 1");

    if($update){
        header('location: verification.php');
    }else{
        echo "This account is invalid or already verified.";
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vefification</title>
</head>
<body>

</body>
</html>



