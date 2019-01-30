<?php

namespace App\Http\Controllers\Monitor;

use App\Service\BuildingServiceApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MonitorAmmeterController extends Controller
{
    protected $bs;

    public function __construct(BuildingServiceApi $bs)
    {
        parent::__construct();
        $this->bs = $bs;
    }

    public function index(Request $request)
    {
        return view('single.monitor.ammeter');
    }

    public function ammeterByType(Request $request)
    {
        return view('single.monitor.ammeter_by_type');
    }

    public function ajaxAmmeterGroupsSummaryDaily($buildingId, $groupTypeId, Request $request)
    {
        $from = $request->get("from", date("Y-m-01"));
        $to = $request->get("to", date("Y-m-d"));
        $groups = $this->bs->instance("db")->buildingAmmeterGroupsSummaryDaily($buildingId, $groupTypeId, $from, $to);
        $res = [
            "from" => $from,
            "to" => $to,
            "dailyDatas" => []
        ];
        $keys = [];
        array_map(function ($g) use (&$res, &$keys) {
            if(in_array($g->name, $keys)) {
                $ind = array_search($g->name, $keys);
                $res["dailyDatas"][$ind]["datas"][] = [
                    "val" => $g->val,
                    "key" => $g->record_date
                ];
            } else {
                $res["dailyDatas"][] = [
                    "datas" => [
                        [
                            "val" => $g->val,
                            "key" => $g->record_date
                        ]
                    ],
                    "key" => "record_date",
                    "val" => "useValue",
                    "unit" => "kwh",
                    "prop_area" => $g->prop_area,
                    "prop_num" => $g->prop_num,
                    "name" => $g->name,
                    "gid" => $g->id,
                ];
                array_push($keys, $g->name);
            }
        } , $groups);
        return makeSuccessMsg($res);
    }
}