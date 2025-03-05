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
        Schema::create('tbl_members', function (Blueprint $table) {
            $table->id();
            $table->string('MemberID')->unique();
            $table->string('Name');
            $table->date('DateJoin');
            $table->string('TelM');
            $table->string('Email');
            $table->date('BirthDate');
            $table->string('ParentID')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_members');
    }
};
