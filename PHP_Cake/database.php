<?php 
    $connection = mysqli_connect("localhost","root","","cakesdb");
    if (!$connection){
        die("Could not connect" . mysqli_connect($connection));
    }

?>