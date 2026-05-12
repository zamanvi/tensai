<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gallery_items', function (Blueprint $table) {
            // Uploaded file path (local storage) — alternative to image_url
            $table->string('image_path')->nullable()->after('image_url');
            // Make image_url nullable since admin may upload instead
            $table->string('image_url')->nullable()->change();
            // Full story / rich text content
            $table->longText('content')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('gallery_items', function (Blueprint $table) {
            $table->dropColumn(['image_path', 'content']);
            $table->string('image_url')->nullable(false)->change();
        });
    }
};
