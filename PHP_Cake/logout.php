<?php
session_start();
session_destroy();
header("Location: displaycake.php");
exit;
?>
