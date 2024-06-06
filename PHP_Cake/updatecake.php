<?php
session_start(); // Ensure the session is started

include 'header.php';
include 'database.php';
include 'utils.php';

// Check if the user is logged in
if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
    header('Location: displaycake.php');
    exit;
}

// Handle GET request to fetch cake details
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch the cake details from the database using the id
    $cake = getCakeDetails($id);
    $cakeName = $cake['cakeName'];
    $icingName = $cake['icingName'];
    $infoDetails = $cake['infoDetails'];

    echo "<form method=\"post\" action=\"updatecake.php\">
    &nbsp; &nbsp; Cake Name :&nbsp; <input type=\"text\" name=\"cakeName\" value=\"" . htmlspecialchars($cakeName, ENT_QUOTES) . "\" ><br/><br/>
    &nbsp;  &nbsp; Icing Name  :&nbsp; <input type=\"text\" name=\"icingName\"  value=\"" . htmlspecialchars($icingName, ENT_QUOTES) . "\" ><br/><br/>
    &nbsp;   &nbsp; Details:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type=\"text\" name=\"infoDetails\"  value=\"" . htmlspecialchars($infoDetails, ENT_QUOTES) . "\" > <br/><br/>
                 <input type=\"hidden\" name=\"id\" value=\"" . htmlspecialchars($id, ENT_QUOTES) . "\"> 
                 &nbsp;  &nbsp; <input type=\"submit\" value=\"Update Cake\">
    </form>";
} 
// Handle POST request to update cake details
else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validData = true;
    $cakeName = sanitizeName($_POST['cakeName'], $validData);
    $icingName = sanitizeName($_POST['icingName'], $validData);
    $infoDetails = sanitizeName($_POST['infoDetails'], $validData);
    $id = $_POST['id'];

    if ($validData) {
        $sqlUpdateCake = "UPDATE `cakeinfo` SET `cakeName`='" . mysqli_real_escape_string($connection, $cakeName) . 
                        "', `icingName`='" . mysqli_real_escape_string($connection, $icingName) . 
                        "', `infoDetails`='" . mysqli_real_escape_string($connection, $infoDetails) . 
                        "' WHERE `id`='" . mysqli_real_escape_string($connection, $id) . "'";

        $sqlResult = mysqli_query($connection, $sqlUpdateCake);
        if ($sqlResult) {
            echo "Data was updated";
            header('Location: displaycake.php');
            exit;
        } else {
            echo "Data was not updated: " . mysqli_error($connection);
        }
    } else {
        echo "Data not in the correct format";
    }
}
echo  "<br>";
echo  "<hr>";
include 'footer.php';
echo'<br>';
?>
