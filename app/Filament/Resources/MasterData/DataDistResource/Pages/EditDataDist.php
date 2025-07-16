<?php

namespace App\Filament\Resources\MasterData\DataDistResource\Pages;

use App\Filament\Resources\MasterData\DataDistResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataDist extends EditRecord
{
    protected static string $resource = DataDistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
