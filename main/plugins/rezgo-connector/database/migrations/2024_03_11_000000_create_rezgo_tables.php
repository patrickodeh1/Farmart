<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Rezgo settings table
        Schema::create('rezgo_settings', function (Blueprint $table) {
            $table->id();
            $table->string('setting_key')->unique();
            $table->longText('setting_value')->nullable();
            $table->timestamps();
            $table->index('setting_key');
        });

        // Rezgo product mappings
        Schema::create('rezgo_product_mappings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('rezgo_uid')->nullable(); // Rezgo tour UID
            $table->string('rezgo_title')->nullable(); // Rezgo tour name
            $table->decimal('rezgo_price', 10, 2)->nullable();
            $table->string('passenger_type')->default('adult'); // adult, child, senior
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('ec_products')->onDelete('cascade');
            $table->unique(['product_id']);
            $table->index('rezgo_uid');
        });

        // Rezgo order submissions
        Schema::create('rezgo_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('rezgo_booking_id')->nullable();
            $table->string('status')->default('pending'); // pending, success, failed
            $table->longText('request_payload')->nullable();
            $table->longText('response_payload')->nullable();
            $table->integer('http_status')->nullable();
            $table->longText('error_message')->nullable();
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('ec_orders')->onDelete('cascade');
            $table->index(['order_id', 'status']);
            $table->index('rezgo_booking_id');
        });

        // Rezgo sync logs
        Schema::create('rezgo_logs', function (Blueprint $table) {
            $table->id();
            $table->string('log_type'); // sync, error, warning, info
            $table->string('operation'); // get_products, commit_booking, etc.
            $table->unsignedBigInteger('related_id')->nullable(); // order_id, product_id, etc.
            $table->longText('message');
            $table->longText('context')->nullable(); // JSON context data
            $table->timestamps();
            $table->index(['log_type', 'created_at']);
            $table->index('operation');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rezgo_logs');
        Schema::dropIfExists('rezgo_submissions');
        Schema::dropIfExists('rezgo_product_mappings');
        Schema::dropIfExists('rezgo_settings');
    }
};
