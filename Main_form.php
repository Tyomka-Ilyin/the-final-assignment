<html>
 <head>
  <meta charset="utf-8">
  <title>Главная</title>
  <style type="text/css">
  </style>
 </head>
 <body>
        <h1 style="margin-left: 45%; width: 40%;background: #FFFFFF;padding: 10px;">Главная</h1>

        <form method="post" action="Registration_form.php" enctype="multipart/form-data" style="margin-left: 43.5%; width: 40%;background: #FFFFFF;">
        	<input name="Button_reg" type="submit" value="Регистрация" style="width:200px;height:75px;font-size:1.4vw" /><br>
        </form>

        <form method="post" action="Input_form.php" enctype="multipart/form-data" style="margin-left: 43.5%; width: 40%;background: #FFFFFF;">
        	<input name="Button_inp" type="submit" value="Вход" style="width:200px;height:75px;font-size:1.4vw" /><br>
        </form>
 </body>
</html>

<?php
  
class images{

      public function __construct($conn){
           $this->conn=$conn;
        }

      public function search_id_images(){
          $id_images=$this->conn->query("SELECT id_image FROM Images")->fetchAll(PDO::FETCH_COLUMN);
          return $id_images;
        }

      public function marking_images($id_images){
        ?>
        <h3 style="margin-left: 44%; width: 40%;background: #FFFFFF;padding: 10px;">Каталог картинок</h3>
      <?php
      foreach($id_images as $key=>$value){
        $image=$this->conn->query("SELECT image FROM Images WHERE id_image = '$id_images[$key]'")->fetch(PDO::FETCH_COLUMN);
          ?>
          <form method="post" action="Image_form.php" enctype="multipart/form-data">
            <div style="float: left;">
            <button name="img_button" value="<?php echo($image); ?>"> <img src="/<?php echo($image); ?>" width=300 height=300 /></button>
          </div>
        </form>
        <?php
      }
    }

}

$servername = "localhost:3305"; 
$username = "root"; 
$password = "artyom56"; 
$dbname = "Image_upload_service"; 

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$images = new images($conn);
$ids=$images->search_id_images();
$images->marking_images($ids);

?>