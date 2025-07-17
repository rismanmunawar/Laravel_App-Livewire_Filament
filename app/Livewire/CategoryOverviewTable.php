<?php

namespace App\Livewire;

use App\Models\TroubleshootSubSubcategory;
use Livewire\Component;
use Filament\Tables;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Support\Contracts\TranslatableContentDriver;


class CategoryOverviewTable extends Component implements HasTable
{
    use InteractsWithTable;

    public function render()
    {
        return view('livewire.category-overview-table');
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(
                TroubleshootSubSubcategory::query()
                    ->with(['subcategory.category'])
            )
            ->columns([
                TextColumn::make('name')
                    ->label('Sub Subcategory')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('subcategory.name')
                    ->label('Subcategory')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('subcategory.category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),
            ]);
    }

    public function makeFilamentTranslatableContentDriver(): ?TranslatableContentDriver
    {
        return null;
    }
}
