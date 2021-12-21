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
        <h2>Regisztráció</h1>
            <form action="../../app/Http/Controllers/regController.php" method="POST">
                <div class="form-group">
                    <label for="username">Felhasználónév <span class="desc">(minimum 5 és maximum 20 karakter)</span></label>
                    <input type="text" name="username" class="form-control">
                </div>
                <div class="form-group"> <label for="password">Jelszó <span class="desc">(minimum 8 és maximum 15 karakter hosszú és tartalmaznia kell legalább 1 nagybetűt és 1 számot)</span></label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group"> <label for="passwordConfirm">Jelszó megerősítése</label>
                    <input type="password" name="passwordConfirm" class="form-control">
                </div>
                <div class="form-group"><label for="email">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group"><label for="firstname">Vezetéknév</label>
                    <input type="text" name="firstname" class="form-control">
                </div>
                <div class="form-group"><label for="lastname">Keresztnév</label>
                    <input type="text" name="lastname" class="form-control">
                </div>
                <div class="form-group"><label for="birthdate">Születési dátum</label>
                    <input type="date" name="birthdate" class="form-control">
                </div>
                <div class="form-group"><label for="zipcode">Irányítószám</label>
                    <input type="number" name="zipcode" class="form-control" min=1111 max=9999>
                </div>
                <div class="form-group"><label for="city">Város</label>
                    <input type="text" name="city" class="form-control">
                </div>
                <div class="form-group"> <label for="address">Utca</label>
                    <input type="text" name="address" class="form-control">
                </div>
                <div class="form-group"><label for="housenumber">Házszám</label>
                    <input type="text" name="housenumber" class="form-control">
                </div>
                <input type="submit" name="registration" value="Regisztráció" class="btn-primary btn-lg rounded button">
                <br><a href="login.php">Belejentkezés (már regisztrált felhasználóknak)</a>
            </form>
    </div>
</body>

</html>