<?php 
require_once('Config.php');
require_once(Config::APP_ROOT_DIR.'/classes/Schedule.php');

$db = new Schedule();

$date = $_GET['date'];

$schedules = $db ->getScheduleAll($date);
// var_dump($schedules);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="main.css">
<title>カレンダー</title>
</head>

<body>
<h3><?= $date ?></h3>

登録済みの予定
<ul>
<?php foreach($schedules as $schedule):?>
    <li>
    <a href="schedule_detail.php?id=<?=$schedule['id']?>"><?=$schedule['schedule']?></a>
    <div class="inline-block_test">
    <?php var_dump($schedule['id']);?>
    <form action="delete_schedule.php?id=<?=$schedule['id']?>" method="get">
    <!-- <form action="delete_schedule.php" method="post"> -->
    <input type="hidden" value=<?=$schedule['id']?> name="id">
    <input type="submit" value="削除">
    </form>

    <form action="edit_schedule.php?id=<?=$schedule['id']?>">
    <input type="submit" value="編集">
    </form>
    </div>
    </li>
<?php endforeach;?>
<?php
//  foreach($schedules as $schedule) {
//     print '<li>';
//     var_dump($schedule['id']);
//     print '<a href=schedule_detail.php?id='.$schedule['id'].'>'.$schedule['schedule'].'</a>';
//     print '<div class="inline-block_test">';
//     print '<form action=delete_schedule.php?id='.$schedule['id'].' method="get">';
//     print '<input type="submit" value="削除">';
//     print '</form>';

//     print '<form action=edit_schedule.php?id='.$schedule['id'].'>';
//     print '<input type="submit" value="編集">';
//     print '</form>';
//     print '</div>';
//     print '</li>';
//  }
//  print '</li>';
?>
</ul>
<?= $date ?>に新規登録する予定
<form action="add_schedule.php" method="post">
    <textarea name="schedule" rows="4" cols="40"></textarea>
    <input type="hidden" value="<?=$date?>" name="date">
    <input type="submit" value="登録">
</form>

</body>
</html>