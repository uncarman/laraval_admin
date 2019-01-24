<?php

namespace App\Http\Controllers;

use App\Service\BuildingServiceApi;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    protected $bs;

    public function __construct(BuildingServiceApi $bs) {
        parent::__construct();
        $this->bs = $bs;
    }


    public function ajaxGetMeters(Request $request) {
        $userId = \Auth::user()->id;
        $type = $request->get("type", "");
        $data = $this->bs->instance("bdDb")->getMeters($userId, $type);
        return makeSuccessMsg($data);
    }

    public function ajaxGetMeterDatas(Request $request) {
        $deviceId = $request->get("device_id", "");
        $type = $request->get("type", "");
        $dateType = $request->get("date_type", "");
        $from = $request->get("from", "");
        $to = $request->get("to", "");

        // 格式化返回结果
        $res = [
            "key" => "recordTime",
            "val" => "averagePower",
            "unit" => "kwh/m2",
            "datas" => [],
            "id" => $deviceId,
        ];
        $data = $this->bs->instance("bdDb")->getMeterDatas($deviceId, $type, $dateType, $from, $to);
        $res["datas"] = array_map(function($d){
            return [
                "val" => $d->total_power * $d->rate / $d->area,
                "key" => $d->date_time,
            ];
        }, $data);
        return makeSuccessMsg($res);
    }



    public function ajaxGetBuildingSummary(Request $request) {
        $userId = \Auth::user()->id;
        $type = $request->get("type", "");
        $data = $this->bs->instance("bdDb")->getBuildingSummary($userId, $type);
        return makeSuccessMsg($data);
    }

    public function ajaxGetSummaryByDate(Request $request) {
        $userId = \Auth::user()->id;
        $type = $request->get("type", "");
        $dateType = $request->get("dateType", "day");
        $from = $request->get("from", 30);
        $data = $this->bs->instance("bdDb")->getBuildingSummary($userId, $type);
        return makeSuccessMsg($data);
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
