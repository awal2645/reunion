<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // Basic Information
            $table->string('role')->default('user');
            $table->string('full_name');
            $table->string('nickname')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('session')->nullable();
            $table->string('batch_year')->nullable(); // Academic year, used for payment calculation
            $table->string('contact_number')->nullable();
            $table->string('email')->unique();
            $table->string('facebook_profile')->nullable();
            $table->string('whatsapp_number')->nullable();

            // Current Details
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('country_of_residence')->nullable();
            $table->string('city_of_residence')->nullable();

            // Professional Information
            $table->string('occupation')->nullable();
            $table->string('organization_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('work_location')->nullable();

            // Family Information
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])->nullable();
            $table->string('spouse_name')->nullable();
            $table->integer('number_of_children')->default(0);

            // Additional Information
            $table->string('photo_path')->nullable();
            $table->text('favorite_memory')->nullable();
            $table->integer('accompanying_guests')->default(0);
            $table->string('tshirt_size')->nullable();
            $table->boolean('willing_to_volunteer')->default(false);

            // Authentication fields
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'role' => 'admin',
            'full_name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'role' => 'user',
            'full_name' => 'User',
            'email' => 'user@mail.com',
            'password' => Hash::make('password'),
        ]);

        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->integer('age');
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
