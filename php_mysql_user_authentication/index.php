<?php 

session_start();

$username = "";

if(isset($_SESSION["userId"]) && $_SESSION["userId"] != ""){

    require_once("db_connection.php");

    $conn = connect_db();

    $userId = $_SESSION["userId"];

    $query = mysqli_query($conn, "SELECT name FROM user WHERE id='$userId' LIMIT 1");

    $check = mysqli_num_rows($query);

    if($check > 0){

        $row = mysqli_fetch_row($query);

        $username = $row[0];

    }else{

        session_destroy();
        header("location: login.php");
        exit();

    }

}else{

    header("location: login.php");
    exit();

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>

    <h5>Hello <?php echo $username; ?>, Welcome to home page</h5>
    
</body>
</html>