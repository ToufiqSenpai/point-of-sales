<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductUnit;
use App\Traits\ProductColumn;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    use ProductColumn;

    public function index(Request $request): View
    {
//        dd(Product::paginate(10));
        return view('product.index', [
            'products' => Product::paginate(10)
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
}
