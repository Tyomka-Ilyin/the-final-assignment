<?php

$image=$_POST['img_button'];

$servername = "localhost:3305"; // локалхост
$username = "root"; // имя пользователя
$password = "artyom56"; // пароль если существует
$dbname = "Image_upload_service"; 

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql1="SELECT id_image FROM Images WHERE image='$image'";
$id_image=$conn->query($sql1)->fetch(PDO::FETCH_COLUMN);

$sql3="SELECT views FROM Images WHERE id_image='$id_image'";
$views=$conn->query($sql3)->fetch(PDO::FETCH_COLUMN);

?>

<img src="/<?php echo($image); ?>" width="100%" height="100%" />
<div style="margin-left: 45%; width: 40%;background: #FFFFFF;font-size:1.4vw"><?php echo "Просмотров: "."$views"; ?></div>