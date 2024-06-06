<?php
include 'database.php';
include 'utils.php';

if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
    header('Location: displaycake.php');
}

$id = $_GET['id']; // 1 2 11 12 13
//echo "<script>console.log('ID inside deletecake.php" . $id . "');</script>";   
$sqlDelete = "DELETE FROM cakeinfo WHERE id=" . $id; 
$sqlResult = mysqli_query($connection,$sqlDelete);

if ($sqlResult)
    echo "Cake Name with id  :" . $id . " got deleted ";
else 
    echo "Cake Name with id  :" . $id . " did not get deleted ";

    mysqli_close($connection);
?>