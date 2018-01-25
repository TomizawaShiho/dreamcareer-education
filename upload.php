<?php

$err_msg4 = "";

$UserID  = $_REQUEST["i"];
$name    = $_REQUEST["n"];
$comment = $_REQUEST["c"];
$address = $_REQUEST["a"];
$sousin  = $_REQUEST["send"];

session_start();
$_SESSION['ID']=$UserID;
$_SESSION['name']=$name;
$_SESSION['comment']=$comment;
$_SESSION['address']=$address;
$_SESSION['sousin']=$sousin;
$_SESSION['err']="";
require_once "db_setting.php";

// データベース書き込み
$dbh = new PDO('mysql:host='.$host.';dbname='.$database, $user, $pass);
if($UserID != null && $UserID != 0 && $name != null && $address != null && $comment != null){
$stmt = $dbh -> prepare("INSERT INTO ".$table."(UserID,name,comment,address) VALUES (:UserID, :name, :comment, :address)");
$stmt->bindValue(':UserID', $UserID, PDO::PARAM_INT);
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
$stmt->bindParam(':address', $address, PDO::PARAM_STR);
$stmt->execute();
}
else{
  $err_msg4 = "全項目入力してください";
  $_SESSION['err']=$err_msg4;
}

// index.phpにリダイレクト
header("Location: index.php");
