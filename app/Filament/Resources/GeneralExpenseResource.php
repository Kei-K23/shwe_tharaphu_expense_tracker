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

    protected static ?string $navigationLabel = 'General';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->minLength(1)
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->gt(0)
                    ->required(),
                Forms\Components\Textarea::make('description'),
                Forms\Components\DatePicker::make('created_at')
                    ->maxDate(now())
                    ->default(now()),
                Forms\Components\Select::make('general_expense_types_id')
                    ->relationship('generalExpenseType', 'name')
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
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('description')
                    ->placeholder('No description.'),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->label('Date'),
                Tables\Columns\TextColumn::make('generalExpenseType.name'),
            ])
            ->filters([
                //
            ])
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
            'index' => Pages\ListGeneralExpenses::route('/'),
            'create' => Pages\CreateGeneralExpense::route('/create'),
            'edit' => Pages\EditGeneralExpense::route('/{record}/edit'),
        ];
    }
}
