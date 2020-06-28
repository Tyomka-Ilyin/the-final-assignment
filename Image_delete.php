<?php

$user_id=$_POST['User_id'];
$nickname=$_POST['Nickname'];
$image=$_POST['Image'];

$servername = "localhost:3305"; // локалхост
$username = "root"; // имя пользователя
$password = "artyom56"; // пароль если существует
$dbname = "Image_upload_service"; 

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql1="SELECT id_image FROM Images WHERE image='$image'";
$id_image=$conn->query($sql1)->fetch(PDO::FETCH_COLUMN);

$sql2="DELETE FROM Images_users WHERE id_image='$id_image' and id_user='$user_id'";
$stmt=$conn->prepare($sql2);
$stmt->execute();

header("Location: http://dz4.ru/My_page.php?nickname=$nickname&id_user=$user_id");

?>