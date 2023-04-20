<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductUnit;
use App\Traits\ProductColumn;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use ProductColumn;

    public function index(Request $request): View
    {
        $search = $request->query->get('search');
        $products = Product::latest();

        if($search) {
            $products->where('name', 'like', "%$search%");
        }

        return view('product.index', [
            'products' => $products->paginate(10)
        ]);
    }

    public function add(): View
    {
        return view('product.add', [
            'brands' => ProductBrand::all(),
            'categories' => ProductCategory::all(),
            'units' => ProductUnit::all()
        ]);
    }

    public function store(ProductStoreRequest $request): RedirectResponse
    {
        $body = $request->all();
        $image = $request->file('image');

        if($image) {
            $image_name = Str::uuid() .'.'. $image->extension();
            $image->storeAs('product', $image_name, 'public');
            $product_image = new ProductImage([
                'name' => $image_name,
                'path' => $image->path(),
                'size' => $image->getSize(),
                'mimetype' => $image->getMimeType()
            ]);
            $product_image->save();


            $body['image_id'] = $product_image->id;
        }

        $product = new Product($body);
        $product->save();

        return redirect('/product')->with([
            'success' => 'Produk berhasil ditambah'
        ]);
    }

    public function edit(string $id): View
    {
        return view('product.edit', [
            'product' => Product::find($id),
            'brands' => ProductBrand::all(),
            'categories' => ProductCategory::all(),
            'units' => ProductUnit::all()
        ]);
    }

    public function update(ProductUpdateRequest $request): RedirectResponse
    {
        $body = $request->all();
        $image = $request->file('image');
        $product = Product::find($body['id']);

        if($image) {
            $old_product_image = ProductImage::find($product['image_id']);

            Storage::disk('public')->delete('product/'. $old_product_image->name);

            $old_product_image->delete();
            
            $image_name = Str::uuid() .'.'. $image->extension();
            $image->storeAs('product', $image_name, 'public');
            $product_image = new ProductImage([
                'name' => $image_name,
                'path' => $image->path(),
                'size' => $image->getSize(),
                'mimetype' => $image->getMimeType()
            ]);

            $product_image->save();
            $body['image_id'] = $product_image->id;
        }

        $product = Product::find($body['id']);
        $product->update($body);

        return redirect('/product')->with([
            'success' => 'Produk '. $product->name .' berhasil diubah'
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $product = Product::find($request->get('id'));

        if($product) {
            $product_image = ProductImage::find($product->image_id);

            Storage::disk('public')->delete('product/'. $product_image->name);

            $product_image->delete();
            $product->delete();

            return redirect('/product/unit')->with([
                'success' => 'Unit produk '. $product->name .' berhasil dihapus'
            ]);
        } else {
            return redirect('/product/unit')->with([
                'error' => 'Product unit not found'
            ]);
        }
    }
}
