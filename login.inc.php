<?php

session_start();

if(isset($_POST['submit'])){
    include 'dbh.inc.php';
    
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    
    //Error handler
    //Check if inputs are empty
    if(empty($uid) || empty($pwd)){
        $error = "Please enter username and password!";
        $_SESSION["error"] = $error;
        header("Location: ../index.php?login=empty");
        exit();
    }else{
        $sql = "SELECT * FROM users WHERE user_uid='$uid' OR user_email= '$uid'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck < 1){
            $error = "Invalid username! Please enter it again";
            $_SESSION["error"] = $error;
            header("Location: ../index.php?login=error1");
            exit();
        } else{
            if($row = mysqli_fetch_assoc($result)){
                //De-hashing the password
                $hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
                if($hashedPwdCheck == false){
                    $error = "Invalid password! Please enter it again";
                    $_SESSION["error"] = $error;
                    header("Location: ../index.php?login=error2");
                    exit();
                } elseif($hashedPwdCheck == true){
                    //Log in the user here
                    $_SESSION['u_id'] = $row['user_id'];
                    $_SESSION['u_first'] = $row['user_first'];
                    $_SESSION['u_last'] = $row['user_last'];
                    $_SESSION['u_email'] = $row['user_email'];
                    $_SESSION['u_uid'] = $row['user_uid'];
                    $_SESSION['u_level'] = $row['user_level'];
                    header("Location: ../index.php?login=success");
                    exit();
                }
            }
        }
    }
    }else{
        header("Location: ../index.php?login=error3");
        exit();
    }
