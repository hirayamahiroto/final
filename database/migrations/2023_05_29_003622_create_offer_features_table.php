<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferFeaturesTable extends Migration
{
    public function up()
    {
        Schema::create("offer_features", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("offer_id");
            $table->unsignedBigInteger("feature_id");
            $table->timestamps();

            $table
                ->foreign("offer_id")
                ->references("id")
                ->on("offers")
                ->onDelete("cascade");

            $table
                ->foreign("feature_id")
                ->references("id")
                ->on("features")
                ->onDelete("cascade");
        });
    }

    public function down()
    {
        Schema::dropIfExists("offer_features");
    }
}
