<?php

namespace App\Filament\Resources\TroubleshootTopicResource\Pages;

use App\Filament\Resources\TroubleshootTopicResource;
use App\Models\TroubleshootCategory;
use App\Models\TroubleshootSubcategory;
use App\Models\TroubleshootSubSubcategory;
use Filament\Resources\Pages\Page;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Database\Eloquent\Builder;

class CategoryOverview extends Page implements Tables\Contracts\HasTable
{
    use InteractsWithTable;

    protected static string $resource = TroubleshootTopicResource::class;

    protected static string $view = 'filament.resources.troubleshoot-topic-resource.pages.category-overview';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(TroubleshootCategory::query())
            ->columns([
                TextColumn::make('name')->label('Category'),
                TextColumn::make('subcategories_count')->label('Subcategories'),
                TextColumn::make('subcategories.name')
                    ->label('Subcategory Names')
                    ->formatStateUsing(function ($state, TroubleshootCategory $record) {
                        return $record->subcategories->pluck('name')->implode(', ');
                    }),
                TextColumn::make('subSubcategories')
                    ->label('Sub-Subcategories')
                    ->formatStateUsing(function ($state, TroubleshootCategory $record) {
                        return $record->subcategories
                            ->flatMap(fn($sub) => $sub->subSubcategories)
                            ->pluck('name')
                            ->implode(', ');
                    }),
            ])
            ->defaultSort('name');
    }
}
