<?php

namespace App\Types;

use App\Traits\Makeable;

class TransactionType extends BaseType
{
    use Makeable;

    public const WALK_IN = 'Walk-in';
    public const DELIVERY = 'Delivery';

    public function setTypes(): array
    {
        return [
            self::WALK_IN,
            self::DELIVERY
        ];
    }

    public function setSelectionTypes(): array
    {
        return [
            self::WALK_IN => self::WALK_IN,
            self::DELIVERY => self::DELIVERY,
        ];
    }

    public function setDefaultColors(): array
    {
        return [
            self::WALK_IN => 'primary',
            self::DELIVERY => 'info'
        ];
    }
}
