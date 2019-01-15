<?php

namespace App\Service\Database;

use UUID;

class BuildingService
{
    protected $db;

    public function __construct($db = null)
    {
        if ($db) {
            $this->db = $db;
        } else {
            $this->db = \DB::connection();
        }
    }

    public function getBuildingList($name = "") {
        if(!empty($name)) {
            $where = " and name like '%".$name."%'";
        } else {
            $where = "";
        }
        $sql = "
            select
                b.*
            from building_base b
            where 1=1 
        ".$where;
        $res = $this->db->select($sql);
        return empty($res) ? [] : $res;
    }

    public function getBuildingDetail($id) {
        $sql = "
            select
                *
            from building_base
            where id=:id 
        ";
        $res = $this->db->select($sql, ["id" => $id]);
        return empty($res) ? [] : head($res);
    }

    public function getAmmeterBySn($collectorSn, $meterSn) {
        $sql = "
            SELECT
                a.*
            from ammeter a 
            LEFT JOIN collector c on a.collector_id = c.id
              where a.sn =:meterSn  and c.sn = :collectorSn
       ";
        $res = $this->db->select($sql, [ "meterSn" => $meterSn, "collectorSn" => $collectorSn ]);
        return empty($res) ? [] : head($res);
    }

    public function insertAmmeterData($params) {
        return $this->db->table("ammeter_data")
            ->insert(["ammeter_id" => $params['ammeter_id'],
                "positive_active_power" => $params['positive_active_power'],
                "reverse_active_power" =>$params['reverse_active_power'],
                "other_data" =>$params['other_data'],
                "recorded_at" =>$params['recorded_at'],
            ]);
    }

    public function getWatermeterBySn($collectorSn, $meterSn) {
    $sql = "
            SELECT
                a.*
            from watermeter a 
            LEFT JOIN collector c on a.collector_id = c.id
              where a.sn =:meterSn  and c.sn = :collectorSn
       ";
    $res = $this->db->select($sql, [ "meterSn" => $meterSn, "collectorSn" => $collectorSn ]);
    return empty($res) ? [] : head($res);
}

    public function insertWatermeterData($params) {
        return $this->db->table("watermeter_data")
            ->insert(["watermeter_id" => $params['watermeter_id'],
                "indication" => $params['indication'],
                "other_data" =>$params['other_data'],
                "recorded_at" =>$params['recorded_at'],
            ]);
    }

    public function getEnegymeterBySn($collectorSn, $meterSn) {
        $sql = "
            SELECT
                a.*
            from energymeter a 
            LEFT JOIN collector c on a.collector_id = c.id
              where a.sn =:meterSn  and c.sn = :collectorSn
       ";
        $res = $this->db->select($sql, [ "meterSn" => $meterSn, "collectorSn" => $collectorSn ]);
        return empty($res) ? [] : head($res);
    }

    public function insertEnergymeterData($params) {
        return $this->db->table("energymeter_data")
            ->insert(["energymeter_id" => $params['energymeter_id'],
                "indication" => $params['indication'],
                "other_data" =>$params['other_data'],
                "recorded_at" =>$params['recorded_at'],
            ]);
    }
}