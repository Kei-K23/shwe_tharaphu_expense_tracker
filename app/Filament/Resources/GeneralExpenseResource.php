<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GeneralExpenseResource\Pages;
use App\Filament\Resources\GeneralExpenseResource\RelationManagers;
use App\Models\GeneralExpense;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GeneralExpenseResource extends Resource
{
    protected static ?string $model = GeneralExpense::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->minLength(1)
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->gt(0)
                    ->required(),
                Forms\Components\Textarea::make('description'),
                Forms\Components\Select::make('general_expense_types_id')
                    ->relationship('owner', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->maxLength(255)
                            ->required(),
                    ])
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('date_of_birth'),
                Tables\Columns\TextColumn::make('owner.name'),
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
            'index' => Pages\ListGeneralExpenses::route('/'),
            'create' => Pages\CreateGeneralExpense::route('/create'),
            'edit' => Pages\EditGeneralExpense::route('/{record}/edit'),
        ];
    }
}
