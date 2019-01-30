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

    public function ajaxAmmeterGroupsSummaryDailyByType($buildingId, $groupTypeId, Request $request)
    {
        $from = $request->get("from", date("Y-m-01"));
        $to = $request->get("to", date("Y-m-d"));
        $groups = $this->bs->instance("db")->getBuildingAmmeterGroupsSummaryDailyByType($buildingId, $groupTypeId, $from, $to);
        return makeSuccess($groups);
    }
}