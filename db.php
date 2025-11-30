<?php
$server = "localhost";
$port="3307";
$user = "root";
$pass = "";
$dbname = "librarydb";
$conn = new mysqli($server, $user, $pass, $dbname, $port);

if(!$conn){
    echo "Oops! : {$conn->connect_error}";
}

?>