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
        Schema::create("feature", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("name")->nullable(false);
            $table
                ->foreignId("offer_id")
                ->constrained("offer")
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("feature");
    }
};
