<?php
session_start();
if(isset($_POST['submit'])){
    include 'dbh.inc.php';
    
	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $idnum = $_SESSION['u_id'];

	if(empty($uid) || empty($pwd)){
        $msg = "Empty fields are required!";
        $_SESSION["msg"] = $msg;
        header("location: ../updateInfo.php?updateInfo=empty");
        exit();
    }else{
                $sql = "SELECT * FROM users WHERE user_uid='$uid'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                
                if($resultCheck > 0){
                    $msg = "Username used already. Enter a different username!";
                    $_SESSION["msg"] = $msg;
                    header("location: ../updateInfo.php?updateInfot=usertaken");
                    exit();
                }else{
                    //Hashing the password
                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                    //Update user info in the database
                    $sql = "UPDATE users SET user_pwd = '$hashedPwd', user_uid = '$uid' WHERE user_id= $idnum";
                    $result = mysqli_query($conn, $sql);
                    $msg = "Info login updated successfully!";
                    $_SESSION["msg"] = $msg;
                    header("location: ../updateInfo.php?updateInfo=success&msg=$result");
                    exit();
                }
                
            }    
} else{
    header("location: ../addStudent.php");
    exit();
}