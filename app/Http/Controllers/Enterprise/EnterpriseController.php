<?php

namespace App\Http\Controllers\Enterprise;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EnterpriseController extends Controller
{
    protected $es;

    public function __construct(SystemServiceApi $es) {
        parent::__construct();
        $this->es = $es;
    }

}
