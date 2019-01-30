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

    public function getBuildingList($name = "")
    {
        if (!empty($name)) {
            $where = " and name like '%" . $name . "%'";
        } else {
            $where = "";
        }
        $sql = "
            select
                b.*
            from building_base b
            where 1=1 
        " . $where;
        $res = $this->db->select($sql);
        return empty($res) ? [] : $res;
    }

    public function getBuildingDetail($id)
    {
        $sql = "
            select
                *
            from building_base
            where id=:id 
        ";
        $res = $this->db->select($sql, ["id" => $id]);
        return empty($res) ? [] : head($res);
    }

    public function getAmmeterBySn($collectorSn, $meterSn)
    {
        $sql = "
            SELECT
                a.*
            from ammeter a 
            LEFT JOIN collector c on a.collector_id = c.id
              where a.sn =:meterSn  and c.sn = :collectorSn
       ";
        $res = $this->db->select($sql, ["meterSn" => $meterSn, "collectorSn" => $collectorSn]);
        return empty($res) ? [] : head($res);
    }

    public function insertAmmeterData($params)
    {
        return $this->db->table("ammeter_data")
            ->insert(["ammeter_id" => $params['ammeter_id'],
                "positive_active_power" => $params['positive_active_power'],
                "reverse_active_power" => $params['reverse_active_power'],
                "other_data" => $params['other_data'],
                "recorded_at" => $params['recorded_at'],
            ]);
    }

    public function getWatermeterBySn($collectorSn, $meterSn)
    {
        $sql = "
            SELECT
                a.*
            from watermeter a 
            LEFT JOIN collector c on a.collector_id = c.id
              where a.sn =:meterSn  and c.sn = :collectorSn
       ";
        $res = $this->db->select($sql, ["meterSn" => $meterSn, "collectorSn" => $collectorSn]);
        return empty($res) ? [] : head($res);
    }

    public function insertWatermeterData($params)
    {
        return $this->db->table("watermeter_data")
            ->insert(["watermeter_id" => $params['watermeter_id'],
                "indication" => $params['indication'],
                "other_data" => $params['other_data'],
                "recorded_at" => $params['recorded_at'],
            ]);
    }

    public function getEnergymeterBySn($collectorSn, $meterSn)
    {
        $sql = "
            SELECT
                a.*
            from energymeter a 
            LEFT JOIN collector c on a.collector_id = c.id
              where a.sn =:meterSn  and c.sn = :collectorSn
       ";
        $res = $this->db->select($sql, ["meterSn" => $meterSn, "collectorSn" => $collectorSn]);
        return empty($res) ? [] : head($res);
    }

    public function insertEnergymeterData($params)
    {
        return $this->db->table("energymeter_data")
            ->insert(["energymeter_id" => $params['energymeter_id'],
                "indication" => $params['indication'],
                "other_data" => $params['other_data'],
                "recorded_at" => $params['recorded_at'],
            ]);
    }


    // 综合数据


    public function getUserBuildingSummary($userId, $type)
    {
        if ($type == "ammeter") {
            return $this->getUserBuildingAmmeterSummary($userId);
        } else if ($type == "watermeter") {
            return $this->getUserBuildingWatermeterSummary($userId);
        } else if ($type == "energymeter") {
            return $this->getUserBuildingEnergymeterSummary($userId);
        }
        return [];
    }

    public function getUserBuildingAmmeterSummary($userId)
    {
        $sql = "
            select 
                sum(g.diff) as total
            from (
                SELECT
                    max(ad.positive_active_power) - min(ad.positive_active_power) as diff,
                    am.build_id,
                    am.id
                from ammeter_data ad
                right join (
                        select
                            a.*
                        from ammeter a
                        LEFT JOIN user_building_map bm on bm.building_id = a.build_id
                        where a.is_main = 1 and a.status = '正常' and bm.user_id = :userId
                ) am on am.id = ad.ammeter_id
                group by am.build_id, am.id
            ) g
       ";
        $res = $this->db->select($sql, ["userId" => $userId]);
        return empty($res) ? [] : head($res);
    }

    public function getUserBuildingWatermeterSummary($userId)
    {
        $sql = "
            select 
                sum(g.diff) as total
            from (
                SELECT
                    max(ad.indication) - min(ad.indication) as diff,
                    am.build_id,
                    am.id
                from watermeter_data ad
                right join (
                        select
                            a.*
                        from watermeter a
                        LEFT JOIN user_building_map bm on bm.building_id = a.build_id
                        where a.is_main = 1 and a.status = '正常' and bm.user_id = :userId
                ) am on am.id = ad.watermeter_id
                group by am.build_id, am.id
            ) g
       ";
        $res = $this->db->select($sql, ["userId" => $userId]);
        return empty($res) ? [] : head($res);
    }

    public function getUserBuildingEnergymeterSummary($userId)
    {
        $sql = "
            select 
                sum(g.diff) as total
            from (
                SELECT
                    max(ad.indication) - min(ad.indication) as diff,
                    am.build_id,
                    am.id
                from energymeter_data ad
                right join (
                        select
                            a.*
                        from energymeter a
                        LEFT JOIN user_building_map bm on bm.building_id = a.build_id
                        where a.is_main = 1 and a.status = '正常' and bm.user_id = :userId
                ) am on am.id = ad.energymeter_id
                group by am.build_id, am.id
            ) g
       ";
        $res = $this->db->select($sql, ["userId" => $userId]);
        return empty($res) ? [] : head($res);
    }

    // 用户所有表数据
    public function getUserMeters($userId, $type)
    {
        if ($type == "ammeter") {
            return $this->getUserAmmeters($userId);
        } else if ($type == "watermeter") {
            return $this->getUserWatermeters($userId);
        } else if ($type == "energymeter") {
            return $this->getUserEnergymeters($userId);
        }
        return [];
    }

    public function getUserAmmeters($userId)
    {
        $sql = "
            select
              a.*,
              b.*,
              ad.*
            from ammeter a
            LEFT JOIN user_building_map bm on bm.building_id = a.build_id
            LEFT JOIN building_base b on b.id = a.build_id
            LEFT JOIN (
                SELECT
                    ammeter_id,
                    max(positive_active_power) - min(positive_active_power) as total_power
                from ammeter_data
              group by ammeter_id
            ) ad on ad.ammeter_id = a.id
            where a.is_main = 1 and a.status = '正常' and bm.user_id = :userId
       ";
        $res = $this->db->select($sql, ["userId" => $userId]);
        return empty($res) ? [] : $res;
    }


    // 用户所有表数据
    public function getMeterDatas($deviceId, $type, $dateType, $from, $to)
    {
        if ($type == "ammeter") {
            return $this->getAmmeterDatas($deviceId, $type, $dateType, $from, $to);
        } else if ($type == "watermeter") {
            return $this->getWatermeterDatas($deviceId, $type, $dateType, $from, $to);
        } else if ($type == "energymeter") {
            return $this->getEnergymeterDatas($deviceId, $type, $dateType, $from, $to);
        }
        return [];
    }

    public function getAmmeterDatas($deviceId, $type, $dateType, $from, $to)
    {
        if ($dateType == "hour") {
            return $this->getAmmeterDatasByHour($deviceId, $type, $dateType, $from, $to);
        } else if ($dateType == "day") {
            return $this->getWatermeterDatasByDay($deviceId, $type, $dateType, $from, $to);
        } else if ($dateType == "month") {
            return $this->getEnergymeterDatasByMonth($deviceId, $type, $dateType, $from, $to);
        } else if ($dateType == "year") {
            return $this->getEnergymeterDatasByYear($deviceId, $type, $dateType, $from, $to);
        }
        return [];
    }
    public function getAmmeterDatasByHour($deviceId, $from, $to) {
        $where = "";
        if(!empty($from)) {
            $where = " and ammeter_data.recorded_at >= '".$from."' ";
        }
        if(!empty($to)) {
            $where = " and ammeter_data.recorded_at < '".$to."' ";
        }
        $sql = "
            select
              a.id,
              a.rate,
              b.id as bid,
              b.area,
              ad.*
            from ammeter a
            LEFT JOIN building_base b on b.id = a.build_id
            RIGHT JOIN (
                SELECT
                    ammeter_data.ammeter_id,
                    DATE_FORMAT(ammeter_data.recorded_at,'%Y-%m-%d %H:00:00') as date_time,
                    max(positive_active_power) - min(positive_active_power) as total_power
                from ammeter_data
                where ammeter_data.ammeter_id = :deviceId
                ".$where."
                group by ammeter_data.ammeter_id, DATE_FORMAT(ammeter_data.recorded_at,'%Y-%m-%d %H')
            ) ad on ad.ammeter_id = a.id
            where a.is_main = 1 and a.status = '正常'
            order by ad.date_time asc
       ";
        $res = $this->db->select($sql, ["deviceId" => $deviceId]);
        return empty($res) ? [] : $res;
    }




    // 跟组相关
    public function getBuildingGroupTypes($building_id) {
        $sql = "
            select
                tc.val as tcname, dg.group_type
            from device_group dg
            left join type_category tc on tc.id = dg.group_type
            where building_id = :buildingId and dg.parent_id=0
            group by dg.group_type
        ";
        $res = $this->db->select($sql, ["buildingId" => $building_id]);
        return empty($res) ? [] : $res;
    }

    public function getBuildingGroups($building_id, $group_type) {
        $sql = "
            select
                dg.*
            from device_group dg
            where building_id = :buildingId and group_type = :groupType
            order by dg.parent_id asc, dg.name asc
        ";
        $res = $this->db->select($sql, ["buildingId" => $building_id, "groupType" => $group_type]);
        return empty($res) ? [] : $res;
    }


    // 根据分组类型查询组内电表数据汇总
    public function ajaxAmmeterGroupsSummaryDaily($buildingId, $groupTypeId, $from, $to) {
        if(empty($buildingId) || empty($groupTypeId)) {
            return [];
        }
        $sql = "";
        $res = $this->db->select($sql, ["buildingId" => $buildingId, "groupType" => $groupTypeId, "from" => $from, "to" => $to]);
        return empty($res) ? [] : $res;
    }

}