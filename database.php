<?php
    //Localhost 
    $conn = mysqli_connect("localhost", "root", "", "forgotten_pass");

    //Live
    //$conn = mysqli_connect("us-cdbr-east-02.cleardb.com", "b89e18ed35296e", "00760b5c5825e13", "heroku_ad641edb43d1ca4");

    if(mysqli_connect_errno()){
        echo "Failed to connect: ".mysqli_connect_errno();
    }
?>