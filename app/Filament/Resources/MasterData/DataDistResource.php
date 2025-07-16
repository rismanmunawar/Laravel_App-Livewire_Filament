<?php

namespace App\Filament\Resources\MasterData;

use App\Filament\Resources\MasterData\DataDistResource\Pages;
use App\Filament\Resources\MasterData\DataDistResource\RelationManagers;
use App\Models\DataDist;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DataDistResource extends Resource
{
    protected static ?string $model = DataDist::class;

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';
    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('branch')->required()->placeholder('Branch'),
                TextInput::make('plant')->required()->placeholder('Plant'),
                TextInput::make('code_dist')->required()->placeholder('Code Dist'),
                TextInput::make('name_dist')->required()->placeholder('Name Dist'),
                TextInput::make('status_dist')->required()->placeholder('status_dist'),
                TextInput::make('channel')->required()->placeholder('Channel'),
                TextInput::make('rom')->required()->placeholder('Rom'),
                TextInput::make('nom')->required()->placeholder('Nom'),
                TextInput::make('region')->required()->placeholder('Region'),
                Select::make('status_plant')->options([
                    1 => 'Active',
                    0 => 'Inactive',
                ])->required()->label('status_plant'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListDataDists::route('/'),
            'create' => Pages\CreateDataDist::route('/create'),
            'edit' => Pages\EditDataDist::route('/{record}/edit'),
        ];
    }
}
