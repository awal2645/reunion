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
        Schema::table('users', function (Blueprint $table) {
            // Add new structured address fields
            $table->string('present_vill')->nullable()->after('present_address');
            $table->string('present_post_office')->nullable()->after('present_vill');
            $table->string('present_thana')->nullable()->after('present_post_office');
            $table->string('present_district')->nullable()->after('present_thana');
            
            $table->string('permanent_vill')->nullable()->after('permanent_address');
            $table->string('permanent_post_office')->nullable()->after('permanent_vill');
            $table->string('permanent_thana')->nullable()->after('permanent_post_office');
            $table->string('permanent_district')->nullable()->after('permanent_thana');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove the added fields
            $table->dropColumn([
                'present_vill',
                'present_post_office', 
                'present_thana',
                'present_district',
                'permanent_vill',
                'permanent_post_office',
                'permanent_thana',
                'permanent_district'
            ]);
        });
    }
};
