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

</ul>
<?= $date ?>に新規登録する予定
<form action="add_schedule.php" method="post">
    <textarea name="schedule" rows="4" cols="40"></textarea>
    <input type="hidden" value="<?=$date?>" name="date">
    <br>
    <input type="button" value="座標取得" onclick="check()">
    緯度：<input type="text" id="lat" name="lat" value="">
    経度：<input type="text" id="lng" name="lng" value="">
    <input type="submit" value="登録">

    <div id="map" style="height:500px; width: 50%; margin: 2rem auto 0;"></div>
            <!-- jqueryの読み込み -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <!-- js -->
        <script src="https://maps.googleapis.com/maps/api/js?key=Mykey&callback=initMap"></script>
        <script type="text/javascript">
            var map = new google.maps.Map(
            document.getElementById("map"),{
            zoom : 7,
            center : new google.maps.LatLng(34.70251217521857, 135.49603700637817),
            mapTypeId : google.maps.MapTypeId.ROADMAP
            }
            );
            var marker = new google.maps.Marker({
            position: new google.maps.LatLng(34.70251217521857, 135.49603700637817),
            map: map,
            draggable : true
            });
            // Check
            function check(){
            var pos = marker.getPosition();
            var lat = pos.lat();
            var lng = pos.lng();
            $("#lat").val(lat);
            $("#lng").val(lng);
            // alert("緯度："+lat+"、経度："+lng);
            }
        </script>
</form>

</body>
</html>