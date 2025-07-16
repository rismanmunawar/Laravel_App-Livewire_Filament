<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\RelationManagers;
use App\Models\Member;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Member Name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('designation')
                    ->label('Designation')
                    ->required()
                    ->maxLength(255),
                TextInput::make('fb_url')
                    ->url()
                    ->label('Facebook URL')
                    ->nullable()
                    ->maxLength(255),
                TextInput::make('lk_url')
                    ->url()
                    ->label('LinkedIn URL')
                    ->nullable()
                    ->maxLength(255),
                TextInput::make('ig_url')
                    ->url()
                    ->label('Instagram URL')
                    ->nullable()
                    ->maxLength(255),
                FileUpload::make('image')
                    ->label('Profile Image')
                    ->image()
                    ->disk('public')
                    ->directory('members')
                    ->nullable()
                    ->maxSize(1024) // 1MB
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif'])
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('status')
                    ->label('Status')
                    ->default(true)
                    ->inline(false)
                    ->required()
                    ->onColor('success')
                    ->offColor('danger')
                    ->helperText('Toggle to activate or deactivate the member.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->disk('public') // <-- Ini cukup!
                    ->width(100),
                TextColumn::make('name'),
                TextColumn::make('designation'),
                TextColumn::make('status')
                    ->label('Status')
                    ->getStateUsing(function (Member $record) {
                        return $record->status ? 'Active' : 'Inactive';
                    })
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
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}
