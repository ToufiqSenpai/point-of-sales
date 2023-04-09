<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SupplierController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query->get('search');
        $suppliers = Supplier::latest();

        if($search) {
            $suppliers->where('name', 'like', "%$search%");
        }

        return view('supplier.index', [
            'suppliers' => $suppliers->paginate(10)
        ]);
    }
}
