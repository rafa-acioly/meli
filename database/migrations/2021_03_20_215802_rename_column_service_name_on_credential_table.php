<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnServiceNameOnCredentialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('credentials', function (Blueprint $table) {
            $table->renameColumn('service_name', 'store_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('credentials', function (Blueprint $table) {
            $table->renameColumn('store_url', 'service_name');
        });
    }
}
