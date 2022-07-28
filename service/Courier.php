<?php

namespace Service;

class Courier
{
    public readonly int $id;
    public readonly string $fio;

    function __construct($id, $fio)
    {
        $this->id = $id;
        $this->fio = $fio;
    }

    public static function getCourier(int $id) 
    {
        $db = \DB\Database::getInstance();

        $courier = $db->query("SELECT * FROM `courier` WHERE id=" . intval($id));
        $courier = $courier->fetch_row();

        if (empty($courier)) {
            throw new \Exception('Wrong courier id.');
        }

        return new Courier($courier[0], $courier[1]);
    }

    public static function getCouriers() 
    {
        $db = \DB\Database::getInstance();
        $couriers = []; 
        $couriersRes = $db->query("SELECT * FROM `courier`");
        $couriersRes = $couriersRes->fetch_all(MYSQLI_ASSOC);
        if (!empty($couriersRes)) {
            foreach ($couriersRes as $courier) {
                $couriers[] = new Courier($courier['id'], $courier['fio']);
            }
        }
        return $couriers;
    }
}
