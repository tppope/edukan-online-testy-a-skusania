<?php
require_once "controllers/LoginController.php";

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header("Connection: keep-alive");
header("Access-Control-Allow-Origin: *");

$lastId = $_SERVER["HTTP_LAST_EVENT_ID"];

if (isset($lastId) && !empty($lastId) && is_numeric($lastId)) {
    $lastId = intval($lastId);
    $lastId++;
} else {
    $lastId = 0;
}

$controller = new LoginController();

while (true) {
    session_start();

    $data = array(
        "leftStudents"=>$controller->getLeftStudents(),
        "getStudentsTime"=>$controller->getStudentsTime(),

    );
    session_commit();

    echo "id: $lastId" . PHP_EOL;
    echo 'data: ' . json_encode($data) . PHP_EOL . PHP_EOL;

    $lastId++;
    ob_flush();
    flush();

    sleep(1);
}
?>
