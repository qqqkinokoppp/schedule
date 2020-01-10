<?php

$year = "2021";
$Holidays = getHolidays($year);

print $year."<br/>";
print_r($Holidays);

//GoogleカレンダーAPIから祝日を取得
function getHolidays($year) {
	
	$api_key = 'AIzaSyAofu9qs3_u1qwWEi76xgTdjp_0dje5iIA';
	$holidays = array();
	$holidays_id = 'japanese__ja@holiday.calendar.google.com'; // Google 公式版日本語
	//$holidays_id = 'japanese@holiday.calendar.google.com'; // Google 公式版英語
	//$holidays_id = 'outid3el0qkcrsuf89fltf7a4qbacgt9@import.calendar.google.com'; // mozilla.org版 ←2017年5月時点で文字化け発生中（山の日）
	$url = sprintf(
		'https://www.googleapis.com/calendar/v3/calendars/%s/events?'.
		'key=%s&timeMin=%s&timeMax=%s&maxResults=%d&orderBy=startTime&singleEvents=true',
		$holidays_id,
		$api_key,
		$year.'-01-01T00:00:00Z' , // 取得開始日
		$year.'-12-31T00:00:00Z' , // 取得終了日
		150 // 最大取得数
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

?>