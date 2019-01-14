<?php

namespace App\Http\Controllers\Api;

use App\Service\BuildingServiceApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    protected $bs;

    public function __construct(BuildingServiceApi $bs) {
        parent::__construct();
        $this->bs = $bs;
    }

    public function syncAmmeterData(Request $request) {
        $ammeter_sn = $request->get("ammeter_sn", "");
        $collector_sn = $request->get("collector_sn", "");
        if(empty($ammeter_sn)) {
            return makeFailedMsg("缺少电表sn号");
        }
        if(empty($request->get("positive_active_power")) || empty($request->get("reverse_active_power"))) {
            return makeFailedMsg("缺少电表数据");
        }
        $ammeter = $this->bs->instance("bdDb")->getAmmeterBySn($collector_sn, $ammeter_sn);
        if($ammeter) {
            $data = [
                "ammeter_id" => $ammeter->id,
                "positive_active_power" => $request->get("positive_active_power", 0),
                "reverse_active_power" => $request->get("reverse_active_power", 0),
                "other_data" => $request->get("other_data", ""),
                "recorded_at" => $request->get("record_time", date("Y-m-d H:i:s")),
            ];
            $this->bs->instance("bdDb")->insertAmmeterData($data);
            return makeSuccessMsg();
        } else {
            return makeFailedMsg("没有对应电表: ammeter_sn:".$ammeter_sn." collector_sn:".$collector_sn);
        }
    }
}
