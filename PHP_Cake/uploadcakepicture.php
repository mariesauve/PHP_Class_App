<?php
    session_start();
    include 'header.php';
    include 'database.php';
    include 'utils.php';

    if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
     header('Location: displaycake.php');
 }

    $error = false;
    if ($_SERVER["REQUEST_METHOD"] == "GET"){  
         $id = $_GET['id'];
         $cakeName = $_GET['cakeName'];
         $icingName = $_GET['icingName'];
         if (isset($_GET['error']) && $_GET['error'] !=null)
              $error = $_GET['error'];
    }

echo "<form action=\"uploadcakepicture.php\" method=\"post\" enctype=\"multipart/form-data\">
&nbsp; Select cake info image to upload: <br/><br/>
&nbsp; <input type=\"file\" name=\"fileUpload\" id=\"fileUpload\"><br/><br/>
&nbsp;  <input type=\"submit\" name=\"submit\" value=\"Upload Image\">
&nbsp;  <input type=\"hidden\" name=\"id\" value=\"" . htmlspecialchars($id, ENT_QUOTES, 'UTF-8') . "\">   
&nbsp;  <input type=\"hidden\" name=\"cakeName\" value=\"" . $cakeName . "\">   
&nbsp;   <input type=\"hidden\" name=\"icingName\" value=\"" . $icingName . "\">   
    </form>";
    if ($error)
    echo $incorrectImageFormatMessage;

    /* After clicking submit */
    if ($_SERVER["REQUEST_METHOD"] == "POST"){  
         $id = $_POST["id"];       
         $firstName = $_POST["cakeName"]; 
         $lastName = $_POST["icingName"];           

         $target_directory = "image_uploads/";
         $target_file = $target_directory . basename($_FILES["fileUpload"]["name"]);
         $tmp_path = $_FILES["fileUpload"]["tmp_name"];
         
         echo "temp path : " . $tmp_path . "<br>";
         $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
         if (in_array($imageFileType, $allowedImageExtensions)){
              if (move_uploaded_file($tmp_path,$target_file)){
                   echo "File uploaded successfully <br>";
                   $sqlUpdateCake = "UPDATE `cakeinfo` SET `imagePath`='" . $target_file . "' WHERE `id` ='" . $id . "'";
                   echo $sqlUpdateCake . "<br>";
                   $sqlResult = mysqli_query($connection,$sqlUpdateCake);
                   if ($sqlResult){
                        echo "Data was updated ";
                        header('Location: displaycake.php');
                   } else {
                        echo " Data was not updated";
                   }
              }// file uploaded
              else {
                   echo "File not uploaded successfully";
              }
         }// correct format 
         else {
              echo $incorrectImageFormatMessage;
              header('Location: uploadcakepicture.php?id='.$id.'&error=true&cakeName='.$cakeName.'&icingName='.$icingName);
         }
    }
    echo  "<br>";
    echo  "<hr>";
 include 'footer.php';
 echo'<br>';
 ?>