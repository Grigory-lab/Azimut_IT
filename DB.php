<?php
    $servername = "localhost"; //Подключение базы данных
    $username = "root";
    $password = "";
    $dbname = "azimut";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if(!$conn) {
        die("Ошибка подключения: " . mysqli_connect_error());
    }
//////////////////////////////////////////////////////////////////////////////
    session_start();
?>