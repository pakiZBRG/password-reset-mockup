<?php
    //Localhost 
    // $conn = mysqli_connect("localhost", "root", "", "forgotten_pass");

    //Live
    $conn = mysqli_connect("sql7.freemysqlhosting.net", "sql7363547", "gQzHsTPck7", "sql7363547");

    if(mysqli_connect_errno()){
        echo "Failed to connect: ".mysqli_connect_errno();
    }
?>
