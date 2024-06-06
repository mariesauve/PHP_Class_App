<?php

$allowedImageExtensions = array("webp","jpeg","jpg","png","tiff","gif","bmp");
$incorrectImageFormatMessage =  "<p style=\"color:red\">File not in the correct format, please try again</p>";


function sanitizeName($data, &$validData) {
    $data = trim($data);
    $regex = '/^[A-Za-z \'\.-]+$/';
    if (preg_match($regex, $data)) {
        return $data;
    } else {
        $validData = false;
        return '';
    }
}

function getCakeDetails($id) {
    global $connection; // Ensure the database connection is available within the function
    $id = mysqli_real_escape_string($connection, $id);
    $query = "SELECT `cakeName`, `icingName`, `infoDetails` FROM `cakeinfo` WHERE `id` = '$id'";
    $result = mysqli_query($connection, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return null;
    }
}




function cakeNameSubstring($cakeName, $httpValue) {
    if (empty($httpValue)) {
        return $cakeName;
    }

    $position = stripos($cakeName, $httpValue);
    $openingBold = "<b>";
    $closingBold = "</b>";

    if ($position === false) {
        // Just in case
        echo "String '$httpValue' was not found in the string '$cakeName'";
    } else {
        $before = substr($cakeName, 0, $position);
        $after = substr($cakeName, $position + strlen($httpValue));
      // $highlightedSubstring = strtoupper($httpValue[0]) . substr($httpValue, 1);
        $highlightedString = $before . $openingBold . $httpValue . $closingBold . $after; 
        return $highlightedString;
    }

    return $cakeName; 
}
?>
