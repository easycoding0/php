<?php
session_start();

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = preg_replace("#[^0-9a-zA-Z]#", "", $_POST["username"]);

    $password = preg_replace("#[^0-9a-zA-Z.@]#", "", $_POST["password"]);

    if ($username !== "" && $password !== "") {

        require_once("db_connection.php");

        $conn = connect_db();

        $sql = mysqli_query($conn, "SELECT id FROM user WHERE username='$username' and password='$password' LIMIT 1");

        $check = mysqli_num_rows($sql);

        if ($check > 0) {
            $row = mysqli_fetch_row($sql);
            $userid = $row[0];
            $_SESSION["userId"] = $userid;
            
            header("location: index.php");
            exit();
        } else {


            $error_message = "User not found in database";
        }
    } else {
        $error_message = "Invalid details.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="container">
        <div class="login-box">
            <p class="heading">Login Here</p>
            <div class="login-form-wrap">
                <p><?php echo $error_message; ?></p>
                <form method="post" action="">
                    <input type="text" name="username" placeholder="Username" />
                    <input type="password" name="password" placeholder="Enter Password" />
                    <button type="submit">Login</button>
                    <p>Do not have an account? <a href="signup.php">Create Account</a></p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>