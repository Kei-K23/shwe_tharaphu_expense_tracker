<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LabourFeeExpenseResource\Pages;
use App\Filament\Resources\LabourFeeExpenseResource\RelationManagers;
use App\Models\LabourFeeExpense;
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

class LabourFeeExpenseResource extends Resource
{
    protected static ?string $model = LabourFeeExpense::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Labours';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('worker_number')
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->numeric()
                    ->gt(0)
                    ->required(),
                Forms\Components\TextInput::make('price')
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
                Tables\Columns\TextColumn::make('worker_number'),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('price'),
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
            'index' => Pages\ListLabourFeeExpenses::route('/'),
            'create' => Pages\CreateLabourFeeExpense::route('/create'),
            'edit' => Pages\EditLabourFeeExpense::route('/{record}/edit'),
        ];
    }
}
