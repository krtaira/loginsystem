<?php
  session_start();
  include_once 'header.php';
?>
<!DOCTYPE html>
<html>
    <section class="main-container">
    <div class="main-wrapper">
    <h2>Courses</h2>
        <h3><b>
        <?php
        include 'includes/dbh.inc.php';
        $uid = $_GET['uid'];
        $sql = "SELECT * FROM students WHERE student_id='$uid'";
    	$result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        echo 'Student Name: ';
        echo $row['first_name'];
        echo " ";
        echo $row['last_name'];
        echo "&emsp; &emsp; &emsp;";       
        echo 'Student ID: ';
        echo $row['student_id'];
        $myData = $row['courses'];  
        ?></b></h3>
        </div>
        </section>
        <br>
        <table>
            <tr>
                <td style="text-align:center;"><b>Course Name</b></td>
                <td style="text-align:center;"><b>Completion Status</b></td>
                <td style="text-align:center;"><b>Term Completed</b></td>
                <td style="text-align:center;"><b>Grade</b></td>
                <td style="text-align:center;"><b>Planned Term</b></td>
                <td style="text-align:center;"><b>Comments</b></td>
            </tr>
            <?PHP
                $data = json_decode($myData);
                    foreach($data as $key=>$item){
            ?>
            <tr>
            <td style="text-align:center;"><?PHP echo $item->name; 
                                             $courseName = $item->name;
                                        ?></td>
            <td style="text-align:center;"><?PHP echo $item->completionStatus; ?></td>
            <td style="text-align:center;"><?PHP echo $item->completionTerm; ?></td>
            <td style="text-align:center;"><?PHP echo $item->grade; ?></td>
            <td style="text-align:center;"><?PHP echo $item->plannedTerm; ?></td>
            <td style="text-align:center;"><?PHP echo $item->comments; ?></td>
            <td> <?php echo '<a href="edit.php?id='.$uid.'&name='.$courseName.'">Edit</a>'; ?></td>
            </tr><?PHP
            }
            ?>
        </table>
<?php
    include_once 'footer.php';
?>
