<?php

$image=$_POST['img_button'];
$user_id=$_POST['user_id'];

$servername = "localhost:3305";
$username = "root"; 
$password = "artyom56"; 
$dbname = "Image_upload_service"; 

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql_id_img="SELECT id_image FROM Images WHERE image='$image'";
$id_image=$conn->query($sql_id_img)->fetch(PDO::FETCH_COLUMN);

$sql_update="UPDATE Images SET views=views+1 WHERE id_image='$id_image'";
$stmt=$conn->prepare($sql_update);
$stmt->execute();

$sql_views="SELECT views FROM Images WHERE id_image='$id_image'";
$views=$conn->query($sql_views)->fetch(PDO::FETCH_COLUMN);

?>

<img src="/<?php echo($image); ?>" width="100%" height="100%" />

<form method="post" action="Add_image.php" enctype="multipart/form-data" style="margin-left: 43.5%; width: 40%;background: #FFFFFF;">
	<div style="margin-left: 2%; width: 40%;background: #FFFFFF;font-size:1.4vw"><?php echo "Просмотров: "."$views"; ?></div>
    <input name="Button_reg" type="submit" value="Добавить" style="width:200px;height:75px;font-size:1.4vw" />
    <input type="hidden" value="<?php echo "$image" ?>" name="Image">
    <input type="hidden" value="<?php echo "$user_id" ?>" name="User_id">
</form>