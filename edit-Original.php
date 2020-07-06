<?php
  session_start();
  include_once 'header.php';
?>
<section class="main-container">
    <div class="main-wrapper">
        <?php
        include 'includes/dbh.inc.php';
        $uid = $_GET['id'];
        $name = $_GET['name'];
        echo "Student ID: ";
        echo $uid;
        echo "<br>";
        echo "Editing ";
        echo $name; 
        ?>
        <br><br>
        <?php echo'
        <form class="" action="includes/edit.inc.php?id='.$uid.'&name='.$name.'" method="POST">
            Completion Status: <select name="completionStatus">
                                    <option value="Completed">Completed</option>
                                    <option value="Incomplete" selected>Incomplete</option>
                                    <option value="In Progress">In Progress</option>
                                </select>
                                <br><br>
            Term Completed: <select name="completionTerm">
                                    <option value="Fall 2019">Fall 2019</option>
                                    <option value="Summer 2019">Summer 2019</option>
                                    <option value="Spring 2019">Spring 2019</option>
                                    <option value="Winter 2019">Winter 2019</option>
                                    <option value="Fall 2018">Fall 2018</option>
                                    <option value="Summer 2018">Summer 2018</option>
                                    <option value=" " selected> </option>
                                </select>
                                <br><br>
            Grade: <select name="grade">
                                    <option value="A">A</option>
                                    <option value="B+">B+</option>
                                    <option value="B">B</option>
                                    <option value="B-">B-</option>
                                    <option value="C+">C+</option>
                                    <option value="C">C</option>
                                    <option value="CR">CR</option>
                                    <option value=" " selected> </option>
                                </select>
                                <br><br>
            Term to be taken: <select name="plannedTerm">
                                    <option value="Winter 2020">Winter 2020</option>
                                    <option value="Spring 2020">Spring 2020</option>
                                    <option value="Summer 2020">Summer 2020</option>
                                    <option value="Fall 2020">Fall 2020</option>
                                    <option value=" " selected> </option>
                                </select>
                                <br><br>
            Comments: <input type="text" name="comments" >
            <br><br>
            <button type="submit" name="submit">Update</button>
        </form>';
        ?>

    </div>
</section>    
<?php
    include_once 'footer.php';
?>