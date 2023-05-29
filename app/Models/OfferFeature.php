<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferFeature extends Model
{
    protected $table = "offer_features";

    protected $fillable = ["offer_id", "feature_id"];

    public $timestamps = false;

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }
}
