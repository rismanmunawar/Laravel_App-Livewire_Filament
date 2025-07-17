<?php

namespace App\Filament\Resources\TroubleshootSubSubcategoryResource\Pages;

use App\Filament\Resources\TroubleshootSubSubcategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTroubleshootSubSubcategories extends ListRecords
{
    protected static string $resource = TroubleshootSubSubcategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
