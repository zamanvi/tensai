<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_profiles', function (Blueprint $table) {
            // Structured address (replaces free-text address_bangladesh)
            $table->string('street_address')->nullable()->after('address_bangladesh');
            $table->string('district')->nullable()->after('street_address');
            $table->string('division')->nullable()->after('district');
            $table->string('postal_code', 20)->nullable()->after('division');

            // Emergency contact
            $table->string('emergency_contact_name')->nullable()->after('postal_code');
            $table->string('emergency_contact_phone', 30)->nullable()->after('emergency_contact_name');
            $table->string('emergency_contact_relation')->nullable()->after('emergency_contact_phone');
        });
    }

    public function down(): void
    {
        Schema::table('student_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'street_address', 'district', 'division', 'postal_code',
                'emergency_contact_name', 'emergency_contact_phone', 'emergency_contact_relation',
            ]);
        });
    }
};
