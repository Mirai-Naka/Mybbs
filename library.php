<?php
//htmlsapecialcharsを短くする
function h($value){
    return htmlspecialchars($value,ENT_QUOTES);
}

//dbへの接続
function dbconnect(){
    $db = new mysqli('mysql:heroku_6a1f0d0050fbc9b;host=us-cdbr-east-06.cleardb.net; charset=utf8', 'b5aaf9d54ebf04', 'dc5e6fcf');
    if(!$db){//上手く接続できなかった時エラーに出力
		die($db->error);
	}
    return $db;
}

?>
