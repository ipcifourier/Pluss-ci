<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            // Ajout des colonnes si elles n'existent pas déjà
            if (!Schema::hasColumn('documents', 'gtt_id')) {
                $table->foreignId('gtt_id')->nullable()->constrained()->nullOnDelete()->after('id');
            }
            if (!Schema::hasColumn('documents', 'domain')) {
                $table->string('domain')->nullable()->after('type'); // PREVENIR, DETECTER, etc.
            }
            if (!Schema::hasColumn('documents', 'sub_domain')) {
                $table->string('sub_domain')->nullable()->after('domain'); // Zoonoses, etc.
            }
            if (!Schema::hasColumn('documents', 'published_at')) {
                $table->date('published_at')->nullable()->after('sub_domain');
            }
        });
    }

    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropForeign(['gtt_id']);
            $table->dropColumn(['gtt_id', 'domain', 'sub_domain', 'published_at']);
        });
    }
};