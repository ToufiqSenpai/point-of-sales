<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductUnitStoreRequest;
use App\Http\Requests\ProductUnitUpdateRequest;
use App\Models\ProductUnit;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductUnitController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query->get('search');
        $product_units = ProductUnit::latest();

        if($search) {
            $product_units->where('name', 'like', "%$search%");
        }

        return view('product.unit.index', [
            'units' => $product_units->paginate(10)
        ]);
    }

    public function add(): View
    {
        return view('product.unit.add');
    }

    public function store(ProductUnitStoreRequest $request): RedirectResponse
    {
        $product_unit = new ProductUnit($request->all());
        $product_unit->save();

        return redirect('/product/unit')->with([
            'success' => 'Unit produk telah ditambahkan'
        ]);
    }

    public function edit(string $id): View
    {
        return view('product.unit.edit', [
            'unit' => ProductUnit::find($id)
        ]);
    }

    public function update(ProductUnitUpdateRequest $request): RedirectResponse
    {
        $body = $request->all();
        $product_unit = ProductUnit::find($body['id']);

        $product_unit->update($body);

        return redirect('/product/unit')->with([
            'success' => "Unit produk ". $product_unit['name'] . " berhasil diubah"
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $product_unit = ProductUnit::find($request->get('id'));

        if($product_unit) {
            $product_unit->delete();

            return redirect('/product/unit')->with([
                'success' => 'Unit produk '. $product_unit->name .' berhasil dihapus'
            ]);
        } else {
            return redirect('/product/unit')->with([
                'error' => 'Product unit not found'
            ]);
        }
    }
}
