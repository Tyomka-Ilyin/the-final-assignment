<?php

class input{

    public function __construct($login,$password,$conn){
          $this->login=$login;
          $this->password=$password;
          $this->conn=$conn;
    }

    public function search_page(){
          $result=$this->conn->query("SELECT COUNT(nickname) FROM Users WHERE login = '$this->login' and password = '$this->password'")->fetchColumn();
          return $result;
    }

    public function nick_page(){
          $nick=$this->conn->query("SELECT nickname FROM Users WHERE login = '$this->login' and password = '$this->password'")->fetch(PDO::FETCH_COLUMN);
          return $nick;
    }

    public function search_user_id($nick){
      $id_user=$this->conn->query("SELECT id_user FROM Users WHERE nickname='$nick'")->fetch(PDO::FETCH_COLUMN);
      return $id_user;
    }
}

if(isset($_POST['but_inp'])){
  if($_POST['pole_login']!='' and $_POST['pole_password']!=''){
      $login=$_POST['pole_login'];
      $password=$_POST['pole_password'];

      $servername = "localhost:3305"; // локалхост
      $username = "root"; // имя пользователя
      $password_bd = "artyom56"; // пароль если существует
      $dbname = "Image_upload_service"; 

      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_bd);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $inp = new input($login,$password,$conn);

      $kol=$inp->search_page();

      if($kol==1){
        $nickname=$inp->nick_page();

        $id_user=$inp->search_user_id($nickname);

        header("Location: My_page.php?nickname=$nickname&id_user=$id_user");
      }
      else{
        echo "Неверный логин или пароль";
      }
  }
  else{
    echo "Поля не заполнены";
  }
}

?>

<html>
 <head>
  <meta charset="utf-8">
  <title>Вход</title>
  <style type="text/css">
  </style>
 </head>
 <body>
        <h1 style="margin-left: 48%; width: 40%;background: #FFFFFF;padding: 10px;">Вход</h1>

        <form method="post" enctype="multipart/form-data" style="margin-left: 43.4%; width: 40%;background: #FFFFFF;">
        	<input name="pole_login" type="text" placeholder="Логин" style="width:270px;height:40px;font-size:1.4vw" /><br>
          <input name="pole_password" type="text" placeholder="Пароль" style="width:270px;height:40px;font-size:1.4vw" /><br>
          <input type="submit" name="but_inp" value="Войти" style="width:270px;height:75px;font-size:1.4vw">
        </form>
 </body>
</html>