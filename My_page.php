<?php

	class page{

		public function __construct($nickname,$user_id,$conn){
       		$this->nickname=$nickname;
       		$this->user_id=$user_id;
       		$this->conn=$conn;
    }

		public function marking_page($url){
			?>
        	<form method="post" action="Download_image.php" enctype="multipart/form-data" style="margin-left: 43.4%; width: 40%;background: #FFFFFF;">
        		<h1 style="margin-left: 13%; width: 40%;background: #FFFFFF;padding: 10px;"><?php print($this->nickname)?></h1>
          		<input type="file" name="images[]" multiple style="margin-left: 10%; width: 40%;background: #FFFFFF;"><br>
              <input type="hidden" value="<?php echo "$this->nickname" ?>" name="Nickname">
              <input type="hidden" value="<?php echo "$this->user_id" ?>" name="User_id">
         		  <input type="submit" value="Загрузить" style="width:270px;height:75px;font-size:1.4vw">
        	</form>

        	<form method="post" action="Catalog_images.php" enctype="multipart/form-data" style="margin-left: 43.4%; width: 40%;background: #FFFFFF;">
            <input type="hidden" value="<?php echo "$url" ?>" name="URL">
            <input type="hidden" value="<?php echo "$this->nickname" ?>" name="Nickname">
            <input type="hidden" value="<?php echo "$this->user_id" ?>" name="User_id">
        		<input type="submit" value="Каталог картинок" style="width:270px;height:75px;font-size:1.4vw">
        	</form>

        	<form method="post" action="Main_form.php" enctype="multipart/form-data" style="margin-left: 43.4%; width: 40%;background: #FFFFFF;">
        		<input type="submit" value="Выйти" style="width:270px;height:75px;font-size:1.4vw">
        	</form>
        	
        	<h3 name="Nickname" style="margin-left: 47%; width: 40%;background: #FFFFFF;padding: 10px;">Мои картинки</h3>
			<?
		}

		public function search_id_images(){
			$id_images=$this->conn->query("SELECT id_image FROM Images_users WHERE id_user = '$this->user_id'")->fetchAll(PDO::FETCH_COLUMN);
			return $id_images;
		}

		public function marking_images($id_images){
			foreach($id_images as $key=>$value){
				$image=$this->conn->query("SELECT image FROM Images WHERE id_image = '$id_images[$key]'")->fetch(PDO::FETCH_COLUMN);
     			?>
     			<form method="post" action="Image_delete_form.php" enctype="multipart/form-data">
     				<div style="float: left;">
						<button name="img_button" value="<?php echo($image); ?>"> <img src="/<?php echo($image); ?>" width=295 height=295 /></button>
					</div>
					<input type="hidden" value="<?php echo "$this->nickname" ?>" name="Nickname">
          <input type="hidden" value="<?php echo "$this->user_id" ?>" name="User_id">
				</form>
				<?php
			}
		}
	}

?>

<html>
 <head>
  <meta charset="utf-8">
  <title>Моя страница</title>
  <style type="text/css">
  </style>
 </head>
 <body>
<?php

$servername = "localhost:3305";
$username = "root"; 
$password = "artyom56";
$dbname = "Image_upload_service"; 

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$nickname=$_GET['nickname'];
$user_id=$_GET['id_user'];

$url = $_SERVER['REQUEST_URI'];

$page = new page($nickname,$user_id,$conn);
$page->marking_page($url);
$ids_images=$page->search_id_images();
$page->marking_images($ids_images);

?>

 </body>
 </html>