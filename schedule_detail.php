<?php 
require_once('Config.php');

require_once(Config::APP_ROOT_DIR.'/classes/Schedule.php');
require_once(Config::APP_ROOT_DIR.'/classes/Common.php');

$db = new Schedule();

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $schedule = $db ->getSchedule($id);
    var_dump($_GET);
} 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="main.css">
<title>カレンダー</title>
</head>

<body>
<h4>登録日：<?= $schedule['date'] ?></h4>
<h4>予定：<?= $schedule['schedule']?></h4>

<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3280.847815978891!2d135.49927091523168!3d34.683790180438905!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6000e71dfcf82d39%3A0xcbd330107e5eddaf!2z44Of44Op44Kk44K244KrIOacrOeUuuW6lw!5e0!3m2!1sja!2sjp!4v1578537170639!5m2!1sja!2sjp" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>

</body>
</html>