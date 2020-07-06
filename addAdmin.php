<?php
    include_once 'header.php';
?>

<section class="main-container">
    <div class="main-wrapper">
        <h2>Add New Administrator</h2>
        <form class="signup-form" action="includes/addAdmin.inc.php" method="POST">
            <input type="text" name="first" placeholder="First Name">
            <input type="text" name="last" placeholder="Last Name">
            <input type="text" name="email" placeholder="E-mail">
            <input type="text" name="pwd" placeholder="Temporary Password">
            <input type="hidden" name="level" value="admin">
            <button type="submit" name="submit">Add Administrator</button><br>
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