<?php

namespace App\Forms\Components;

use App\Types\TransactionType;
use Filament\Forms\Components\Field;

class TransactionTypeSelect extends Field
{
    protected string $view = 'forms.components.transaction-type-select';

    protected function setUp(): void
    {
        parent::setUp();

        $this->dehydrateStateUsing(fn($state) => $state['id'] ?? null);

        $this->reactive();
    }

    public function getTransactionTypes(): array
    {
        return TransactionType::make()->types();
    }
}
