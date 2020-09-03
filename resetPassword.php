<?php
    include "database.php";

    if(!isset($_GET['code'])){
        exit("Can't find page");
    }

    $code = $_GET["code"];
    $sql = "SELECT email FROM reset WHERE code='$code'";
    $run = mysqli_query($conn, $sql);

    if(mysqli_num_rows($run) == 0){
        exit("Can't find page");
    }

    if(isset($_POST["submit"])){
        $pwd = $_POST["pwd"];
        $c_pwd = $_POST["c_pwd"];

        if($pwd != $c_pwd){
            echo "Passwords do not match.";
            exit();
        }
        else if($pwd > 9){
            echo "Minimum length is 8";
            exit();
        }

        $hashPwd = password_hash($pwd, PASSWORD_DEFAULT);
        $row = mysqli_fetch_array($run);
        $email = $row['email'];

        $query = mysqli_query($conn, "UPDATE users SET password='$hashPwd' WHERE email='$email';");
        
        if($query){
            $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
            $row = mysqli_fetch_array($query);
            exit("Password updated, ".$row['username']);
        }
        else {
            exit('Something went wrong');
        }
    }

?>

<form method="POST">
    <input type='password' name='pwd' placeholder='New password'><br>
    <input type='password' name='c_pwd' placeholder='Repeat password'><br>
    <input type='submit' name='submit' value='Reset password'>
</form>