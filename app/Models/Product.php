<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'water_type_id',
        'size_id',
        'price',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

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

    public function name(): Attribute
    {
        return new Attribute(
            get: fn($value) => "{$this->waterType->name} {$this->size->name}",
        );
    }
}
