<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('robot_commands', function (Blueprint $table) {
            $table->id();
            $table->string('command');
            $table->string('status');
            $table->unsignedBigInteger('sent_by');
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->text('response')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('robot_commands');
    }
};
