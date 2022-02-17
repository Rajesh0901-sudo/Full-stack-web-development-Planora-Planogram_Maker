<?php ob_start();
?>
<?php
session_start();
unset($_SESSION["id"]);
unset($_SESSION["username"]);
unset($_SESSION["error"]);
unset($_SESSION["type"]);
session_unset();
$logout='1';
session_destroy();
header("Location: ../index.php");
ob_flush();
?>