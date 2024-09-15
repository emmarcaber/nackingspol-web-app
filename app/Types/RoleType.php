<?php

namespace App\Types;

use App\Traits\Makeable;

class RoleType extends BaseType
{
    use Makeable;

    public const SUPER_ADMIN = 'Super Admin';
    public const CASHIER = 'Cashier';

    public static function getDefaultPermissions(string $classname): array
    {
        return [
            self::SUPER_ADMIN => [
                "view any $classname",
                "view $classname",
                "create $classname",
                "update $classname",
                "delete $classname",
                "restore $classname",
                "force delete $classname"
            ],
            self::CASHIER => [
                "view any $classname",
                "view $classname"
            ]
        ];
    }

    public function setTypes(): array
    {
        return [
            self::SUPER_ADMIN,
            self::CASHIER
        ];
    }

    public function setSelectionTypes(): array
    {
        return [
            self::SUPER_ADMIN => self::SUPER_ADMIN,
            self::CASHIER => self::CASHIER,
        ];
    }

    public function setDefaultColors(): array
    {
        return [
            self::SUPER_ADMIN => 'danger',
            self::CASHIER => 'primary'
        ];
    }
}
