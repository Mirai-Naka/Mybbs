<?php
session_start();
require('library.php');
$stmt=$db->preapare('select * from posts where id=?');
$id=1;
$stmt->bind_param('i', $id);
$stmt->execute();

$stmt->bind_result($id, $message, $created);
$stmt->fetch();

$db=dbconnect();

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MyBBS</title>

    <link rel="stylesheet" href="style.css"/>
</head>

<body>
<div id="wrap">
    <div id="head">
        <h1>MyBBS</h1>
    </div>
    <div id="content">
        <div style="text-align: right"><a href="logout.php">ログアウト</a></div>
        <form action="" method="post">
            <dl>
                <dt><?php echo h($name); ?>さん、メッセージをどうぞ</dt>
                <dd>
                    <textarea name="message" cols="50" rows="5"></textarea>
                </dd>
            </dl>
            <div>
                <p>
                    <input type="submit" value="投稿する"/>
                </p>
            </div>
        </form>

        <?php $stmt = $db->prepare('select p.id, p.member_id,p.message, p.created, m.name, m.picture from posts p, members m where m.id=p.member_id order by id desc');
        if(!$stmt){
            die($db->error);
        }
        $success=$stmt->execute();
        if(!$success){
            die($db->error);
        }
        $stmt->bind_result($id,$member_id,$message,$created,$name,$picture);
            while($stmt->fetch()):
            ?>
        <div class="msg">
            <?php if($picture): ?>
            <img src="member_picture/<?php echo h($picture); ?>" width="48" height="48" alt=""/>
           <?php endif; ?>
            <p><?php echo h($name); ?><span class="name"> (<?php echo h($created); ?>)</span></p>
            <p class="day"><a href="view.php?id=<?php echo h($id);//bind_resultdeで取得した＄id ?>"><?php echo h($message); ?></a>
            <?php if($_SESSION['id']=== $member_id): ?>
            [<a href="delete.php?id=<?php echo h($id); ?>" style="color: #F33;">削除</a>]
            <?php endif; ?>
            </p>
        </div>
        <?php endwhile; ?>
    </div>
</div>
</body>

</html>