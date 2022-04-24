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
        Schema::disableForeignKeyConstraints();
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->foreignId('grade_id')->constrained('teacher_grades')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('statut_id')->constrained('teacher_statuses')->cascadeOnUpdate()->cascadeOnDelete();
            // $table->string('grade');
            $table->string('matricule')->unique();
            // $table->string('status');
            $table->string('photo')->default('/dist/img/avatar.png');
            $table->string('email')->unique();
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->string('phone', 9)->unique();
            $table->string('footprint1')->nullable();
            $table->string('footprint2')->nullable();
            $table->string('footprint3')->nullable();
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
        Schema::dropIfExists('teachers');
    }
};
