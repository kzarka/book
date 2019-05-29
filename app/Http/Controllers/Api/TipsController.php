<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tips;

class TipsController extends Controller
{

    public function load(Request $request)
    {
        $tips = Tips::select('*')->get();
        $result['data'] = $tips;
        return json_encode($result);
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
