<?php

session_start();

$id_user=$_POST['User_id'];

$image=$_POST['Image'];

$servername = "localhost:3305";
$username = "root";
$password = "artyom56";
$dbname = "Image_upload_service"; 

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql1="SELECT id_image FROM Images WHERE image='$image'";
$id_image=$conn->query($sql1)->fetch(PDO::FETCH_COLUMN);

$sql2="INSERT INTO Images_users (id_user,id_image) VALUES ('$id_user','$id_image')";
$stmt=$conn->prepare($sql2);
$stmt->execute();

echo "Картинка загружена";

?>