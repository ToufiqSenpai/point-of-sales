<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductUnit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query =
            "SELECT
            p.name AS name,
            p.description AS description,
            p.barcode as barcode,
            p.sku AS sku,
            p.base_price AS base_price,
            p.selling_price AS selling_price,
            pb.name AS brand,
            pc.name AS category,
            pu.name AS unit,
            pi.name AS image_name,
            pi.path AS image_path
            FROM product p
            JOIN product_image pi on p.image_id = pi.id
            JOIN product_brand pb on pb.id = p.brand_id
            JOIN product_category pc on p.category_id = pc.id
            JOIN product_unit pu on p.unit_id = pu.id;";
//        dd(DB::select($query));
        return view('product.index', [
//            'products' => DB::raw('SELECT *')
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
}
