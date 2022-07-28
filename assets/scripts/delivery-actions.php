<?php

require_once dirname(dirname(__DIR__)).'/vendor/autoload.php';

header("Content-Type: application/json");

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
$courer = isset($_REQUEST['courer']) ? $_REQUEST['courer'] : 0;
$region = isset($_REQUEST['region']) ? $_REQUEST['region'] : 0;
$date = isset($_REQUEST['date']) ? $_REQUEST['date'] : '';

try {
    $courier = \Service\Courier::getCourier($courer);
    if (!$courier) {
        throw new \Exception('Не найден выбранный курьер');
    }

    $region = \Service\Region::getRegion($region);
    if (!$region) {
        throw new \Exception('Не найден выбранный регион');
    }
   
    $date = strtotime($date);
    if ($date < time()) {
        throw new \Exception('Выберите правильную дату');
    }
    
    $delivety = new \Service\Delivery($courier, $region, date(\Service\Delivery::DATE_FORMAT, $date));
    if(!$delivety->isAvailable()){
        throw new \Exception('По выбранным параметрам уже есть поездка');
    }
} catch (\Exception $e) {
    ob_clean();
    die(json_encode(['error' => $e->getMessage()]));
}


if ($action == 'create-delivery') {
    
    try {
        $insertId = $delivety->create();
        if (!$insertId) {
            throw new \Exception('Ошибка создания поездки курьера');
        }

    } catch (\Throwable $th) {
        ob_clean();
        die(json_encode(['error' => $e->getMessage()]));
    }

    if ($insertId) {
        die(json_encode(['success' => 'Поездка успешно добавлена!']));
    }
}
if ($action == 'region-arrival-date') {
    $regionArrivalDate = $delivety->getRegionArrivalTime();
    $regionArrivalDate = date("d.m.Y", $regionArrivalDate);
    ob_clean();
    die(json_encode(['region_arrival_date' => $regionArrivalDate]));
}