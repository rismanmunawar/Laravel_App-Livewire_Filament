<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TroubleshootSubcategoryResource\Pages;
use App\Filament\Resources\TroubleshootSubcategoryResource\RelationManagers;
use App\Models\TroubleshootSubcategory;
use App\Models\TroubleshootCategory;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TroubleshootSubcategoryResource extends Resource
{
    protected static ?string $model = TroubleshootSubcategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder-open';
    protected static ?string $navigationGroup = 'Troubleshoot Management';
    protected static ?string $navigationLabel = 'Sub Categories';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->placeholder('Name'),
                Select::make('category_id')->label('Category')->options(TroubleshootCategory::all()->pluck('name', 'id')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('category.name')->searchable()->sortable(),
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
            'index' => Pages\ListTroubleshootSubcategories::route('/'),
            'create' => Pages\CreateTroubleshootSubcategory::route('/create'),
            'edit' => Pages\EditTroubleshootSubcategory::route('/{record}/edit'),
        ];
    }
}
