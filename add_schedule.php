<?php
require_once('Config.php');

require_once(Config::APP_ROOT_DIR.'/classes/Schedule.php');
require_once(Config::APP_ROOT_DIR.'/classes/Common.php');

$db = new Schedule();

var_dump($_POST);
$post = Common::sanitize($_POST);

try {
    $db ->addSchedule($post['date'], $post['schedule']);
    header('Location: calender.php');
    exit;
} catch(Exception $e) {
    var_dump($e);
}

?>