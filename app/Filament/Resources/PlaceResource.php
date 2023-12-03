<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlaceResource\Pages;
use App\Filament\Resources\PlaceResource\RelationManagers;
use App\Models\User;
use App\Models\Place;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\Livewire\TemporaryUploadedFile;
use Livewire;
use Auth;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;


class PlaceResource extends Resource
{
    protected static ?string $model = Place::class;

    protected static ?string $navigationIcon = 'heroicon-o-location-marker';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Fieldset::make('File')
                ->relationship('file')
                ->saveRelationshipsWhenHidden()
                ->schema([
                    Forms\Components\FileUpload::make('filepath')
                        ->required()
                        ->image()
                        ->maxSize(2048)
                        ->directory('uploads')
                        ->getUploadedFileNameForStorageUsing(function (Livewire\TemporaryUploadedFile $file): string {
                            return time() . '_' . $file->getClientOriginalName();
                        }),
                ]),

            Forms\Components\Fieldset::make('Place ')
            ->schema([
                Forms\Components\Hidden::make('file_id'),
                Select::make('author_id')
                ->default(auth()->user()->id)
                ->options(User::all()->pluck('name', 'id'))
                ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                RichEditor::make('description')
                    ->required()
                    ->maxLength(255),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('file_id')->translateLabel(),
                Tables\Columns\TextColumn::make('author_id')->translateLabel(),
                Tables\Columns\TextColumn::make('name')->translateLabel(),
                Tables\Columns\TextColumn::make('description')->translateLabel(),
                Tables\Columns\TextColumn::make('created_at')->translateLabel()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->translateLabel()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('visibility_id')->translateLabel(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPlaces::route('/'),
            'create' => Pages\CreatePlace::route('/create'),
            'view' => Pages\ViewPlace::route('/{record}'),
            'edit' => Pages\EditPlace::route('/{record}/edit'),
        ];
    }    
}

    
    

