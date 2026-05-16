<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rezgo_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('rezgo_uid');
            $table->string('rezgo_title');
            $table->string('tour_date');
            $table->decimal('price_adult', 10, 2)->default(0);
            $table->decimal('price_child', 10, 2)->default(0);
            $table->integer('qty_adult')->default(0);
            $table->integer('qty_child')->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('status')->default('pending');
            $table->string('rezgo_booking_id')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')
                  ->references('id')
                  ->on('ec_customers')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rezgo_orders');
    }
};
