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
        Schema::create("message", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("application_id");
            $table->unsignedBigInteger("user_id");
            $table->text("content");
            $table->string("sender"); // sender カラムを追加
            $table->timestamps();

            $table
                ->foreign("application_id")
                ->references("id")
                ->on("applications")
                ->onDelete("cascade");

            $table
                ->foreign("user_id")
                ->references("id")
                ->on("users")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("message");
    }
};
