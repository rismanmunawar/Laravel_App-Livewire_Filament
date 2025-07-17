<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TroubleshootSubSubcategoryResource\Pages;
use App\Filament\Resources\TroubleshootSubSubcategoryResource\RelationManagers;
use App\Models\TroubleshootSubSubcategory;
use App\Models\TroubleshootSubcategory;
use Filament\Forms\Components\Select;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TroubleshootSubSubcategoryResource extends Resource
{
    protected static ?string $model = TroubleshootSubSubcategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';
    protected static ?string $navigationGroup = 'Troubleshoot Management';
    protected static ?string $navigationLabel = 'Sub Sub Categories';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('category_id')
                ->label('Category')
                ->options(\App\Models\TroubleshootCategory::pluck('name', 'id'))
                ->required()
                ->reactive()
                ->afterStateUpdated(fn(callable $set) => $set('subcategory_id', null)),

            Select::make('subcategory_id')
                ->label('Subcategory')
                ->options(
                    fn(callable $get) =>
                    $get('category_id')
                        ? \App\Models\TroubleshootSubcategory::where('category_id', $get('category_id'))->pluck('name', 'id')->toArray()
                        : []
                )
                ->required()
                ->reactive()
                ->disabled(fn(callable $get) => !$get('category_id')),

            TextInput::make('name')
                ->label('Sub Subcategory Name')
                ->required(),
        ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('category.name')->searchable()->sortable(),
                TextColumn::make('subcategory.name')->searchable()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTroubleshootSubSubcategories::route('/'),
            'create' => Pages\CreateTroubleshootSubSubcategory::route('/create'),
            'edit' => Pages\EditTroubleshootSubSubcategory::route('/{record}/edit'),
        ];
    }
}
