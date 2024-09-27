<?php

namespace App\Types;

use App\Traits\Makeable;

class OrderStatusType extends BaseType
{
    use Makeable;

    public const PAID = 'Paid';
    public const NOT_PAID = 'Not Paid';

    public function setTypes(): array
    {
        return [
            self::PAID,
            self::NOT_PAID
        ];
    }

    public function setSelectionTypes(): array
    {
        return [
            self::PAID => self::PAID,
            self::NOT_PAID => self::NOT_PAID,
        ];
    }

    public function setDefaultColors(): array
    {
        return [
            self::PAID => 'success',
            self::NOT_PAID => 'danger'
        ];
    }
}
