<?php

namespace App\Filament\Resources\WaterTypeResource\Pages;

use App\Filament\Resources\WaterTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWaterTypes extends ListRecords
{
    protected static string $resource = WaterTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
