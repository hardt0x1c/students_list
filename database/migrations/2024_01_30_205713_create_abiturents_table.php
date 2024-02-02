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
        Schema::create('abiturents', function (Blueprint $table) {
            $table->id();
            $table->string('name', 55);
            $table->string('surname', 55);
            $table->boolean('gender');
            $table->string('group_number', 55);
            $table->string('email', 55)->unique();
            $table->integer('total_ege');
            $table->date('date_of_birth');
            $table->integer('phone_number')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abiturents');
    }
};
