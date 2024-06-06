<?php
include 'header.php';
include 'database.php';
include 'utils.php';

// if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
//     header('Location: displaycake.php');
//     exit; // Ensure script stops execution after redirection
// }
echo "<br>";
// Display the form to add a cake
echo '<form method="post" action="addcake.php">
&nbsp; Cake Name : &nbsp; <input type="text" name="cakeName"><br/><br/>
&nbsp; Icing Name : &nbsp; <input type="text" name="icingName"><br/><br/>
&nbsp; Details   : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="text" name="infoDetails"><br/> <br/>
&nbsp; <input type="submit" value="Add Cake">
</form>';

// Initialize variables
$cakeName = $icingName = $infoDetails = "";
$validData = true;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $cakeName = sanitizeName($_POST["cakeName"], $validData);
    $icingName = sanitizeName($_POST["icingName"], $validData);
    $infoDetails = sanitizeName($_POST["infoDetails"], $validData);

    // If data is valid, insert into the database
    if ($validData) {
        $sqlInsertCake = "INSERT INTO cakeinfo (`cakeName`, `icingName`, `infoDetails`) 
                          VALUES ('" . $cakeName . "','" . $icingName . "','" . $infoDetails . "');";

        $sqlResult = mysqli_query($connection, $sqlInsertCake);
        if ($sqlResult) {
            // Redirect after successful insertion
            header('Location: displaycake.php');
            exit; // Ensure script stops execution after redirection
        } else {
            echo "Not able to insert into the table";
        }
    } else {
        echo "Data not in the correct format";
    }
}
echo"<br>";
echo"<hr>";
include 'footer.php';
echo"<br>";

?>
