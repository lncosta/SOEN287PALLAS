<?php

if(isset($_POST["reset-request-submit"])){

$selecter = bin2hex(random_bytes(8));
$token = random_bytes(32);

$url = "www.parallas.net/forgottenpwd/create-new-password.php?selector=".$selector."$validator=" . bin2hex($token);
$expires = date("U")+1800;


//now go to the database and choose SQL for creating a new table
/*
CREATE TABLE pwdReset(
    pwdResetId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    pwdResetEmail TEXT NOT NULL,
    pwdResetSelector TEXT NOT NULL,
    pwdRestToken LONGTEXT NOT NULL,
    pwdResetExpired TEXT NOT NULL,
);
*/


require 'database.inc.php';//connect to the file of the database

$userEmail= $_POST["email"];

$sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
$stmt=mysqli_stmt_init($conn);  //$conn is the variable in the database  
                                //$conn=mysqli_connect($dbServername,$dbUsername,$dbpassword,$dbName);

if(!mysqli_stmt_prepare($stmt,$sql)){
    echo "There was an error!";
    exit();
}else{
    mysqli_stmt_bind_param($stmt,"s",$userEmail);
    mysqli_stmt_execute($stmt);
}

$sql = "INSERT INTO pwdReset(pwdResetEmail, pwdResetSelector,pwdResetToken, pwdResetExpires) VALUES(?,?,?,?);";
$stmt=mysqli_stmt_init($conn);  //$conn is the variable in the database  
                                //$conn=mysqli_connect($dbServername,$dbUsername,$dbpassword,$dbName);

if(!mysqli_stmt_prepare($stmt,$sql)){
    echo "There was an error!";
    exit();
}else{
    $hashedToken = password_hash($token,PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt,"ssss",$userEmail,$selecter,$hashedToken,$expires);
    mysqli_stmt_execute($stmt);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);


$to = $userEmail;
$subject = "Reset your password for pallas";

$message = '<p>We received a password reset request. Click the link below to reset your password, if the request is
            not made by youself, please ignore this email.</p>';
$message .= '<p>Here is your password reset link:</br>';
$message .='<a href="' . $url .'">'.$url.'</a></p>';


$headers = "From: pallas <yihengconcordia@gmail.com>\r\n"; //here input pallas email account
$headers .= "Reply-To: yihengconcordia@gmail.com\r\n";     //here too
$headers .="Content-type:text/html\r\n";

mail($to,$subject,$message,$headers);

header("Location: ../reset-password.php?reset=success");

}else{
    header("Location:../index.php"); //send the customer to some pages
}
