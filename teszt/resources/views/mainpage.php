<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <nav>
        <li>
            <?php
                if(isset($_SESSION['userid']))
                {
                        echo '<a href="../../config/logout.php" class="menu">Kijelentkezés</a>';
                }
                else{
                    echo '<a href="login.php" class="menu">Bejelentkezés</a>';
                }
            ?>
        </li>
        <li><a href="register.php" class="menu">Regisztráció</a></li>
        <div class="loggedUser">
            <?php 
                if(isset($_SESSION['userid']))
                {
                    echo '<b>Bejelentkezve:</b> '.$_SESSION['username'];
                }
            ?>
        </div>
    </nav>
    <div class="container">
    <h1>Főoldal</h1>
    </div> 
</body>
</html>