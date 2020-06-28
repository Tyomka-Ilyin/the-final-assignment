<?php

  class registration{

    private $nick;
    private $login;
    private $password;


    public function __construct($nick,$login,$password,$conn){
      if($login!="" and $password!="" and $nick!=""){
        $this->nick=$nick;
        $this->login=$login;
        $this->password=$password;
        $this->conn=$conn;
        }
    }

    public function Check_password(){
        $stmt = $this->conn->prepare("SELECT COUNT(id_user) FROM Users WHERE password= ? ORDER BY id_user");
        $stmt->execute(array("$this->password"));

        // set the resulting array to associative
        $result = $stmt->fetch(PDO::FETCH_COLUMN);

        return $result;
    }

    public function regis(){
        // Установка данных в таблицу
        $sql = "INSERT INTO Users(nickname, login, password)
        VALUES('$this->nick','$this->login','$this->password')";

        // Используйте exec (), поскольку результаты не возвращаются
        $this->conn->exec($sql);
        echo "Вы успешно зарегестрировались<br>";
    }
}

$servername = "localhost:3305"; // локалхост
$username = "root"; // имя пользователя
$password = "artyom56"; // пароль если существует
$dbname = "Image_upload_service"; 

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$reg= new registration($_POST['pole_nick'],$_POST['pole_login'],$_POST['pole_password'],$conn);

$kol=$reg->Check_password();

if($kol==0){
    $reg->regis();
}
else{
    echo "Пароль занят";
}

?>

<html>
 <head>
  <meta charset="utf-8">
  <title>Дз3</title>
 </head>
 <body>
 </body>
</html>