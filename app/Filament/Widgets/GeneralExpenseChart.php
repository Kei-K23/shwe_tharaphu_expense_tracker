<?php

namespace App\Filament\Widgets;

use App\Models\GeneralExpense;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class GeneralExpenseChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected static ?string $heading = 'General Expense (MMK)';

    protected function getData(): array
    {
        $data = Trend::model(GeneralExpense::class)
            ->between(
                start: now()->subYear(),
                end: now(),
            )
            ->perMonth()
            ->sum('price');

        return [
            'datasets' => [
                [
                    'label' => 'General Expense',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
