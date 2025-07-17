<?php

namespace App\Filament\Resources\TroubleshootCategoryResource\Pages;

use App\Filament\Resources\TroubleshootCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTroubleshootCategory extends EditRecord
{
    protected static string $resource = TroubleshootCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
