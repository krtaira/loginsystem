<?php
    session_start();
 /*<a href="addStudent.php">Add Student</a>*/
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
    <nav>
        <div class="main-wrapper">
            <ul>
                <li><img src="CSUDHletter.png" alt="CSUDH" width="75" height="20"><a href="index.php">  Student Advising</a></li>
            </ul>
            <div class="nav-logout">
                <?php
                    if (isset($_SESSION['u_id'])){
                        echo '<form action="includes/logout.inc.php" method="POST">
                        <button type="submit" name="submit">Logout</button>
                        </form>';
                    } 
                ?>
            </div>
        </div>
    </nav>
</header>  