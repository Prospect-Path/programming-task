<?php

namespace App;

use App\Leads\Lead;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Market extends Model
{
    protected $fillable = [
        'name',
    ];

    public function leads() : HasMany
    {
        return $this->hasMany(Lead::class);
    }

    public function vendors() : HasMany
    {
        return $this->hasMany(Vendor::class);
    }
}
