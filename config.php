<?php 
global $db;
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "file_upload";

$db = new mysqli($servername, $username, $password, $dbname);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>