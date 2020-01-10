<?php
require_once('Config.php');
require_once(Config::APP_ROOT_DIR.'/classes/Schedule.php');

$db = new Schedule();

$datetime = new DateTime();//現在の日付のオブジェクト生成

if(isset($_POST['now']))
{
  $_POST = array();
}

// GETで渡されてきた値のチェック
if(isset($_GET['y']) && isset($_GET['m'])) {
  if(is_numeric($_GET['y'])&&is_numeric($_GET['m'])) {
    $year = $_GET['y'];
    $month = $_GET['m'];
  }
} else {
  $year = $datetime ->format('Y');
  $month = $datetime ->format('m');
}

var_dump($year);

// 祝日取得メソッド
function getHolidays($year) {
	
	$api_key = 'AIzaSyAofu9qs3_u1qwWEi76xgTdjp_0dje5iIA';
	$holidays = array();
	$holidays_id = 'japanese__ja@holiday.calendar.google.com'; // Google 公式版日本語
	$url = sprintf(
		'https://www.googleapis.com/calendar/v3/calendars/%s/events?'.
		'key=%s&timeMin=%s&timeMax=%s&maxResults=%d&orderBy=startTime&singleEvents=true',
		$holidays_id,
		$api_key,
		$year.'-01-01T00:00:00Z' , // 取得開始日
		$year.'-12-31T00:00:00Z' , // 取得終了日
		30 // 最大取得数
	);
 
	if ( $results = file_get_contents($url, true )) {
		//JSON形式で取得した情報を配列に格納
		$results = json_decode($results);
		//年月日をキー、祝日名を配列に格納
		foreach ($results->items as $item ) {
			$date = strtotime((string) $item->start->date);
			$title = (string) $item->summary;
			$holidays[date('Y-m-d', $date)] = $title;
		}
		//祝日の配列を並び替え
		ksort($holidays);
	}
	return $holidays; 
}

$datetime -> setDate($year, $month, 1);//現在の西暦、月の1日をセット、20190701
// $year = $datetime -> format('Y');
// $month = $datetime -> format('m');
// $day = $datetime -> format('d');
$firstDayWeek = $datetime -> format('w');//1日の曜日を格納　0-6が入る
$lastDay = $datetime -> format('t');//月の最終日を格納 

// var_dump($datetime);
$first_date =  $datetime;

for($i = 0; $i < $lastDay; $i++) {
  if($i === 0) {
  $year_month_date_array[] = $first_date ->format('Y-m-d');
  $date_array[] = $first_date ->format('j');
  continue;
  }
  $next_date = $first_date ->modify("+1 day");
  $year_month_date_array[] = $next_date ->format('Y-m-d');
  $date_array[] = $next_date ->format('j');
}

$holidays = getHolidays($year);

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="main.css">
<title>カレンダー</title>
</head>

<body>
<h1><?php print $year.'年'.$month.'月';?></h1>
<table>
    <tr>
        <th class="sun">日</th><th>月</th><th>火</th><th>水</th><th>木</th><th>金</th><th class="sut">土</th>
    </tr>
    
    <tr>
    <?php if($firstDayWeek!==0):?><!--1日が日曜じゃないとき、曜日が一致するまで空白を出力-->    
      <?php for($a=0;$a<$firstDayWeek;$a++):?>       
        <td>&nbsp;</td>
    <?php endfor; ?>
    <?php endif; ?>
    <?php for($i = 0; $i < $lastDay; $i++):?><!--日付の出力、その月の日数分回す-->
    
    <?php if (array_key_exists($year_month_date_array[$i], $holidays)):?>
    <td class="holiday">
    <?php else:?>
    <td>
    <?php endif;?>
    
    <a href="schedule.php?date=<?=$year_month_date_array[$i]?>">
    <?php
    print $date_array[$i];
    print ' ';
    // 祝日かどうかの判定、祝日であれば祝日名を出力
    if (array_key_exists($year_month_date_array[$i], $holidays)) {
      print $holidays[$year_month_date_array[$i]];
    }
    // その日にスケジュールが入っていれば
    $schedules = $db ->getScheduleAll($year_month_date_array[$i]);
    if(isset($schedules)) {
      print '<ul>';
      foreach($schedules as $schedule) {
        print '<li>'.$schedule['schedule'].'</li>';
      }
      print '</ul>';
    }
    // var_dump($year_month_date_array[$i]);
    ?>
    </a>
    </td>
      <?php if(($i+1+$a)%7 === 0): ?><!--月初の空白分+その月の日数が7の倍数の時改行-->
        </tr><tr>
      <?php endif; ?>
    <?php endfor; ?>
    
</tr>
</table>
<?php
// $datetimeにもう一度現在取り扱っている月のついたちを入れればOK
$datetime ->setDate($year, $month, 1);
// var_dump($datetime);
$next = $datetime -> modify('+1 month');
$nextYear = $next -> format('Y');
$nextMonth = $next -> format('m');

$previous = $datetime -> modify('-2 month');
$previousYear = $next -> format('Y');
$previousMonth = $next -> format('m');

// var_dump($datetime);
?>

<div class="inline-block_test">
<form action="calender.php" method="get">
<input type="hidden" name="m" value="<?= $previousMonth; ?>">
<input type="hidden" name="y" value="<?= $previousYear; ?>">
<input type="submit" name="previous" value="前の月へ">
</form>

<form action="calender.php">
<input type="hidden" name="m" value="<?= $nextMonth; ?>">
<input type="hidden" name="y" value="<?= $nextYear; ?>">
<input type="submit" name="next" value="次の月へ">
</form>

<form action="calender.php" method="get">
<input type="submit" name="now" value="今月へ">
</form>
</div>

</body>
</html>

</body>
</html>