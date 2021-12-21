<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="wnameth=device-wnameth, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <h2>Bejelentkezés</h2>
        <form action="../../app/Http/Controllers/logController.php" method="POST">
            <div class="form-group"> 
                <label for="username">Felhasználónév</label>
                <input type="text" name="username" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Jelszó</label>
                <input type="password" name="password" class="form-control">
            </div>
            <input type="submit" name="login" value="Bejelentkezés" class="btn-primary btn-lg rounded button">
            <br><a href="register.php">Még nincs fiókja? Kattintson ide a regisztrációért!</a>
        </form>
    </div>
</body>

</html>