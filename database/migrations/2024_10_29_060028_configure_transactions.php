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
        // Drop foreign key constraint from transactions table if it exists
        Schema::table('transactions', function (Blueprint $table) {
            // Assuming 'transactions_documentId_foreign' is the name of the foreign key
            $table->dropForeign(['documentId']);
        });

        // Now drop the documents table
        Schema::dropIfExists('documents');

        // Modify transactions table
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('documentId'); // Drop the documentId column
            $table->foreignId('proposalId')->nullable()->constrained('proposals'); // Add the new foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Add back the foreign key for documentId
            $table->foreignId('documentId')->nullable()->constrained('documents');
            $table->dropColumn('proposalId'); // Drop the proposalId column
        });
    }
};
