<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductBrandStoreRequest;
use App\Http\Requests\ProductBrandUpdateRequest;
use App\Models\ProductBrand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductBrandController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query->get('search');
        $product_brands = ProductBrand::latest();

        if($search) {
            $product_brands->where('name', 'like', "%$search%");
        }

        return view('product.brand.index', [
            'brands' => $product_brands->paginate(10)
        ]);
    }

    public function add(): View
    {
        return view('product.brand.add');
    }

    public function store(ProductBrandStoreRequest $request): RedirectResponse
    {
        $product_brand = new ProductBrand($request->all());
        $product_brand->save();

        return redirect('/product/brand')->with([
            'success' => 'Brand produk berhasil ditambahkan'
        ]);
    }

    public function edit(Request $request, string $id): View
    {
        return view('product.brand.edit', [
            'brand' => ProductBrand::find($id)
        ]);
    }

    public function update(ProductBrandUpdateRequest $request): RedirectResponse
    {
        $body = $request->all();
        $product_brand = ProductBrand::find($body['id']);

        $product_brand->update($body);

        return redirect('/product/brand')->with([
            'success' => 'Brand '. $body['name'] .' berhasil diubah.'
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $product_brand = ProductBrand::find($request->get('id'));

        if($product_brand) {
            $product_brand->delete();

            return redirect('/product/category')->with([
                'success' => 'Brand '. $product_brand->name .' berhasil dihapus'
            ]);
        } else {
            return redirect('/product/category')->with([
                'error' => 'Brand not found'
            ]);
        }
    }
}
