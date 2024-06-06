<?php
include 'utils.php';
    $httpValue = $_GET['query'];
    if (strlen($httpValue) >  0)
    {   
        include 'database.php';
               
        $sqlSelectCake = "SELECT * FROM cakeinfo WHERE cakeName LIKE '%" .$httpValue . "%'";
        $sqlResult = mysqli_query($connection,$sqlSelectCake);

        echo "<table style=\"border: 1px solid black\">
          <tr>
          <th style=\"border: 1px solid black\"> Picture </th>

                <th style=\"border: 1px solid black\"> ID </th>
                <th style=\"border: 1px solid black\"> Cake  </th>
                <th style=\"border: 1px solid black\"> Icing </th>
                <th style=\"border: 1px solid black\"> Details </th>
               
          </tr>";
        while ($row = mysqli_fetch_array($sqlResult)){
            echo "<tr>";
            echo   "<td style=\"border: 0px solid black\"><img src=\"" .$row['imagePath'] . "\"></td>";
            echo   "<td style=\"border: 1px solid black\">" .$row['id'] . "</td>";                     
            echo   "<td style=\"border: 1px solid black;text-transform: capitalize;\">" . cakeNameSubstring($row['cakeName'],$httpValue) . "</td>";
            echo   "<td style=\"border: 1px solid black\">" .$row['icingName'] . "</td>";
            echo   "<td style=\"border: 1px solid black\">" .$row['infoDetails'] . "</td>";
            echo  "</tr>";
        }
        echo "</table>";
        mysqli_close($connection);
    }



?>