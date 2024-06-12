<?php
session_start();
session_regenerate_id();
unset($_SESSION["studentnum"]);
unset($_SESSION["lastname"]);
unset($_SESSION["email"]);
session_destroy();
header('Location: index.php');
exit;
?>