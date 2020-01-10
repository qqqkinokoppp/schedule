<?php 
require_once('Config.php');

require_once(Config::APP_ROOT_DIR.'/classes/Schedule.php');
require_once(Config::APP_ROOT_DIR.'/classes/Common.php');

$get = Common::sanitize($_GET);

try {
    $db = new Schedule();
    $db ->deleteSchedule($get['id']);
    header('Location: calender.php');
    exit;
} catch(Exception $e) {
    var_dump($e);
}

?>