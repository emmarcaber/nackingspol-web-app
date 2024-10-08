<?php

namespace App\Forms\Components;

use App\Models\Product;
use Filament\Forms\Components\Field;
use Illuminate\Database\Eloquent\Collection;

class ProductCardSelect extends Field
{
    protected string $view = 'forms.components.product-card-select';



    protected function setUp(): void
    {
        parent::setUp();

        $this->dehydrateStateUsing(fn($state) => $state['id'] ?? null);

        $this->reactive();
    }

    public function getProducts(): Collection
    {
        return Product::all();
    }
}
