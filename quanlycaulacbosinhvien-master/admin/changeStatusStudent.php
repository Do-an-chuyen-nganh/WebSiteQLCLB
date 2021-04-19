<?php
include '../lib/database.php';
$db = new Database;
$db->changeStatusStudent($_GET["id"],$_GET["status"]);
header('Location: ' . "acceptStudent.php", true);
?>