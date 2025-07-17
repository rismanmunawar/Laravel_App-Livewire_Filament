<?php

namespace App\Filament\Resources\TroubleshootTopicResource\Pages;

use App\Filament\Resources\TroubleshootTopicResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTroubleshootTopic extends EditRecord
{
    protected static string $resource = TroubleshootTopicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
