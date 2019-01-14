<?php

namespace App\Http\Controllers\System;

use App\Service\SystemServiceApi;
use App\Service\Utils\PageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    protected $ss;

    public function __construct(SystemServiceApi $ss) {
        parent::__construct();
        $this->ss = $ss;
    }

    public function index() {

        return view('system.base.index');
    }

    public function ajaxTableList() {
        $tables = $this->ss->instance("sysDb")->getTableList();
        return makeSuccessMsg($tables);
    }

    public function ajaxTableDetail($table_name) {
        $table = $this->ss->instance("sysDb")->getTableDetail($table_name);
        return makeSuccessMsg($table);
    }

    public function ajaxTableData($table_name, Request $request) {
        $currPage = $request->get('page', 1);
        $datas = new PageService($this->ss->instance("sysDb")->getTableData($table_name), 15, $currPage);
        return makeSuccessMsg($datas);
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        //
    }

    public function destroy($id) {
        //
    }

}
