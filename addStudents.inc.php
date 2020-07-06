<?php
session_start();
if(isset($_POST['submit'])){
    
    include_once 'dbh.inc.php';
    
    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    
    //Erron handlers
    //Check for empty fields
    if(empty($first) || empty($last) || empty($uid) || empty($email)){
        $msg = "Empty fields are required!";
        $_SESSION["msg"] = $msg;
        header("location: ../addStudents.php?addStudents=empty");
        exit();
    }else{
        //Check if input characters are valid
        if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)){
            $msg = "Enter a valid name!";
            $_SESSION["msg"] = $msg;
            header("location: ../addStudents.php?addStudents=invalid");
            exit();
        }else{
            if(!stristr($email, '@toromail.csudh.edu')){
                $msg = "Enter a valid CSUDH email!";
                $_SESSION["msg"] = $msg;
                header("location: ../addStudents.php?addStudents=email");
                exit();
            }else{
                $sql = "SELECT * FROM students WHERE student_id='$uid'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                    
                if($resultCheck > 0){
                    $msg = "Student ID exists in the database already!";
                    $_SESSION["msg"] = $msg;
                    header("location: ../addStudents.php?addStudents=usertaken");
                    exit();
                }else{
                    //create array of courses
                    $courseList = array(
                'CSC 121' => array('name' => 'CSC 121','completionStatus' => 'Not Taken','completionTerm' =>' ','grade' => ' ', 'plannedTerm' => ' ','comments' => ' '),
                'CSC 123' => array('name' => 'CSC 123','completionStatus' => 'Not Taken','completionTerm' =>' ','grade' => ' ', 'plannedTerm' => ' ','comments' => ' '),
                'CSC 221' => array('name' => 'CSC 221','completionStatus' => 'Not Taken','completionTerm' =>' ','grade' => ' ', 'plannedTerm' => ' ','comments' => ' '),
                'CSC 2xx' => array('name' => 'CSC 2xx','completionStatus' => 'Not Taken','completionTerm' =>' ','grade' => ' ', 'plannedTerm' => ' ','comments' => ' '),
                'MAT 191' => array('name' => 'MAT 191','completionStatus' => 'Not Taken','completionTerm' =>' ','grade' => ' ', 'plannedTerm' => ' ','comments' => ' '),
                'MAT 193' => array('name' => 'MAT 193','completionStatus' => 'Not Taken','completionTerm' =>' ','grade' => ' ', 'plannedTerm' => ' ','comments' => ' '),
                'MAT 271' => array('name' => 'MAT 271','completionStatus' => 'Not Taken','completionTerm' =>' ','grade' => ' ', 'plannedTerm' => ' ','comments' => ' '),
                'MAT 281' => array('name' => 'MAT 281','completionStatus' => 'Not Taken','completionTerm' =>' ','grade' => ' ', 'plannedTerm' => ' ','comments' => ' '),
                'PHY 130' => array('name' => 'PHY 130','completionStatus' => 'Not Taken','completionTerm' =>' ','grade' => ' ', 'plannedTerm' => ' ','comments' => ' '),
                'PHY 132' => array('name' => 'PHY 132','completionStatus' => 'Not Taken','completionTerm' =>' ','grade' => ' ', 'plannedTerm' => ' ','comments' => ' '),
                'CSC 311' => array('name' => 'CSC 311','completionStatus' => 'Not Taken','completionTerm' =>' ','grade' => ' ', 'plannedTerm' => ' ','comments' => ' '),
                'CSC 321' => array('name' => 'CSC 321','completionStatus' => 'Not Taken','completionTerm' =>' ','grade' => ' ', 'plannedTerm' => ' ','comments' => ' '),
                'CSC 331' => array('name' => 'CSC 331','completionStatus' => 'Not Taken','completionTerm' =>' ','grade' => ' ', 'plannedTerm' => ' ','comments' => ' '),
                'CSC 341' => array('name' => 'CSC 341','completionStatus' => 'Not Taken','completionTerm' =>' ','grade' => ' ', 'plannedTerm' => ' ','comments' => ' '),
                'CSC 301' => array('name' => 'CSC 301','completionStatus' => 'Not Taken','completionTerm' =>' ','grade' => ' ', 'plannedTerm' => ' ','comments' => ' '),
                'CSC 401' => array('name' => 'CSC 401','completionStatus' => 'Not Taken','completionTerm' =>' ','grade' => ' ', 'plannedTerm' => ' ','comments' => ' '),
                'CSC 481' => array('name' => 'CSC 481','completionStatus' => 'Not Taken','completionTerm' =>' ','grade' => ' ', 'plannedTerm' => ' ','comments' => ' '),
                'CSC 492' => array('name' => 'CSC 492','completionStatus' => 'Not Taken','completionTerm' =>' ','grade' => ' ', 'plannedTerm' => ' ','comments' => ' '),
                'MAT 321' => array('name' => 'MAT 321','completionStatus' => 'Not Taken','completionTerm' =>' ','grade' => ' ', 'plannedTerm' => ' ','comments' => ' '),
                'MAT 361' => array('name' => 'MAT 361','completionStatus' => 'Not Taken','completionTerm' =>' ','grade' => ' ', 'plannedTerm' => ' ','comments' => ''),
                'CSC ELECTIVE 1' => array('name' => 'CSC ELECTIVE 1','completionStatus' => 'Not Taken','completionTerm' => ' ','grade' => ' ', 'plannedTerm' => ' ','comments' => ' '),
                'CSC ELECTIVE 2' => array('name' => 'CSC ELECTIVE 2','completionStatus' => 'Not Taken','completionTerm' => ' ','grade' => ' ', 'plannedTerm' => ' ','comments' => ' '));
            $encodedCourses = json_encode(array_values($courseList));

                    //Insert student into the database
                    $sql = "INSERT INTO students (student_id, first_name, last_name, email, courses) VALUES('$uid', '$first', '$last', '$email', '$encodedCourses');";
                    $result = mysqli_query($conn, $sql);
                    $msg = "Student added successfully!";
                    $_SESSION["msg"] = $msg;
                    header("location: ../addStudents.php?addStudents=success");
                    exit();
                }
            }
                
        }
            
    }
    
}else{
    header("location: ../addStudents.php");
    exit();
}