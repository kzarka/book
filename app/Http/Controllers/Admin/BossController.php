<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BossData;

class BossController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$data = BossData::find(1);
    	$method = $request->method();
    	if ($method === 'GET') {
    		return view('admin.bosses.index', ['data' => $data]);
    	}
        $params = $request->all();
        $data->fill($params);
        $data->save();
        return redirect()->route('admin_bosses');
    }
}
