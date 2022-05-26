<?php

use App\Models\Quiz;
use App\Models\UserExam;
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
        Schema::create('user_exam_quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(UserExam::class)->nullable();
            $table->foreignIdFor(Quiz::class)->nullable();
            $table->string('user_answere')->nullable();
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
        Schema::dropIfExists('user_exam_quizzes');
    }
};
