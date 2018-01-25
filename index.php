<?php

session_start();
$err_msg1 = "";
$err_msg2 = "";
$err_msg3 = "";
$err_msg4 = "";
$err_msg5 = "";
$name = "";
$address = "";
$comment = "";


//投稿がある場合は投稿されたデータをそうでなければ空白で定義する
//定義しておかないとエラーになる

if(!empty($_SESSION["ID"])){
  if($_SESSION["ID"]==0 || $_SESSION["ID"]==null){
    $err_msg3 = "半角数字を入力してください";
  }
}

if(!empty($_SESSION['name'])){
  if( isset( $_SESSION['name']) == true ){
      $name = $_SESSION['name'];
  }
}

if(!empty($_SESSION['comment'])){
  if( isset( $_SESSION['comment']) == true ){
      $comment = $_SESSION['comment'];
  }
}

if(!empty($_SESSION['address'])){
  if( isset( $_SESSION['address']) == true ){
      $address = $_SESSION['address'];
  }
}

if( isset( $_SESSION['err']) == true ){
    $err_msg4 = $_SESSION['err'];
}


if ( $name   == "" ) $err_msg1 = "名前を入力してください";

if ( $comment    == "" )  $err_msg2 = "コメントを入力してください";

if ( $address    == "" )  $err_msg5 = "アドレスを入力してください";

?>





<!DOCTYPE html>
<html>
  <head>
    <script src="jquery/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="test.js"></script>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.css">
    <meta charset="utf-8">
    <title>サンプル掲示板</title>
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="test.css">
  </head>
  <body>
    <div class="bk">
    <div class="contents">
      <h1>サンプル掲示板</h1>

      <hr class="lain">

      <form method="post" action="upload.php">
        <?php echo "<font color='red'> $err_msg4 </font>"; ?>
        <h2>ID</h2>
        <input type="text" class="form-control" name="i" /><?php echo "<font color='red'> $err_msg3 </font>"; ?>
        <h2>名前</h2>
        <input type="text" name="n" /><?php echo "<font color='red'> $err_msg1 </font>"; ?>
        <h2>アドレス</h2>
        <input type="text" name="a" /><?php echo "<font color='red'> $err_msg5 </font>"; ?>
        <h2>コメント</h2>
        <textarea name="c"></textarea><?php echo "<font color='red'> $err_msg2 </font>"; ?>

        <p><button type="submit" class="sousin" name="send">送信</button></p>
      </form>

      <hr>

      <h2>登録データ</h2>

      <ul>

<?php
require_once "db_setting.php";


try {
  // データベース読み込み

  $dbh = new PDO('mysql:host='.$host.';dbname='.$database, $user, $pass);

  foreach($dbh->query('SELECT * from '.$table) as $row) {
      // print_r($row);


      echo "<li class='sentence'>";
      echo "<span class='id'>".$row["UserID"]."</span> : ";
      echo "<span class='name'>".$row["name"]."</span>　";
      echo "<span class='address'>".$row["address"]."</span>";
      echo "<p class='comment'>".$row["comment"]."</p>";

      echo "<div class='del-btn'>";
      echo "<form method='post' action='delete.php'>";
      echo "<input type='hidden' name='UserID' value='".$row["UserID"]."'>";
      echo "<button type='submit' class='sakujo'>削除</button>";
      echo "</div>";

      echo "</form>";
      echo "</li>";
  }
  $dbh = null;
} catch (PDOException $e) {
  print "エラー!: " . $e->getMessage() . "<br/>";
  die();
}
?>

      </ul>
    </div>
    </div>

  </body>
</html>
