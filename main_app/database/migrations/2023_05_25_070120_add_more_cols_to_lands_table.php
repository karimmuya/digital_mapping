<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lands', function (Blueprint $table) {
       
            $table->string('region')->nullable();
            $table->string('district')->nullable();
            $table->string('mradi')->nullable();
            $table->string('stprice')->nullable();
            $table->string('pymnt_season')->nullable();
            $table->string('phone')->nullable();
            $table->string('pic')->nullable();
            $table->string('gallery')->nullable();
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lands', function (Blueprint $table) {
            $table->dropColumn('region');
            $table->dropColumn('district');
            $table->dropColumn('mradi');
            $table->dropColumn('stprice');
            $table->dropColumn('pymnt_season');
            $table->dropColumn('phone');
            $table->dropColumn('gmap');
            $table->dropColumn('gallery');
        });
    }
};
