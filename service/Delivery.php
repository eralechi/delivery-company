<?php

namespace Service;

class Delivery
{
    const DAY_SEC = 86400;
    const DATE_FORMAT = 'Y-m-d';

    public readonly Courier $courier;
    public readonly Region $region;
    public readonly string $departDate;
    public readonly string $returnDate;

    function __construct(Courier $courier, Region $region, string $departDate)
    {
        $this->courier = $courier;
        $this->region = $region;
        $this->departDate = $departDate;
    }

    public function getDepartDate() 
    {
        return $this->departDate;
    }

    public function getReturnDate() 
    {
        if (!isset($this->returnDate) || $this->returnDate == null) {
            $returnTime = strtotime($this->departDate) + self::DAY_SEC * $this->region->daysOnRoad;
            $this->returnDate = date(self::DATE_FORMAT, $returnTime);
        }
        return $this->returnDate;
    }

    public function getRegionArrivalTime() 
    {
        $returnTime = strtotime($this->departDate) + self::DAY_SEC * $this->region->daysOnRoad / 2;
        return $returnTime;
    }

    public function isAvailable()
    {
        $isAvailable = false;
        try {
            $db = \DB\Database::getInstance();
            $returnDate = $db->escape($this->getReturnDate());
            $departDate = $db->escape($this->departDate);

            $deliveries = $db->query("SELECT * FROM `delivery` 
                where courier_id=" . intval($this->courier->id) . " AND 
                region_id=" . intval($this->region->id) . " AND (
                    depart_date BETWEEN '" .  $departDate . "' AND '" .  $returnDate . "' OR
                    return_date BETWEEN '" .  $departDate . "' AND '" .  $returnDate . "'
                )");
            $isAvailable = $deliveries->num_rows == 0;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        return $isAvailable;
    }

    public function create()
    {
        try {
            if (!$this->isAvailable()) {
                throw new \Exception('Delivery with selected parameters is not available');
            }
            $db = \DB\Database::getInstance();

            $returnDate = $db->escape($this->getReturnDate());
            $departDate = $db->escape($this->departDate);

            $insertId = $db->query("INSERT INTO `delivery`(`courier_id`, `region_id`, `depart_date`, `return_date`) VALUES (" . $this->courier->id . ", " . $this->region->id . ", '" . $departDate . "', '" . $returnDate . "')");
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        return $insertId;
    }
}
