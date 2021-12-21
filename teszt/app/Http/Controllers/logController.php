<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    Login();
}

function Login()
{
    require_once("../../Models/db.php");

    //Üres mezők megvizsgálása
    if (!empty(trim($_POST['username']) && !empty(trim($_POST['password'])))) {
        $username = $conn->real_escape_string($_POST['username']);
        $password = $conn->real_escape_string($_POST['password']);

        //Felhasználónév alapján a felhasználó lekérdezése az adatbázisból
        $sqlUsername = 'SELECT id, username, password FROM users WHERE username = ?';
        $stmtu = $conn->prepare($sqlUsername);
        $stmtu->bind_param("s", $username);
        $stmtu->execute();
        $resultUser = $stmtu->get_result();
        if (!$resultUser) {
            print("SQL Hiba");
        } 
        else {
            $user = $resultUser->fetch_assoc();
            if (!empty($user)) {
                $hashedPwd = encrypt($password);

                //Egyező jelszavak megvizsgálása, majd egyezés esetén beléptetés
                if ($user["password"] == $hashedPwd) {
                    echo "Sikeres bejelentkezés<br>";
                    $_SESSION['userid'] = $user["id"];
                    $_SESSION['username'] =  $user["username"];
                    header('Location: ../../../resources/views/mainpage.php');
                    exit();
                } 
                else {
                    echo "<br>Sikertelen bejelentkezés<br>";
                    echo "A felhasználóhoz tartozó jelszó helytelen<br>";
                }
            } 
            else {
                echo "Sikertelen bejelentkezés<br>";
                echo "Ilyen felhasználónévvel nem létezik felhasználó";
            }

            //Adatbázis kapcsolat megszakítása
            $conn->close();
        }
    } 
    else {
        echo "Sikertelen bejelentkezés<br>";
        echo "Az összes mező kitöltése kötelező!";
    }
}

//Jelszó titkosítása sha512-vel
function encrypt($password)
{
    $hashedPwd = hash('sha512', $password);
    return strtoupper($hashedPwd);
}
