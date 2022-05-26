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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(false);
            $table->integer('duration')->nullable(false);
            $table->integer('mark')->nullable(false)->default(100);
            $table->boolean('has_negative_marking')->default(false);
            $table->float('negative_mark_rate')->default(0.25);
            $table->integer('no_of_quizes')->default(2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
};
