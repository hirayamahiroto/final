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
        Schema::create("application", function (Blueprint $table) {
            $table->bigIncrements("id");
            // ユーザー（外部キー）
            $table
                ->foreignId("use_id")
                ->constrained("user")
                ->cascadeOnDelete();
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
        Schema::dropIfExists("application");
    }
};
