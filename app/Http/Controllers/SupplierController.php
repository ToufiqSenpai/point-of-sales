<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class SupplierController extends Controller
{
    private array $rules = [
        'name' => 'required|max:155',
        'phone' => 'required|unique:suppliers|max:50',
        'email' => 'nullable|unique:suppliers|email:rfc,dns',
        'address' => 'nullable|max:10000',
        'description' => 'nullable|max:10000'
    ];

    private array $validate_message =  [
        'required' => 'Harus diisi',
        'unique' => ':attribute sudah tersedia',
        'max' => ':attribute terlalu panjang',
        'email' => 'Email tidak valid'
    ];

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

    public function add(): View
    {
        return view('supplier.add');
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), $this->rules, $this->validate_message);

        if($validator->fails()) {
            return redirect('/supplier/add')
                ->withErrors($validator)
                ->withInput();
        }

        $supplier = new Supplier($validator->getData());
        $supplier->save();

        return redirect('/supplier')->with([
            'success' => 'Supplier telah ditambahkan'
        ]);
    }
}
