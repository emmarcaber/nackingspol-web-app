<?php

namespace App\Filament\Resources\WaterTypeResource\Pages;

use App\Filament\Resources\WaterTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWaterType extends EditRecord
{
    protected static string $resource = WaterTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
