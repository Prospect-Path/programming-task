<?php

namespace App;

use App\Market;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    protected $fillable = [
        'company_name',
        'market_id',
        'description',
        'number_of_employees',
        'revenue',
        'cloud', // Whether or not the lead is looking for a cloud based system
    ];

    protected $casts = [
        'market_id' => 'integer',
        'number_of_employees' => 'integer',
        'cloud' => 'boolean',
    ];

    public function market() : BelongsTo
    {
        return $this->belongsTo(Market::class);
    }
}
