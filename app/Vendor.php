<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vendor extends Model
{
    protected $fillable = [
        'name',
        'active',
        'market_id',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function users() : HasMany
    {
        return $this->hasMany(User::class);
    }

    public function market() : BelongsTo
    {
        return $this->belongsTo(Market::class);
    }
}
