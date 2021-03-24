<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnWooProductSkuToSkuOnProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('woo_product_sku', 'sku');
            $table->renameColumn('meli_product_sku', 'meli_sku');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sku_on_products', function (Blueprint $table) {
            $table->renameColumn('sku', 'woo_product_sku');
            $table->renameColumn('meli_sku', 'meli_product_sku');
        });
    }
}
