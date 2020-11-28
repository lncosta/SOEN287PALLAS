<?php

if(isset($_POST["reset-password-submit"])){
        $selector =$_POST["selector"];
        $validator =$_POST["validator"];
        $password =$_POST["pwd"];
        $passwordRepeat =$_POST["pwd-repeat"];

        if(empty($password)||empty($passwordRepeat)){
            header("Location:../create-new-password.php?newpwd=empty");
            exit();

        }else if ($password != $passwordRepeat){
            header("Location:../create-new-password.php?newpwd=empty");
            exit();            
        }

        $currentDate=date("U");

        require 'database.inc.php';//connect to the file of the database

        $sql ="SELECT * FROM pwdReset WHERE pewResetSelector=? AND pewResetExpires >= ?";
        $stmt= mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            echo "There was an error!";
            exit();
        }else{
            mysqli_stmt_bind_param($stmt,"s",$selector,$currentDate);
            mysqli_stmt_execute($stmt);

            $result=mysqli_stmt_get_result($stmt);
            if(!$row=mysqli_fetch_assoc($result)){

                echo "You need to re-submit your reset request.";
                exit();

            }else{
                $tokenBin = hex2bin($validator);
                $tokenCheck = password_verify($tokenBin,$row["pewResetToken"]);

                if($tokenCheck ===false){
                    echo "You need to re-submit your reset request.";
                    exit();
                }elseif($tokenCheck===true){

                    $tokenEmail=$row['pwdResetEmail'];

                    $sql="SELECT * FROM users WHERE emailUsers=?;";
                    $stmt= mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt,$sql)){
                    echo "There was an error!";
                    exit();
                    }else{
            mysqli_stmt_bind_param($stmt,"s",$tokenEmail);
            mysqli_stmt_execute($stmt);

            $result=mysqli_stmt_get_result($stmt);
            if(!$row=mysqli_fetch_assoc($result)){

                echo "There was an error occur.";
                exit();

            }else{


                $sql="UPDATE users SET pwdUsers=? WHERE emailUsers=?";
                $stmt= mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                echo "There was an error!";
                exit();
                }else{
                $newPwdHash = password_hash($passwordRepeat,PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt,"ss",$newPwdHash,$tokenEmail);
                mysqli_stmt_execute($stmt);

                $sql ="DELETE FROM pwdReset WHERE pedResetEmail=?";
                $stmt= mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    echo "There was an error!";
                    exit();
                }else{
                    mysqli_stmt_bind_param($stmt,"s",$tokenEmail);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../signup.php?newpwd=passwordupdated");//here it goes to signup page, but we can
                                                                            //go anywhere
                    //so insert in the signup page the following code
                    /*
                    <?php
                    if(isset($_GET["newpwd"])){
                        if($_GET["newpwd"]=="passwordupdated"){
                            echo '<p class="signupsuccess"> Your password has been reset!</p>
                        }
                    }
                    ?>
                    */
                }
            }
        }
        }

                }
            }
        }
}else{
    header("location:../index.php");
}

?>