<?php
//htmlsapecialcharsを短くする
function h($value){
    return htmlspecialchars($value,ENT_QUOTES);
}

//dbへの接続
function dbconnect(){
    $db = new mysqli('us-cdbr-east-06.cleardb.net', 'b5aaf9d54ebf04', 'dc5e6fcf', 'heroku_6a1f0d0050fbc9b');
    $db->query("SET time_zone = '+09:00'");
    if(!$db){//上手く接続できなかった時エラーに出力
		die($db->error);
	}
    return $db;
}

?>
