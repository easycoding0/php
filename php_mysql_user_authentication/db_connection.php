<?php

function connect_db()
{

    $host = "localhost";
    $uname = "root";
    $passwrd = "123456";
    $db_name = "php_login_app";

    $conn = mysqli_connect($host, $uname, $passwrd, $db_name);

    if ($conn) {
        return $conn;
    } else {
        return "database failed to connect.";
    }
}


//check database connection


// $conn = connect_db();

// if(!$conn){

//     echo $conn;

// }else{
//     echo "database connected successfully";
// }