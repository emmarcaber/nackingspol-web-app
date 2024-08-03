<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }

    public function waterType(): BelongsTo
    {
        return $this->belongsTo(WaterType::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
