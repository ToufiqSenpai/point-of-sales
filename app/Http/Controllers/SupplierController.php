<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierStoreRequest;
use App\Http\Requests\SupplierUpdateRequest;
use App\Models\Supplier;
use App\Models\User;
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

    public function store(SupplierStoreRequest $request): RedirectResponse
    {
        $supplier = new Supplier($request->all());
        $supplier->save();

        return redirect('/supplier')->with([
            'success' => 'Supplier telah ditambahkan'
        ]);
    }

    public function edit(Request $request, string $id): View
    {
        return view('supplier.edit', [
            'supplier' => Supplier::find($id)
        ]);
    }

    public function update(SupplierUpdateRequest $request): RedirectResponse
    {
        $body = $request->all();
        $supplier = Supplier::find($body['id']);

        $supplier->update($body);

        return redirect('/supplier')->with([
            'success' => "Supplier ". $supplier['name'] . " berhasil diubah"
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $supplier = Supplier::find($request->get('id'));

        if($supplier) {
            $supplier->delete();

            return redirect('/supplier')->with([
                'success' => 'Supplier '. $supplier->name .' berhasil dihapus'
            ]);
        } else {
            return redirect('/supplier')->with([
                'error' => 'Supplier not found'
            ]);
        }
    }
}
