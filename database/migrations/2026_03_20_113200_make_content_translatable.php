<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Services: title, short_description, description → JSON
        Schema::table('services', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('short_description')->change();
            $table->json('description')->nullable()->change();
        });

        // Projects: title, scope, description, location → JSON
        Schema::table('projects', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('scope')->change();
            $table->json('description')->nullable()->change();
            $table->json('location')->change();
        });

        // Hero Banners: title, highlight_text, description, badge_text, cta_primary_text, cta_secondary_text → JSON
        Schema::table('hero_banners', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('highlight_text')->nullable()->change();
            $table->json('description')->nullable()->change();
            $table->json('badge_text')->nullable()->change();
            $table->json('cta_primary_text')->nullable()->change();
            $table->json('cta_secondary_text')->nullable()->change();
        });

        // Company Stats: label → JSON
        Schema::table('company_stats', function (Blueprint $table) {
            $table->json('label')->change();
        });

        // Clients: description → JSON
        Schema::table('clients', function (Blueprint $table) {
            $table->json('description')->nullable()->change();
        });

        // Company Settings: value → JSON
        Schema::table('company_settings', function (Blueprint $table) {
            $table->json('value')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('title')->change();
            $table->text('short_description')->change();
            $table->longText('description')->nullable()->change();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->string('title')->change();
            $table->text('scope')->change();
            $table->longText('description')->nullable()->change();
            $table->string('location')->change();
        });

        Schema::table('hero_banners', function (Blueprint $table) {
            $table->string('title')->change();
            $table->string('highlight_text')->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->string('badge_text')->nullable()->change();
            $table->string('cta_primary_text')->nullable()->change();
            $table->string('cta_secondary_text')->nullable()->change();
        });

        Schema::table('company_stats', function (Blueprint $table) {
            $table->string('label')->change();
        });

        Schema::table('clients', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
        });

        Schema::table('company_settings', function (Blueprint $table) {
            $table->longText('value')->nullable()->change();
        });
    }
};
