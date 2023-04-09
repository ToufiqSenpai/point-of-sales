<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request): RedirectResponse
    {
        if($request->user()) {
            switch($request->user()->role) {
                case 'CASHIER':
                    return redirect('/transaction');
                case 'OWNER':
                case 'ADMIN':
                    return redirect('/home');
                default:
                    return redirect('/login');
            }
        } else {
            return redirect('/login');
        }
    }
}
