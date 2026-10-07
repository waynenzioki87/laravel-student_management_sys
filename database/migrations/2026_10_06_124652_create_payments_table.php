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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')
                  ->constrained()
                  ->restrictOnDelete();
            
            $table->foreignId('fee_structure_id')
                  ->constrained()
                  ->restrictOnDelete();

              $table->decimal('amount', 12,2) ;   
            
            $table->foreignId('payment_method');
                  
             $table->foreignId('transaction_reference')
                   ->unique();
                   
            $table->date('payment_date');       
                                         
             $table->foreignId('received_by')
                   ->constrained('users')
                   ->restrictOnDelete();           
              
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
