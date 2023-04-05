<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('password');
            $table->enum('role', ['ADMIN', 'OWNER'])->default('ADMIN');
            $table->timestamps();
        });

        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('path');
            $table->bigInteger('size');
            $table->string('mimetype');
            $table->timestamps();
        });

        Schema::create('product_units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description');
            $table->bigInteger('base_price');
            $table->bigInteger('sell_price');
            $table->integer('sold');
            $table->integer('stock');
            $table->foreignId('category_id')->constrained('product_categories')->onDelete('cascade');
            $table->foreignId('unit_id')->constrained('product_units')->onDelete('cascade');
            $table->foreignId('image_id')->constrained('product_images')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->text('address');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->timestamps();
        });

        Schema::create('incoming_stocks', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->integer('amount');
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('outgoing_stocks', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->integer('amount');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->timestamps();
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('discount');
            $table->integer('tax');
            $table->bigInteger('shipping');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('cashier_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('transaction_products', function (Blueprint $table) {
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
