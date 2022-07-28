<?php

namespace Service;

class DeliveryController
{
    public static function getDeliveries(string $dateFrom = '', string $dateTo = '')
    {
        $deliveries = [];
        $dateQuery = '';
        if ($dateFrom) {
            $dateFrom = date("Y-m-d", strtotime($dateFrom));
            $dateQuery .= ($dateQuery ? ' AND ' : '') . "d.`depart_date` >= '$dateFrom'";
        }
        if ($dateTo) {
            $dateTo = date("Y-m-d", strtotime($dateTo));
            $dateQuery .= ($dateQuery ? ' AND ' : '') . "d.`return_date` <= '$dateTo'";
        }

        try {
            $db = \DB\Database::getInstance();
            $deliveriesRes = $db->query('SELECT c.fio as courier, r.name as region, d.depart_date, d.return_date FROM `delivery` d
                JOIN courier c ON c.id=d.courier_id
                JOIN region r ON r.id=d.region_id
                WHERE 1' . (empty($dateQuery) ? '' : ' AND ' . $dateQuery) . '
                ORDER BY depart_date DESC
            ');
            if ($deliveriesRes->num_rows) {
                $deliveriesRes = $deliveriesRes->fetch_all();
                foreach ($deliveriesRes as $delivery) {
                    $deliveries[] = [
                        'courier' => $delivery[0],
                        'region' => $delivery[1],
                        'depart_date' => $delivery[2],
                        'return_date' => $delivery[3],
                    ];
                }
                
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        return $deliveries;
    }
}
