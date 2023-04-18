<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait ProductColumn
{
    protected array $product_column = [
        'p.id AS id',
        'p.name AS name',
        'p.description AS description',
        'p.barcode AS barcode',
        'p.sku AS sku',
        'p.base_price AS base_price',
        'p.selling_price AS selling_price',
        'p.stock AS stock',
        'pb.name AS brand',
        'pc.name AS category',
        'pu.name AS unit',
        'pi.name AS image_name',
        'pi.path AS image_path'
    ];

    protected function product_query()
    {
        return DB::table('product AS p')
            ->join('product_image AS pi', 'p.image_id', '=', 'pi.id')
            ->join('product_brand AS pb', 'p.brand_id', '=', 'pb.id')
            ->join('product_category AS pc', 'p.category_id', '=', 'pc.id')
            ->join('product_unit AS pu', 'p.unit_id', '=', 'pu.id');
    }
}
