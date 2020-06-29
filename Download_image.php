<?php

function ins_image($conn,$sql)
{
  $stmt=$conn->prepare($sql);
  $stmt->execute();
}

function sel_id($conn,$sql)
{
  $id=$conn->query($sql)->fetch(PDO::FETCH_COLUMN);
  return $id;
}

  if(isset($_FILES)){

      $user_id = $_POST['User_id'];
      $nickname=$_POST['Nickname'];

      $servername = "localhost:3305";
      $username = "root"; 
      $password = "artyom56"; 
      $dbname = "Image_upload_service";

      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      foreach ($_FILES["images"]["name"] as $key => $value) {
        $image = $_FILES["images"]["name"][$key];
        $tmp_path = $_FILES['images']['tmp_name'][$key];
        $path='uploads/';
        $full_path=$path.$image;

        move_uploaded_file($tmp_path, $full_path);

        $sql_ins_image="INSERT INTO Images (image,views) VALUES ('$full_path',1)";
        ins_image($conn,$sql_ins_image);

        $sql_last_id="SELECT id_image FROM Images ORDER BY id_image DESC LIMIT 1";
        $last_id=sel_id($conn,$sql_last_id);

        $sql_ins="INSERT INTO Images_users(id_user,id_image) VALUES ('$user_id','$last_id')";
        ins_image($conn,$sql_ins);
      
      }

      header("Location: http://dz4.ru/My_page.php?nickname=$nickname&id_user=$user_id");
  }
  else {
    echo "Не удалось загрузить изображение";
  }

?>