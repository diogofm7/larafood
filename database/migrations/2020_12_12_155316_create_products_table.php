<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->uuid('uuid');

            $table->string('title')->unique();
            $table->string('flag')->unique();
            $table->string('image');
            $table->double('price', 10, 2);
            $table->text('description');

            $table->timestamps();
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_product');
        Schema::dropIfExists('products');
    }
}
