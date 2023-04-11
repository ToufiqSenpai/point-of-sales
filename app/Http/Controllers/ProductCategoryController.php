<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCategoryStoreRequest;
use App\Http\Requests\ProductCategoryUpdateRequest;
use App\Models\ProductCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductCategoryController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query->get('search');
        $product_categories = ProductCategory::latest();

        if($search) {
            $product_categories->where('name', 'like', "%$search%");
        }

        return view('product.category.index', [
            'categories' => $product_categories->paginate(10)
        ]);
    }

    public function add(): View
    {
        return view('product.category.add');
    }

    public function store(ProductCategoryStoreRequest $request): RedirectResponse
    {
        $product_category = new ProductCategory($request->all());
        $product_category->save();

        return redirect('/product/category')->with([
            'success' => 'Kategori produk berhasil ditambahkan'
        ]);
    }

    public function edit(Request $request, string $id): View
    {
        return view('product.category.edit', [
            'category' => ProductCategory::find($id)
        ]);
    }

    public function update(ProductCategoryUpdateRequest $request): RedirectResponse
    {
        $body = $request->all();
        $product_category = ProductCategory::find($body['id']);

        $product_category->update($body);


        return redirect('/product/category')->with([
            'success' => 'Kategori produk '. $body['name'] .' berhasil diubah.'
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $product_categories = ProductCategory::find($request->get('id'));

        if($product_categories) {
            $product_categories->delete();

            return redirect('/product/category')->with([
                'success' => 'Kategori produk '. $product_categories->name .' berhasil dihapus'
            ]);
        } else {
            return redirect('/product/category')->with([
                'error' => 'Product category not found'
            ]);
        }
    }
}
