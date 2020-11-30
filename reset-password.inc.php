<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //random generator
    $str = "abcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+";
    $str = str_shuffle($str);
    $str = substr($str, 0, 10);
    $password = $str; //Generate random pass

    require_once "config.php"; //connect to the file of the database

    $userEmail = $_POST["email"];

    // Prepare an update statement
    $sql = "UPDATE users SET password = ? WHERE email= ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ss", $param_password, $param_id);

        // Set parameters
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        $param_id = $userEmail;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            //Send confirmation email
            $to_email = $userEmail;
            $subject = "Pallas Entertainment - Your account password has been reset";
            $body = "\nYour Pallas password has been reset!\n Your new password is:" . $password . "\n Please remember to log in and change your password to protect your account security.\nThank you for choosing PALLAS!\n-The PALLAS team.";
            $headers = "From: PALLAS";

            if (mail($to_email, $subject, $body, $headers)) {
                echo "Email successfully sent to $to_email...";
            } else {
                echo "Email failed.";
            }
            // Redirect to login page
            header("location: userpage.php");
            // Password updated successfully. Destroy the session, and redirect to login page
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
} else {
    echo "Failed. Make sure you input the correct email.";
    header("Location:../login.php"); //send the customer to some pages
}
