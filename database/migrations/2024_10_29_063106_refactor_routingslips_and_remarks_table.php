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
        // Drop the foreign key from routing_slips
        Schema::table('routing_slips', function (Blueprint $table) {
            // Replace 'remarksId' with the correct foreign key name
            $table->dropForeign(['remarksId']); // Correct syntax for dropping foreign key
        });

        // Add the foreign key to the remarks table
        Schema::table('remarks', function (Blueprint $table) {
            $table->foreignId('routingSlipId')->nullable()->constrained('routing_slips')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse the migration
        Schema::table('remarks', function (Blueprint $table) {
            $table->dropForeign(['routingSlipId']); // Drop the foreign key constraint
            $table->dropColumn('routingSlipId'); // Drop the column
        });

        Schema::table('routing_slips', function (Blueprint $table) {
            // Optionally, re-add the foreign key if you need to restore it
            // Make sure to add the column back first if it was dropped
            // $table->foreignId('remarksId')->constrained('remarks')->onDelete('cascade');
        });
    }
};
