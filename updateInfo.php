<?php
    include_once 'header.php';
?>

<section class="main-container">
    <div class="main-wrapper">
        <h2>Update Username and Password</h2>
        <form class="signup-form" action="includes/updateInfo.inc.php" method="POST">
            <input type="text" name="uid" placeholder="New Username">
            <input type="text" name="pwd" placeholder="New Password">
            <button type="submit" name="submit">Update</button><br>
            <?php
            if (isset($_SESSION['msg'])){
            $msg = $_SESSION['msg'];
            echo "<form>$msg</form>";
            }?>
        </form>
    </div>
</section>

<?php
    include_once 'footer.php';
    unset($_SESSION["msg"]);
?>