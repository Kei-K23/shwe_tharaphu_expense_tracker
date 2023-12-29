<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchasingExpenseResource\Pages;
use App\Filament\Resources\PurchasingExpenseResource\RelationManagers;
use App\Models\PurchasingExpense;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PurchasingExpenseResource extends Resource
{
    protected static ?string $model = PurchasingExpense::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Purchase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('item_name')
                    ->minLength(1)
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->numeric()
                    ->gt(0),
                Forms\Components\TextInput::make('unit_price')
                    ->numeric()
                    ->prefix('MMK')
                    ->prefix('MMK')
                    ->gt(0),
                Forms\Components\TextInput::make('total_cost')
                    ->numeric()
                    ->prefix('MMK')
                    ->gt(0)
                    ->required(),
                Forms\Components\Textarea::make('description'),
                Forms\Components\DatePicker::make('created_at')
                    ->maxDate(now())
                    ->default(now()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('item_name'),
                Tables\Columns\TextColumn::make('unit_price'),
                Tables\Columns\TextColumn::make('total_cost'),
                Tables\Columns\TextColumn::make('description')
                    ->placeholder('No description.'),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->label('Date'),
            ])
            ->filters(
                [
                    Filter::make('created_at')
                        ->form([
                            DatePicker::make('start_from'),
                            DatePicker::make('until')
                        ])
                        ->query(function (Builder $query, array $data): Builder {
                            return $query
                                ->when(
                                    $data['start_from'],
                                    fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date)
                                )
                                ->when(
                                    $data['until'],
                                    fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date)
                                );
                        })
                ],
                layout: FiltersLayout::AboveContent
            )
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
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
