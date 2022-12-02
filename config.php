<?php
    //Try connecting to the Database
    $conn = mysqli_connect('localhost', 'root');

    if($conn == false){
        dir("Error: cannot connect");
    }
?>