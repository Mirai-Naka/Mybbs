<?php
session_start();
require('library.php');
if(isset($_SESSION['id'])&& isset($_SESSION['name'])){
    $id=$_SESSION['id'];
    $name = $_SESSION['name']; //セッションの情報があれば処理続行、なければログインページへ
}else{
    header('Location: login.php');
    exit();
}

$post_id=filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
if(!$post_id){
    header('Location: index.php');
    exit();
}

$db=dbconnect();
$stmt=$db->prepare('delete from posts where id=? and member_id=? limit 1');//member_id=?を指定することでURLから他人の書き込みを削除sることを防ぐ
if(!$stmt){
    die($db->error);
}
$stmt->bind_param('ii',$post_id,$id);
$success=$stmt->execute();
if(!$success){
    die($db->error);
}
header('Location: index.php'); exit();
?>
