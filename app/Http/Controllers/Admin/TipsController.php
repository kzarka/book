<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tips;

class TipsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tip.index');
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $tip = Tips::find($id);
        $tip->fill($data);
        $tip->save();
        return 'true';
    }

    public function create(Request $request)
    {
        $tip = new Tips();
        $data = $request->all();
        //validate
        $tip->fill($data);
        $tip->save();
        return 'true';
    }

    public function load(Request $request)
    {
        $tips = Tips::select('*')->get();
        return json_encode($result);
    }

    public function delete($id)
    {
        $tip = Tips::find($id);
        if(!$tip) {

            return 'false';
        }
        $tip->delete();

        return 'true';
    }
}
