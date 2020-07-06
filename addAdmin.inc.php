<?php
session_start();
if(isset($_POST['submit'])){
    
    include_once 'dbh.inc.php';
    
    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $level = mysqli_real_escape_string($conn, $_POST['level']);
    
    //Erron handlers
    //Check for empty fields
    if(empty($first) || empty($last) || empty($email) || empty($pwd) || empty($level)){
        $msg = "Empty fields are required!";
        $_SESSION["msg"] = $msg;
        header("location: ../addAdmin.php?addAdmin=empty");
        exit();
    }else{
        //Check if input characters are valid
        if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)){
            $msg = "Enter a valid name!";
            $_SESSION["msg"] = $msg;
            header("location: ../addAdmin.php?addAdmin=invalid");
            exit();
        }else{
            //Check if email is valid
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $msg = "Enter a valid email!";
                $_SESSION["msg"] = $msg;
                header("location: ../addAdmin.php?addAdmin=email");
                exit();
            }else{
                $sql = "SELECT * FROM users WHERE user_email='$email'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                
                if($resultCheck > 0){
                    $msg = "Email used already. Enter a different email!";
                    $_SESSION["msg"] = $msg;
                    header("location: ../addAdmin.php?updateInfot=emailused");
                    exit();
                }else{
                    //Hashing the password
                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                    //Insert the user into the database
                    $sql = "INSERT INTO users (user_first, user_last, user_email, user_pwd, user_level) VALUES('$first', '$last', '$email', '$hashedPwd', '$level');";
                    $result = mysqli_query($conn, $sql);
                    ini_set( 'display_errors', 1 );
                    error_reporting( E_ALL );
                    $from = "csudhstudentdatabase@gmail.com";
                    $subject = "CSUDH Computer Science Student Advisement";
                    $message = "You have been granted login access to the CSUDH Computer Science Student Advisement Portal. Use the following temporary password to login using your email. Please update password and username.
                    \n\n Password: $pwd";
                    $headers = "From:" . $from;
                    mail($email,$subject,$message, $headers);
                    $msg = "Email sent and administrator added successfully!";
                    $_SESSION["msg"] = $msg;
                    header("location: ../addAdmin.php?addAdmin=success");
                    exit();
                }
            }
        }
    }
    
}else{
    header("location: ../addAdmin.php");
    exit();
}