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
        Schema::create('school_grades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id')->unique(false);
            $table->integer('grade'); //学年
            $table->integer('term'); //学期
            $table->integer('japanese'); //以下教科
            $table->integer('math');
            $table->integer('science');
            $table->integer('social_studies');
            $table->integer('music');
            $table->integer('home_economics');
            $table->integer('engrish');
            $table->integer('art');
            $table->integer('health_and_physical_education');

            // 外部キー制約を追加
            $table->foreignId('student_id')->constrained('students')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_grades');
    }
};
