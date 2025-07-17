<?php

namespace App\Filament\Resources\TroubleshootSubSubcategoryResource\Pages;

use App\Filament\Resources\TroubleshootSubSubcategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTroubleshootSubSubcategory extends EditRecord
{
    protected static string $resource = TroubleshootSubSubcategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
