<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tags;

class TagsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classes::where('enable', 1)->get();
        return view('admin.class.index', ['classes' => $classes]);
    }

    public function create(Request $request)
    {
        $method = $request->method();
        $class = new Classes();
        if($method == 'GET') {
            return view('admin.class.form', ['class' => $class]);
        }

        $data = $request->all();
        //validate
        $class->fill($data);
        $class->save();
        return redirect()->route('admin_classes');
    }

    public function edit(Request $request, $id)
    {
        $method = $request->method();
        $class = Classes::find($id);
        if(!$class) {
            return redirect()->route('admin_classes');
        }

        if($method == 'GET') {
            return view('admin.class.form', ['class' => $class]);
        }

        $data = $request->all();
        //validate
        $class->fill($data);
        $class->save();
        return redirect()->route('admin_classes');
    }

    public function delete($id)
    {
        $class = Classes::find($id);
        if(!$class) {
            return 'false';
        }
        $class->delete();
        return 'true';
    }
}
