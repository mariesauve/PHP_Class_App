<?php
session_start();
include 'header.php';
include 'database.php';
include 'utils.php';

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header('Location: displaycake.php');
}
echo "<br> <h5> Sign Up</h5><br>";
echo '<form method="post" action="login.php">
Username : <input type="text" name="userName">
Password : <input type="password" name="password">
Email : <input type="email" name="email">
<input type="hidden" name="signup" value="signup">    

<input type="submit" value="Sign Up" style="margin-top: 5px; margin-left: 15px;">
</form>';

echo "<br>Or :<br> <br> <h5> Sign In</h5> <br>";
echo '<form method="post" action="login.php">
Username : <input type="text" name="userName">
Password : <input type="password" name="password">
           <input type="hidden" name="signin" value="signin">    

<input type="submit" value="Sign In" style="margin-top: 5px; margin-left: 15px;">
</form>';

// Sign up = INSERT Sign In = SELECT from the table
$validData = true; 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (empty(trim($_POST['userName']))){
        echo " Please enter a username<br>";
        $validData = $validData && false;
    }
    else {
        $userName = trim($_POST['userName']);
    }

    if (empty(trim($_POST['password']))){
        echo " Please enter a password<br>";
        $validData = $validData && false;
    }
    else {
        $password = trim($_POST['password']);
    }

    // Sign up = Insert into database |  Sign in = Select from table 
    if($validData){
        if($_POST["signin"]){
            $sqlSelectUser = "SELECT * FROM users  WHERE `username` = '" .$userName . "' AND password='" . md5($password). "';";
            $sqlResult = mysqli_query($connection,$sqlSelectUser);
            if (mysqli_num_rows($sqlResult) > 0 ){
                echo "Username / password combination is correct ";
                $_SESSION["loggedin"] = true;
                header('Location:  displaycake.php');
            }
            else 
            {
                echo "Username / password combination is not correct ";
                $_SESSION["loggedin"] = false;
            }
        }
        else if($_POST["signup"]){
            $sqlInsertStudent = "INSERT INTO users (`username`,`password`, `email`) VALUES ('" .$userName . "','" .md5($password) . "','" .$email . "');";
            $sqlResult = mysqli_query($connection,$sqlInsertStudent);
            if ($sqlResult){
                echo "User created";
                $_SESSION["loggedin"] = true;
                header('Location:  displaycake.php');
            }
            else 
            {
                echo "User was not created";
                $_SESSION["loggedin"] = false;
            }
        } 
    }
    else {
        echo "Data not in the correct format";
    }
}// Request Method == POST

?>
 <?php
    echo  "<br>";
   echo  "<hr>";
include 'footer.php';
echo'<br>';
?>
