<?php

namespace App\Filament\Resources\TroubleshootSubcategoryResource\Pages;

use App\Filament\Resources\TroubleshootSubcategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTroubleshootSubcategory extends EditRecord
{
    protected static string $resource = TroubleshootSubcategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
