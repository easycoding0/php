<?php 

$error_message = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = preg_replace("#[^0-9a-zA-Z]#", "", $_POST["username"]);

    $name = preg_replace("#[^0-9a-zA-Z ]#", "", $_POST["name"]);

    $password = preg_replace("#[^0-9a-zA-Z.@]#", "", $_POST["password"]);

    if($username !== "" && $name !== "" && $password !== ""){
        
        require_once("db_connection.php");

        $conn = connect_db();

        $sql = mysqli_query($conn, "SELECT id FROM user WHERE username='$username' LIMIT 1");

        $check = mysqli_num_rows($sql);

        if($check > 0){

            $error_message = "Username already registered";

        }else{

            mysqli_query($conn, "INSERT INTO user(username, name, password) VALUES('$username', '$name', '$password')");

            $userId = mysqli_insert_id($conn);

            if($userId > 0){
                
                header("location: index.php");

            }else{
                $error_message = "Unable to insert user deta into databse";
            }
            
        }


    }else{
        $error_message = "Invalid details.";
    }

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="container">
        <div class="login-box">
            <p class="heading">Create Account</p>
            <div class="login-form-wrap">
                <p><php echo $error_message; ?></php></p>
                <form method="post" action="">
                    <input type="text" name="name" placeholder="Your Name" />
                    <input type="text" name="username" placeholder="Create Username" />
                    <input type="password" name="password" placeholder="Create Password" />
                    <button type="submit">Sign Up</button>
                    <p>Already have an account? <a href="login.php">Login Here</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>