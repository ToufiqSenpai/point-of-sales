<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsUpdateRequest;
use App\Models\Settings;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(): View 
    {
        return view('settings.index', [
            'shop' => Settings::find(1)->first()
        ]);
    }

    public function update(SettingsUpdateRequest $request): RedirectResponse
    {
        Settings::find(1);
    }
}
