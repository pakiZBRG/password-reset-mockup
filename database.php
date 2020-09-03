<?php 
    $conn = mysqli_connect("localhost", "root", "", "forgotten_pass");

    if(mysqli_connect_errno()){
        echo "Failed to connect: ".mysqli_connect_errno();
    }
?>