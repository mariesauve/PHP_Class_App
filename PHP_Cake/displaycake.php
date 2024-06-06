<?php
session_start();
include 'header.php';
include 'database.php';
// include 'utils.php';



$sqlSelectCake = "SELECT * FROM cakeinfo";
$sqlResult = mysqli_query($connection,$sqlSelectCake);
     echo "<table class=\"table table-striped table-hover\" style=\"margin-top: 20px; margin-left: 2px; border: 2px solid black\">
     <tr>
     <th style=\"border: 1px solid black\"> Picture </th>
     <th style=\"border: 1px solid black\"> ID </th>
     <th style=\"border: 1px solid black\"> Cake </th>
     <th style=\"border: 1px solid black\"> Icing </th>
     <th style=\"border: 1px solid black\"> Details </th>";
   
           if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
           echo  "<th style=\"border: 1px solid black\"> Update </th>
                  <th style=\"border: 1px solid black\"> Upload Picture </th>
                  <th style=\"border: 1px solid black\"> Delete </th>";
           }
     echo "</tr>";
   while ($row = mysqli_fetch_array($sqlResult)){
       echo "<tr>";
       if ($row['imagePath'])
          echo   "<td style=\"border: 1px solid black\"><img src=\"" .$row['imagePath'] . "\"></td>";
        else 
          echo   "<td style=\"border: 1px solid black\"></td>";
       echo   "<td style=\"border: 1px solid black\">" .$row['id'] . "</td>";
       echo   "<td style=\"border: 1px solid black\">" .$row['cakeName'] . "</td>";
       echo   "<td style=\"border: 1px solid black\">" .$row['icingName'] . "</td>";
       echo   "<td style=\"border: 1px solid black\">" .$row['infoDetails'] . "</td>";
       if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
            echo "<td><button  type=\"button\" onclick=\"updateCake('" .$row['id'] . "','" .$row['cakeName'] . "','".$row['icingName'] . "','".$row['infoDetails'] ."')\" class=\"btn btn-outline-success btn-sm\"><i class=\"fa-solid fa-pen-to-square\"></i> Update</button></td>
               <td><button  type=\"button\" onclick=\"uploadPicture('" .$row['id'] . "','" .$row['cakeName'] . "','".$row['icingName'] . "')\" class=\"btn btn-outline-primary btn-sm\"><i class=\"fa-solid fa-file-arrow-up\"></i> Upload Picture</button></td>
               <td><button  type=\"button\" onclick=\"deleteCake('" .$row['id'] .  "')\" class=\"btn btn-outline-danger btn-sm\"><i class=\"fa-solid fa-trash-can\"></i> Delete</button></td>";
                       // ^^ class=\"newbtn\"
            }
       echo  "</tr>";
   }
   echo "</table>&nbsp; &nbsp; &nbsp; &nbsp; ";
   echo  "<br>";
   echo  "<hr>";
include 'footer.php';
echo'<br>';
?>



