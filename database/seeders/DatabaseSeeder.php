<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('user')->insert([
            'name' => 'root',
            'username' => 'root',
            'password' => bcrypt('admin123'),
            'role' => 'OWNER'
        ]);

        DB::table('product_unit')->insert([
            'name' => 'Km'
        ]);

        DB::table('product_brand')->insert([
            'name' => "Fu'ad"
        ]);

        DB::table('product_category')->insert([
            'name' => 'Alat tulis'
        ]);

        DB::table('product')->insert([
            'name' => 'Sabun Kopi',
            'brand_id' => 1,
            'category_id' => 1,
            'unit_id' => 1,
            'base_price' => 69,
            'selling_price' => 6969
        ]);

        DB::table('supplier')->insert([
            'name' => 'Fuad',
            'address' => 'Jl. cinta',
            'phone' => 123456789
        ]);
    }
}
