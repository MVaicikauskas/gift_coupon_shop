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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('recipient_name');
            $table->string('email')->unique();
            $table->longText('wish');
            $table->boolean('accept_privacy_policy')->default(false);
            $table->integer('value');
            $table->unsignedTinyInteger('coupon_delivery')->default(0);
            $table->unsignedTinyInteger('coupon_type')->default(0);
            $table->unsignedTinyInteger('coupon_status')->default(0);
            $table->string('code');
            $table->dateTime('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
