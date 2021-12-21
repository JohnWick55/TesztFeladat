<?php
$conn = mysqli_connect("localhost","root","","testproject");

if($conn->errno){
    echo 'Hiba az adatbázishoz való csatlakozás során.';
}
if(!$conn->set_charset('utf8')){
    echo 'Hiba a karakterkódolás során.';
}