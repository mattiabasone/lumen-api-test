<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductWishlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_wishlist', static function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('wishlist_id');
            $table->timestamps();

            $table->foreign('product_id', 'product_id_product_wishlist_foreign')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');

            $table->foreign('wishlist_id', 'wishlist_id_product_wishlist_foreign')
                ->references('id')
                ->on('wishlists')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_wishlist');
    }
}
