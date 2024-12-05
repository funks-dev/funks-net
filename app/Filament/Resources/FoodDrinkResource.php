<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FoodDrinkResource\Pages;
use App\Filament\Resources\FoodDrinkResource\RelationManagers;
use App\Models\FoodDrink;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FoodDrinkResource extends Resource
{
    protected static ?string $model = FoodDrink::class;

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required(),

                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->required(),

                Forms\Components\FileUpload::make('image')
                    ->label('Image')
                    ->image()
                    ->directory('food-images')
                    ->required()
                    ->helperText('Upload a new image or leave it blank to keep the old one.')
                    ->afterStateUpdated(function ($state, $get) {
                        // Jika tidak ada gambar baru, tampilkan gambar lama
                        if (!$state && $get('image')) {
                            // Gambar lama diambil dari database dan ditambahkan 'storage/'
                            return asset('storage/' . $get('image'));
                        }
                        return null;
                    }),

                Forms\Components\TextInput::make('price')
                    ->label('Price')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->sortable(),

                Tables\Columns\ImageColumn::make('image')
                    ->square()
                    ->checkFileExistence(false)
                    ->extraImgAttributes(['loading' => 'lazy'])
                    ->getStateUsing(function ($record) {
                        return asset('storage/' . $record->image);
                    }),

                Tables\Columns\TextColumn::make('price')
                    ->sortable(),
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
            'index' => Pages\ListFoodDrinks::route('/'),
            'create' => Pages\CreateFoodDrink::route('/create'),
            'edit' => Pages\EditFoodDrink::route('/{record}/edit'),
        ];
    }
}
