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
        Schema::create('analyzes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('test_id')->nullable();
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('answer_id');
            $table->Integer('analyze_returncode');
            $table->Text('analyze_stdout');
            $table->String('analyze_stderr');
            $table->Integer('analyze_error_count');
            $table->Integer('analyze_penalty');
            $table->unsignedBigInteger('diffenreces_id')->nullable();
            $table->Integer('differences_penalty');
            $table->Text('missing_keyword');
            $table->Intenger('keyword_penalty');
            $table->Integer('total_penalty');
            $table->Integer('score');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
            $table->foreign('diffenreces_id')->references('id')->on('differences')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analyzes');
    }
};
