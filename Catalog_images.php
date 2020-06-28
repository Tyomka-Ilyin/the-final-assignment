<?php

class images{

      public function __construct($conn){
           $this->conn=$conn;
        }

      public function search_id_images(){
          $id_images=$this->conn->query("SELECT id_image FROM Images")->fetchAll(PDO::FETCH_COLUMN);
          return $id_images;
        }

      public function marking_images($url,$id_images,$user_id){
      ?>
          <div style="background: #FFD700;width:190px;height:50px;margin-left: 45%;">
            <a href="<?php echo "$url" ?>" style="margin-left: 8%; width:75px;height:75px;font-size:1.4vw">Моя страница</a>
          </div>
          <h3 style="margin-left: 45.5%; width: 40%;background: #FFFFFF;padding: 10px;">Каталог картинок</h3>
        <?php
      foreach($id_images as $key=>$value){
        $image=$this->conn->query("SELECT image FROM Images WHERE id_image = '$id_images[$key]'")->fetch(PDO::FETCH_COLUMN);
          ?>
          <form method="post" action="Image_form_user.php" enctype="multipart/form-data">
            <div style="float: left;">
            <button name="img_button" value="<?php echo($image); ?>"> <img src="/<?php echo($image); ?>" width=295 height=295 /></button>
          </div>
          <input type="hidden" value="<?php echo "$user_id" ?>" name="user_id">
        </form>
        <?php
      }
    }
}

?>

<html>
 <head>
  <meta charset="utf-8">
  <title>Главная</title>
  <style type="text/css">
  </style>
 </head>
 <body>

<?php

$url=$_POST['URL'];

$nickname = $_POST['Nickname'];
$user_id = $_POST['User_id'];

$servername = "localhost:3305";
$username = "root";
$password = "artyom56";
$dbname = "Image_upload_service";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$images = new images($conn);
$ids=$images->search_id_images();
$images->marking_images($url,$ids,$user_id);

?>

 </body>
</html>