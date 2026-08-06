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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->enum('sex', ['male', 'female', 'other']);
            $table->enum('religion', ['hindu', 'muslim', 'christion', 'shikh', 'others']);
            $table->string('address');
            $table->string('remark');
            $table->integer('registrationNumber');
            $table->string('bloodGroup');
            $table->string('mobile');
            $table->string('patientName');
            $table->timestamps();
            //have to add medical history, consultationId, appointment and others
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
