<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE ocr_jobs MODIFY COLUMN document_type ENUM(
            'passport','nid','ssc_certificate','hsc_certificate',
            'degree_certificate','transcript','jlpt_certificate','ielts_certificate'
        ) NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE ocr_jobs MODIFY COLUMN document_type ENUM(
            'passport','nid','certificate','transcript','language_score'
        ) NOT NULL");
    }
};
