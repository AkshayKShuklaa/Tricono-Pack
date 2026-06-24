
<?php

/* =========================
DATABASE CONFIG
========================= */

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "heeral";

/* =========================
CREATE CONNECTION
========================= */

$conn = mysqli_connect(
    $host,
    $user,
    $pass,
    $dbname
);

/* =========================
CHECK CONNECTION
========================= */

if(!$conn){

    die(
        "Database Connection Failed : "
        . mysqli_connect_error()
    );
}

/* =========================
UTF-8 SUPPORT
========================= */

mysqli_set_charset($conn,'utf8mb4');

?>

