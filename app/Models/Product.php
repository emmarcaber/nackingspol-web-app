<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }

    public function waterType(): BelongsTo
    {
        return $this->belongsTo(WaterType::class);
    }
}
