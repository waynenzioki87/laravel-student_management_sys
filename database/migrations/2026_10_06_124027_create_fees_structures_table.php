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
        Schema::create('fees_structures', function (Blueprint $table) {
            $table->id();
             
            $table->foreignId('course_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('semester_id')
                  ->constrained()
                  ->cascadeOnDelete();  
                  
            $table->foreignId('academic_year__id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->decimal('amount', 12, 2);      

            $table->timestamps();
            
             $table->unique([
              'student_id',
              'course_id',
              'semester_id',
              'academic_year_id'
           ]);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees_structures');
    }
};
