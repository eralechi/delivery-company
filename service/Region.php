<?php

namespace Service;

class Region
{
    public readonly int $id;
    public readonly string $name;
    public readonly int $daysOnRoad;

    function __construct($id, $name, $daysOnRoad)
    {
        $this->id = $id;
        $this->name = $name;
        $this->daysOnRoad = $daysOnRoad;
    }

    public static function getRegion(int $id) 
    {
        $db = \DB\Database::getInstance();

        $region = $db->query("SELECT * FROM `region` WHERE id=" . intval($id));
        $region = $region->fetch_row();

        if (empty($region)) {
            throw new \Exception('Region not found');
        }

        return new Region($region[0], $region[1], $region[2]);
    }

    public static function getRegions() 
    {
        $db = \DB\Database::getInstance();
        $regions = []; 
        $regionsRes = $db->query("SELECT * FROM `region`");
        $regionsRes = $regionsRes->fetch_all(MYSQLI_ASSOC);
        if (!empty($regionsRes)) {
            foreach ($regionsRes as $region) {
                $regions[] = new Region($region['id'], $region['name'], $region['days_on_road']);
            }
        }
        return $regions;
    }
}
