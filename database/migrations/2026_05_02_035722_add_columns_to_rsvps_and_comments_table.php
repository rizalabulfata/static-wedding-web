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
        Schema::table('rsvps', function (Blueprint $table) {
            $table->string('caller_name')->nullable()->after('name');
            $table->string('unique_id', 12)->unique()->nullable()->after('caller_name');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->foreignId('rsvp_id')->nullable()->after('id')->constrained('rsvps')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('rsvps', function (Blueprint $table) {
            $table->dropColumn(['caller_name', 'unique_id']);
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['rsvp_id']);
            $table->dropColumn('rsvp_id');
        });
    }
};
