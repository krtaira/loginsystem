<?php
	include_once 'header.php';
?>

<section class="main-container">
    <div class="main-wrapper">
        <h2>Add New Student</h2>
        <form class="signup-form" action="includes/addStudents.inc.php" method="POST">
            <input type="text" name="first" placeholder="First name">
            <input type="text" name="last" placeholder="Last name">
            <input type="text" name="uid" placeholder="Student ID">
            <input type="text" name="email" placeholder="E-mail">
            <button type="submit" name="submit">Add Student</button>
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
    unset($_SESSION["error"]);
    unset($_SESSION["msg"]);
?>