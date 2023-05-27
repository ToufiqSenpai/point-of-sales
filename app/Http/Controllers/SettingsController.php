<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(): View 
    {
        return view('settings.index', [
            'shop' => Shop::find(1)->first()
        ]);
    }
}
