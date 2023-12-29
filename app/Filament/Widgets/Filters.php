<?php

namespace App\Filament\Widgets;

use Filament\Forms\Components\Actions;
use Filament\Forms\Form;
use Filament\Forms\Components\Grid;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Widgets\Widget;

class Filters extends Widget implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'filament.widgets.filters';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 1;

    public ?array $data = [];

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Grid::make()
                    ->schema([
                        DatePicker::make('from')
                            ->live()
                            ->afterStateUpdated(fn (?string $state) => $this->dispatch('updateFromDate', from: $state)),
                        DatePicker::make('to')
                            ->live()
                            ->afterStateUpdated(fn (?string $state) => $this->dispatch('updateToDate', to: $state)),
                    ]),
            ]);
    }

    protected function getFormActions(): array
    {
        return array_merge(
            parent::getFormActions(),
            [
                Actions\Action::make('clear')
                    ->action(function () {
                        //
                    })
            ],
        );
    }
}
