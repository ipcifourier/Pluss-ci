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
        /*Schema::table('subscribers', function (Blueprint $table) {
            //$table->timestamp('unsubscribed_at')->nullable();*/
            
        // Vérifier si la colonne existe avant de l'ajouter
        if (!Schema::hasColumn('subscribers', 'unsubscribed_at')) {
            Schema::table('subscribers', function (Blueprint $table) {
                $table->timestamp('unsubscribed_at')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('subscribers', 'unsubscribed_at')) {
            Schema::table('subscribers', function (Blueprint $table) {
                $table->dropColumn('unsubscribed_at');
            });
        }
    }
};
