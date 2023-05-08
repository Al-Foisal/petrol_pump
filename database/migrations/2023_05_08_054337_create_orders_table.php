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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_model');
            $table->string('vehicle_number');
            $table->string('vehicle_supervisor_name');
            $table->string('vehicle_supervisor_mobile');
            $table->string('vehicle_type');
            $table->string('total_amount');
            $table->string('received_amount');
            $table->string('changes_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
