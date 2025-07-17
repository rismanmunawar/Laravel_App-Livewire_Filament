<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TroubleshootCategoryResource\Pages;
use App\Filament\Resources\TroubleshootCategoryResource\RelationManagers;
use App\Models\TroubleshootCategory;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TroubleshootCategoryResource extends Resource
{
    protected static ?string $model = TroubleshootCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Troubleshoot Management';
    protected static ?string $navigationLabel = 'Categories';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->placeholder('Name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
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
            'index' => Pages\ListTroubleshootCategories::route('/'),
            'create' => Pages\CreateTroubleshootCategory::route('/create'),
            'edit' => Pages\EditTroubleshootCategory::route('/{record}/edit'),
        ];
    }
}
