<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use SebastianBergmann\Type\VoidType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->enum('role', ['CASHIER', 'ADMIN', 'OWNER'])->default('CASHIER');
            $table->timestamps();
        });

        Schema::create('product_category', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('product_brand', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('product_image', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('path');
            $table->bigInteger('size');
            $table->string('mimetype');
            $table->timestamps();
        });

        Schema::create('product_unit', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->string('barcode')->nullable();
            $table->string('sku')->nullable();
            $table->bigInteger('base_price');
            $table->bigInteger('selling_price');
            $table->integer('sold')->default(0);
            $table->integer('stock')->default(0);
            $table->foreignId('category_id')->nullable()->constrained('product_category')->onDelete('set null');
            $table->foreignId('unit_id')->nullable()->constrained('product_unit')->onDelete('set null');
            $table->foreignId('brand_id')->nullable()->constrained('product_brand')->onDelete('set null');
            $table->foreignId('image_id')->nullable()->constrained('product_image')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('supplier', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('address');
            $table->string('phone')->unique();
            $table->string('email')->unique()->nullable();
            $table->timestamps();
        });

        Schema::create('outgoing_stock', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->integer('amount');
            $table->foreignId('product_id')->constrained('product')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('address');
            $table->string('phone')->unique();
            $table->string('email')->unique()->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('purchase_order', function (Blueprint $table) {
            $table->id();
            $table->integer('discount');
            $table->integer('tax');
            $table->bigInteger('shipping');
            $table->foreignId('supplier_id')->nullable()->constrained('supplier')->onDelete('set null');
            $table->timestamps();
        });

        Schema::create('purchase_order_product', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->integer('discount');
            $table->foreignId('product_id')->constrained('product')->onDelete('no action');
            $table->foreignId('purchase_order_id')->constrained('purchase_order');
            $table->timestamps();
        });

        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->integer('discount');
            $table->integer('tax');
            $table->bigInteger('shipping');
            $table->foreignId('customer_id')->constrained('customer')->onDelete('cascade');
            $table->foreignId('cashier_id')->constrained('user')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('transaction_product', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->integer('discount');
            $table->timestamps();
        });

        Schema::create('shop', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->string('shop_logo');
            $table->string('nota_footer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('product_brands');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('product_units');
        Schema::dropIfExists('products');
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('incoming_stocks');
        Schema::dropIfExists('outgoing_stocks');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('transaction_products');
        Schema::dropIfExists('shop');
    }
};
