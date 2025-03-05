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
        Schema::create('tbl_purchases', function (Blueprint $table) {
            $table->id();
            $table->string('BillNo');
            $table->string('MemberID');
            $table->foreign('MemberID')->references('MemberID')->on('tbl_members')->onDelete('cascade');
            $table->date('SalesDate');
            $table->decimal('Amount', 18, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_purchases');
    }
};
