<?php
    include_once 'header.php';
    //session_start();
?>
<section class="main-container">
    <div class="main-wrapper">
        <h2>CSUDH Student Advising</h2>
         <div class="nav-login">
                <?php
                    if (isset($_SESSION['u_id'])){
                        echo("<script>location.href = 'search.php?msg=$msg';</script>");
                        
                    } else {
                       echo '<form action="includes/login.inc.php" method="POST">
                        <input type="text" name="uid" placeholder="Username/Email">
                        <input type="password" name="pwd" placeholder="Password">
                        <button type="submit" name="submit">Login</button>
                    </form>';
                    if(isset($_SESSION["error"]))
                        {
                            $error = $_SESSION["error"];
                            echo "<form >$error</form>";
                        }
                    }
                ?>
            </div>
    </div>
</section>
<br><br><br><br>
<img src="csudhLogo.png" alt="CSUDH" style="display: block; margin-left: auto; margin-right: auto;">

<?php
    include_once 'footer.php';
    unset($_SESSION["error"]);
    unset($_SESSION["msg"]);
?>