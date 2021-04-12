<?php
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

include 'db_connect.php';
$dbConnection = OpenCon();
$stmt = $dbConnection->prepare("INSERT INTO user(UID,Name,Password) values(4,'$name','$password')");
$stmt->execute();
echo"Inserted!";

?>
