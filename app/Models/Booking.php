<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    protected $fillable = [
    'user_id',
    'package_id',
    'travel_date',
    'travelers',
    'total_price',
    'status',
];
    public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}

public function package(): BelongsTo
{
    return $this->belongsTo(Package::class);
}

public function bookingTravelers(): HasMany
{
    return $this->hasMany(BookingTraveler::class);
}
}
