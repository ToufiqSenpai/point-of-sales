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
            $table->timestampsTz();
        });

        Schema::create('product_category', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestampsTz();
        });

        Schema::create('product_brand', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestampsTz();
        });

        Schema::create('product_image', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('path');
            $table->bigInteger('size');
            $table->string('mimetype');
            $table->timestampsTz();
        });

        Schema::create('product_unit', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestampsTz();
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
            $table->timestampsTz();
        });

        Schema::create('supplier', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('address');
            $table->string('phone')->unique();
            $table->string('email')->unique()->nullable();
            $table->timestampsTz();
        });

        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('address');
            $table->string('phone')->unique();
            $table->string('email')->unique()->nullable();
            $table->text('description')->nullable();
            $table->timestampsTz();
        });

        Schema::create('purchase_order', function (Blueprint $table) {
            $table->id();
            $table->integer('discount')->default(0);
            $table->integer('tax')->default(0);
            $table->bigInteger('shipping')->default(0);
            $table->enum('status', ['IN_ORDER', 'SUCCESS'])->default('IN_ORDER');
            $table->integer('subtotal')->nullable();
            $table->integer('cash')->nullable();
            $table->integer('change')->nullable();
            $table->foreignId('supplier_id')->nullable()->constrained('supplier')->onDelete('set null');
            $table->softDeletes();
            $table->timestampsTz();
        });

        Schema::create('purchase_order_item', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->foreignId('product_id')->nullable()->constrained('product')->onDelete('set null');
            $table->foreignId('purchase_order_id')->constrained('purchase_order')->onDelete('cascade');
            $table->timestampsTz();
        });

        Schema::create('sales_order', function (Blueprint $table) {
            $table->id();
            $table->integer('discount')->default(0);
            $table->integer('tax')->default(0);
            $table->bigInteger('shipping')->default(0);
            $table->enum('status', ['IN_ORDER', 'SUCCESS'])->default('IN_ORDER');
            $table->integer('subtotal')->nullable();
            $table->integer('cash')->nullable();
            $table->integer('change')->nullable();
            $table->foreignId('customer_id')->nullable()->constrained('supplier')->onDelete('set null');
            $table->foreignId('cashier_id')->nullable()->constrained('user')->onDelete('set null');
            $table->softDeletes();
            $table->timestampsTz();
        });

        Schema::create('sales_order_item', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->foreignId('product_id')->nullable()->constrained('product')->onDelete('set null');
            $table->foreignId('purchase_order_id')->constrained('purchase_order')->onDelete('cascade');
            $table->timestampsTz();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->text('invoice_footer');
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('product_category');
        Schema::dropIfExists('product_brand');
        Schema::dropIfExists('product_image');
        Schema::dropIfExists('product_unit');
        Schema::dropIfExists('product');
        Schema::dropIfExists('supplier');
        Schema::dropIfExists('customer');
        Schema::dropIfExists('purchase_order');
        Schema::dropIfExists('purchase_order_item');
        Schema::dropIfExists('settings');
    }
};
