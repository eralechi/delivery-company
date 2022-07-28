<?php

define('MIN_DAYS_ON_ROAD', 10);
define('MAX_DAYS_ON_ROAD', 100);

require_once './vendor/autoload.php';

$db = \DB\Database::getInstance();

$db->query("CREATE DATABASE IF NOT EXISTS delivery_company;"); 

$db->query("DROP TABLE IF EXISTS `courier`, `region`, `delivery`;");

$db->query("CREATE TABLE `courier` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT , 
    `fio` VARCHAR(100) NOT NULL , 
    PRIMARY KEY (`id`)
)");

$db->query("CREATE TABLE `region` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(100) NOT NULL , 
    `days_on_road` TINYINT(4) UNSIGNED NOT NULL , 
    PRIMARY KEY (`id`)
)"); 

$db->query("CREATE TABLE `delivery` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, 
    `courier_id` INT(11) UNSIGNED NOT NULL , 
    `region_id` INT(11) UNSIGNED NOT NULL , 
    `depart_date` DATE NOT NULL ,
    `return_date` DATE NOT NULL ,
    PRIMARY KEY (`id`)
)");

$db->query("INSERT INTO `courier`(`fio`) VALUES
    ('Бирюков Сергей Донатович'),
    ('Новиков Тимофей Ильяович'),
    ('Лаврентьев Юлиан Владимирович'),
    ('Вишняков Яков Рубенович'),
    ('Самойлов Варлаам Наумович'),
    ('Селиверстова Ульна Анатольевна'),
    ('Анисимова Марианна Анатольевна'),
    ('Коновалова Нина Вадимовна'),
    ('Горбачёва Лариса Игоревна'),
    ('Капустина Георгина Серапионовна')
");

$regions = [
    'Санкт-Петербург',
    'Уфа',
    'Нижний Новгород',
    'Владимир',
    'Кострома',
    'Екатеринбург',
    'Ковров',
    'Воронеж',
    'Самара',
    'Астрахань',
];
$region_insert_query = '';
foreach ($regions as $name) {
    $days_on_road = random_int(MIN_DAYS_ON_ROAD, MAX_DAYS_ON_ROAD);
    $region_insert_query .= ($region_insert_query ? ',' : '') . "(\"$name\", $days_on_road)";
}
if ($region_insert_query) {
    $db->query("INSERT INTO `region`(`name`, `days_on_road`) VALUES $region_insert_query");
}

$couriers = $db->query("SELECT * FROM `courier`");
$couriers = $couriers ? $couriers->fetch_all(MYSQLI_ASSOC) : [];
$regions = $db->query("SELECT * FROM `region`");
$regions = $regions ? $regions->fetch_all(MYSQLI_ASSOC) : [];

$schedule_from = strtotime('2019-06-01');
$schedule_to = time();
$schedules = [];

if ($couriers && $regions) {
    foreach ($couriers as $courier) {
        $courier = new \Service\Courier($courier['id'], $courier['fio']);
        $previousTime = $schedule_from;
       
        while ($previousTime <= $schedule_to) {
            $region_key = array_rand($regions);
            $region = $regions[$region_key];
            $region = new \Service\Region($region['id'], $region['name'], $region['days_on_road']);
            $delivety = new \Service\Delivery($courier, $region, date(\Service\Delivery::DATE_FORMAT, $previousTime));
            $result = $delivety->create();

            $previousTime = strtotime($delivety->returnDate) + \Service\Delivery::DAY_SEC;
        }
    }
}

echo 'Complete';