<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsUpdateRequest;
use App\Models\Settings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
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
        $image = $request->file('shop_image');

        if($image) {
            Storage::disk('public')->delete('icons/shop.png');
            $image->storeAs('icons', 'shop.png', 'public');
        }

        Settings::find(1)->update($request->all());

        return back()->with('success', 'Settings have been saved');
    }
}
