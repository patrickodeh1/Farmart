<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ensure rezgo_submissions table has all required columns
        if (Schema::hasTable('rezgo_submissions')) {
            Schema::table('rezgo_submissions', function (Blueprint $table) {
                // Add http_status if it doesn't exist
                if (!Schema::hasColumn('rezgo_submissions', 'http_status')) {
                    $table->integer('http_status')->nullable()->after('response_payload');
                }
            });
        } else {
            // Create table if it doesn't exist
            Schema::create('rezgo_submissions', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('order_id')->index();
                $table->string('rezgo_booking_id')->nullable();
                $table->string('status')->default('pending');
                $table->longText('request_payload')->nullable();
                $table->longText('response_payload')->nullable();
                $table->integer('http_status')->nullable();
                $table->longText('error_message')->nullable();
                $table->timestamps();
                
                $table->foreign('order_id')
                    ->references('id')
                    ->on('ec_orders')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Do nothing on reverse to preserve data
    }
};
