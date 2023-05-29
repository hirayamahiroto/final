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
        Schema::create("offers", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("name")->nullable(false);

            //第一引数：桁数、第二引数：小数点以下0桁まで
            $table->decimal("salary", 10, 0);

            // 企業ID（外部キー）
            $table
                ->foreignId("company_id")
                ->nullable(false)
                ->constrained("companies")
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("offers");
    }
};