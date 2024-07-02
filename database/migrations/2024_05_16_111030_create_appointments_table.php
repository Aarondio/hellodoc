<?php

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Timeslot;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Type\Time;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Doctor::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Timeslot::class)->nullable();
            $table->time('appointment_time');
            $table->date('appointment_date');
            $table->string('description')->nullable();
            $table->longText('recommendation')->nullable();
            $table->enum('status', ['Pending', 'Confirmed', 'Canceled'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
