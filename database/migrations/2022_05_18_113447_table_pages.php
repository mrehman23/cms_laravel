<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class TablePages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('lan');
            $table->string('heading');
            $table->string('template')->nullable();
            $table->integer('menu_visible');
            $table->integer('weight');
            $table->integer('status')->default('1');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE ".DB::getTablePrefix()."pages ADD content LONGBLOB NOT NULL AFTER heading");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
