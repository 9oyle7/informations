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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();

            // السيارة
            $table->foreignId('car_id')
                ->constrained()
                ->cascadeOnDelete();

            // نوع الصيانة (قائمة منسدلة)
            $table->foreignId('maintenance_type_id')
                ->constrained('maintenance_types');

            $table->integer('mileage')->nullable();
            $table->decimal('cost', 10, 2)->nullable();
            $table->date('serviced_at');
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
