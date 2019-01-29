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
}