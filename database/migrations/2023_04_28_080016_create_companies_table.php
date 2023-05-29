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
        Schema::create("companies", function (Blueprint $table) {
            $table->id();
            $table
                ->string("name")
                ->nullable(false)
                ->default("〜〜〜会社");
            $table->string("email")->unique();
            $table->timestamp("email_verified_at")->nullable();
            $table
                ->string("human_name")
                ->nullable(false)
                ->default("社長");
            $table->string("password");
            //外部とやり寄りするため、nullable
            $table
                ->foreignId("industry_id")
                ->nullable()
                ->constrained("industries")
                ->cascadeOnDelete();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("companies");
    }
};
