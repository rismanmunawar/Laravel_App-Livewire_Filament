<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TroubleshootTopicResource\Pages;
use App\Filament\Resources\TroubleshootTopicResource\RelationManagers;
use App\Models\TroubleshootTopic;
use Filament\Forms;
use App\Models\TroubleshootCategory;
use App\Models\TroubleshootSubcategory;
use App\Models\TroubleshootSubSubcategory;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TroubleshootTopicResource extends Resource
{
    protected static ?string $model = TroubleshootTopic::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Troubleshoot Management';
    protected static ?string $navigationLabel = 'Topics';


    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('category_id')
                ->label('Category')
                ->options(\App\Models\TroubleshootCategory::pluck('name', 'id'))
                ->required()
                ->searchable()
                ->reactive()
                ->afterStateUpdated(fn(callable $set) => $set('subcategory_id', null)),

            Forms\Components\Select::make('subcategory_id')
                ->label('Subcategory')
                ->options(function (callable $get) {
                    $categoryId = $get('category_id');
                    return $categoryId
                        ? \App\Models\TroubleshootSubcategory::where('category_id', $categoryId)->pluck('name', 'id')
                        : [];
                })
                ->searchable()
                ->reactive()
                ->disabled(fn(callable $get) => !$get('category_id'))
                ->afterStateUpdated(fn(callable $set) => $set('sub_subcategory_id', null)),

            Forms\Components\Select::make('sub_subcategory_id')
                ->label('Sub Subcategory')
                ->options(function (callable $get) {
                    $subcategoryId = $get('subcategory_id');
                    return $subcategoryId
                        ? \App\Models\TroubleshootSubSubcategory::where('subcategory_id', $subcategoryId)->pluck('name', 'id')
                        : [];
                })
                ->searchable()
                ->disabled(fn(callable $get) => !$get('subcategory_id')),

            Forms\Components\TextInput::make('title')
                ->label('Title')
                ->required(),

            Forms\Components\RichEditor::make('content')
                ->label('Content')
                ->required(),

            Forms\Components\TextInput::make('video_url')
                ->label('Video URL')
                ->url()
                ->nullable(),
        ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('subSubcategory.name') // relasi camelCase dari method subSubcategory()
                    ->label('Sub Subcategory')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('subcategory.name')
                    ->label('Subcategory')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListTroubleshootTopics::route('/'),
            'create' => Pages\CreateTroubleshootTopic::route('/create'),
            'edit' => Pages\EditTroubleshootTopic::route('/{record}/edit'),
            'overview' => Pages\CategoryOverview::route('/category-overview'),
        ];
    }
}
