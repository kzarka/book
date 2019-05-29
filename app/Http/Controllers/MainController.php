<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\User;

class MainController extends Controller
{
    const THEMES = ['default', 'calpheon', 'valencia'];

    public function setTheme(Request $request)
    {
        $theme = $request->theme;
        if (!in_array($theme, self::THEMES) || $theme == 'default') {
            if ($request->session()->exists('theme')) {
                $request->session()->forget('theme');
            }
            return 'true';
        }
        $request->session()->put('theme', $theme);
        $request->session()->save();
        return 'true';
    }
}
