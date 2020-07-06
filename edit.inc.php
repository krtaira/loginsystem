<?php

if(isset($_POST['submit'])){
    include 'dbh.inc.php';
    
    $uid = $_GET['id'];
    $name = $_GET['name'];
	$status = mysqli_real_escape_string($conn, $_POST['completionStatus']);
    $cTerm = mysqli_real_escape_string($conn, $_POST['completionTerm']);
    $grade = mysqli_real_escape_string($conn, $_POST['grade']);
    $pTerm = mysqli_real_escape_string($conn, $_POST['plannedTerm']);
    $comments = mysqli_real_escape_string($conn, $_POST['comments']);

	if(empty($uid)){
        header("Location:../student.php?uid=$uid");
        exit();
    }else{
    	$sql = "SELECT * FROM students WHERE student_id='$uid'";
    	$result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck < 1){
            header("Location: ../index.php?login=error_no_student");
            exit();
        } else{
                $row = mysqli_fetch_assoc($result);
                $myData = $row['courses'];
                $data = json_decode($myData);
                foreach($data as $key=>$item){
                    if ($item->name == $name) {
                        $item->completionStatus = $status;
                        $item->completionTerm = $cTerm ;
                        $item->grade = $grade;
                        $item->plannedTerm = $pTerm;
                        $item->comments = $comments;
                    }
                }
                $encodedCourses = json_encode($data);
                $sql = "UPDATE students SET courses = '$encodedCourses' WHERE student_id= $uid";
                $retval = mysqli_query($conn, $sql);
        		header("Location:../student.php?uid=$uid&msg=$retval");
        		exit();
        }
    }
}