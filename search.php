<?php
	include_once 'header.php';
?>

<section class="main-container">
    <div class="main-wrapper">
        <h2>CSUDH Student Advisement</h2>
        <br><br>
        <h1 style="text-align:center;"><b>Search for student:</b></h1>
 
         <div class="nav-login">
                <?php
                    if(isset($_SESSION['u_id'])){
                        echo '<form action="includes/search.inc.php" method="POST">
                        <input type="text" name="uid" placeholder="Student ID">
                        <button type="submit" name="submit">Search</button>
                        </form>';
                        if (isset($_SESSION['error']))
                        {
                            $error = $_SESSION['error'];
                            echo "<form>$error</form>";
                        }
                        echo'
                        <br><br><br><br><hr>
                        <h1 style="text-align:center;"><b>Administrative Options:</b></h1>
                        <form action="addStudents.php">
                       <button type="submit" name="submit">Add Student</button>
                        </form>
                        <form action="updateInfo.php">
                       <button type="submit" name="submit">Update Login Info</button>
                        </form>
                        <form action="addAdmin.php">
                       <button type="submit" name="submit">Add Administrator</button>
                        </form>';
                    
                    } else {
                         echo("<script>location.href = 'index.php?msg=$msg';</script>");
                    }
                ?>
            </div>
    </div>
</section>
<?php
    include_once 'footer.php';
    unset($_SESSION["error"]);
    unset($_SESSION["msg"]);
?>