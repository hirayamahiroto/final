<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $fillable = ["name", "salary", "company_id"];

    public function features()
    {
        return $this->belongsToMany(Feature::class, "offer_features");
    }
}
