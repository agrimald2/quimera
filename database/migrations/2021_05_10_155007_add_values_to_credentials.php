<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValuesToCredentials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('credentials', function (Blueprint $table) {
            $table->boolean('collections')->nullable();
            $table->boolean('brands')->nullable();
            $table->boolean('colors')->nullable();
            $table->boolean('discounts')->nullable();
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
            $table->dropColumn('collections');
            $table->dropColumn('brands');
            $table->dropColumn('colors');
            $table->dropColumn('discounts');
        });
    }
}
