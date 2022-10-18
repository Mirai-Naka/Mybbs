<?php
//htmlsapecialcharsを短くする
function h($value){
    return htmlspecialchars($value,ENT_QUOTES);
}

//dbへの接続
function dbconnect(){
    $db = new mysqli('localhost','root','root','mybbs');//dbに接続
    if(!$db){//上手く接続できなかった時エラーに出力
		die($db->error);
	}
    return $db;
}

?>