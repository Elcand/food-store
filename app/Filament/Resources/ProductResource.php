<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Category;
use App\Models\Product;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        FileUpload::make('image')
                            ->label('Product Image')
                            ->placeholder('Product Image')
                            ->required(),

                        TextInput::make('title')
                            ->label('Product Title')
                            ->placeholder('PRoduct Title')
                            ->required(),

                        Grid::make(3)
                            ->schema([
                                Select::make('category_id')
                                    ->label('Category')
                                    ->relationship('category', 'name')
                                    ->required(),

                                TextInput::make('price')
                                    ->label('Price')
                                    ->placeholder('Price')
                                    ->required(),

                                TextInput::make('weight')
                                    ->label('Weight')
                                    ->placeholder('Weight')
                                    ->required(),
                            ]),

                        RichEditor::make('description')
                            ->label('Product Description')
                            ->placeholder('Product Description')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->circular(),

                TextColumn::make('title')
                    ->searchable(),

                TextColumn::make('category.name')
                    ->searchable(),

                TextColumn::make('price')
                    ->numeric(decimalPlaces: 0)
                    ->money('IDR', locale: 'id'),

                TextColumn::make('description')
                    ->html()
                    ->limit(50)
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getNavigationSort(): ?int
    {
        return 2;
    }
}
