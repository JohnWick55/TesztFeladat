<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    Registration();
}

function Registration()
{
    require_once("../../Models/db.php");

    //Üres mezők megvizsgálása
    if (
        !empty(trim($_POST['email'])) && !empty(trim($_POST['username']))
        && !empty(trim($_POST['password'])) && !empty(trim($_POST['firstname'])) & !empty(trim($_POST['lastname']))
        && !empty(trim($_POST['zipcode'])) && !empty(trim($_POST['city'])) && !empty(trim($_POST['address'])) && !empty(trim($_POST['housenumber']))
        && !empty(trim($_POST['birthdate']))
    ) {
        $username = $conn->real_escape_string(trim($_POST['username']));
        $password = $conn->real_escape_string(trim($_POST['password']));

        //Jelszó titkosítása, valamint az adatok lekérése a formról
        $hashedPwd = encrypt($password);
        $passwordConfirm = $conn->real_escape_string(trim($_POST['passwordConfirm']));
        $email = $conn->real_escape_string(trim($_POST['email']));
        $firstname = $conn->real_escape_string(trim($_POST['firstname']));
        $lastname = $conn->real_escape_string(trim($_POST['lastname']));
        $zipcode = (int)$_POST['zipcode'];
        $city = $conn->real_escape_string(trim($_POST['city']));
        $address = $conn->real_escape_string(trim($_POST['address']));
        $housenumber = (int)$_POST['housenumber'];
        $birthdate = $conn->real_escape_string(trim($_POST['birthdate']));

        //Email keresése az adatbázisban
        $sqlEmail = "SELECT email FROM users WHERE email = ?";
        $stmte = $conn->prepare($sqlEmail);
        $stmte->bind_param("s", $email);
        $stmte->execute();
        $resultEmail = $stmte->get_result();

        //Username keresése az adatbázisban
        $sqlUsername = "SELECT username FROM users WHERE username = ?";
        $stmte = $conn->prepare($sqlUsername);
        $stmte->bind_param("s", $username);
        $stmte->execute();
        $resultUsername = $stmte->get_result();  

        //Már létező felhasználónév és email megvizsgálása
        if($resultUsername->num_rows == 1){
            echo "Ez a felhasználónév már foglalt.<br>";
        }
        else if($resultEmail->num_rows == 1){
            echo "Ezzel az emaillel már regisztráltak.<br>";
        }

        //Jelszavak egyezésének vizsgálata
        else if($password==$passwordConfirm)
        {

            //Az adatok validságának vizsgálata
            if (ValidateData($username, $password, $passwordConfirm, $email, $firstname, $lastname, $zipcode, $city, $address, $housenumber, $birthdate)) { 
                // $sqlAddUser = 'INSERT INTO   users  (email, username, firstname, lastname, birth_date, zip_code, city, address, house_num, password) VALUES (?,?,?,?,?,?,?,?,?,?)';
                // $stmtAdd = $conn-> prepare($sqlAddUser);
                // $stmtAdd -> bind_param("sssssissis",$email,$username,$firstname,$lastname,$birthdate,$zipcode,$city,$address,$housenumber,$password);
                // $stmtAdd -> get_result();
                
                //A felhasználó hozzáadása az adatbázishoz
                $sqlAddu = 'INSERT INTO   users  (email, username, firstname, lastname, birth_date, zip_code, city, address, house_num, password) VALUES ("' . $email . '","' . $username . '","' . $firstname . '","' . $lastname . '","' . $birthdate . '",' . $zipcode . ',"' . $city . '","' . $address . '",' . $housenumber . ',"' . $hashedPwd . '")';
                $result = $conn->query($sqlAddu);
                echo 'Sikeres regisztráció<br> Köszönjük, hogy regisztrált kedves '.$firstname.' '.$lastname;
                echo '<br><a href="../../../resources/views/login.php">Tovább a bejelentkezéshez</a>';
                echo '<br><a href="../../../resources/views/register.php">Vissza a regisztrációs űrlapra</a>';
            } else {
                echo "Sikertelen regisztráció<br>";
                echo "Az adatok formátuma nem megfelelő";
            }
        }
        else{
            echo "Sikertelen regisztráció<br>";
                echo "A 2 jelszó nem egyezik";
        }
        
    }
    else{
            echo "Sikertelen regisztráció<br>";
            echo "Az összes mező kitöltése kötelező!";
        }
        $conn->close();
    }

//Beviteli adatok ellenőrzése 
function ValidateData($username, $password, $passwordConfirm, $email, $firstname, $lastname, $zipcode, $city, $address, $housenumber, $birthdate)
{
    $regexUsername = "/^[A-Za-z][A-Za-z0-9]{5,21}$/";
    $regexPassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,16}$/";

    //Adatok ellenőrzése regex kifejezések segítségével
        if (filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match($regexUsername, $username) && preg_match($regexPassword, $password) && validateDate($birthdate)) {
            return true;
        } else {
            return false;
        }
    
}

//Jelszó titkosítása sha512-vel
function encrypt($password)
{
    $hashedPwd = hash('sha512', $password);
    return strtoupper($hashedPwd);
}

//Dátum formátum ellenőrzése
function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}