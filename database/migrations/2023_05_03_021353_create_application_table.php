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
        Schema::create("applications", function (Blueprint $table) {
            $table->bigIncrements("id");
            // ユーザー（外部キー）
            $table
                ->foreignId("user_id")
                ->constrained("users")
                ->cascadeOnDelete()
                ->default("0");
            //求人情報(外部キー)
            $table
                ->foreignId("offer_id")
                ->constrained("offers")
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("applications");
    }
};