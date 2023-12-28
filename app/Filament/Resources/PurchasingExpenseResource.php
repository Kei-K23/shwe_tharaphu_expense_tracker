<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchasingExpenseResource\Pages;
use App\Filament\Resources\PurchasingExpenseResource\RelationManagers;
use App\Models\PurchasingExpense;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PurchasingExpenseResource extends Resource
{
    protected static ?string $model = PurchasingExpense::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('item_name')
                    ->minLength(1)
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->gt(0),
                Forms\Components\TextInput::make('unit_price')
                    ->gt(0),
                Forms\Components\TextInput::make('total_cost')
                    ->gt(0)
                    ->required(),
                Forms\Components\Textarea::make('description')
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
            'index' => Pages\ListPurchasingExpenses::route('/'),
            'create' => Pages\CreatePurchasingExpense::route('/create'),
            'edit' => Pages\EditPurchasingExpense::route('/{record}/edit'),
        ];
    }
}
