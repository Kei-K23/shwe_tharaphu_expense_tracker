<?php

namespace App\Filament\Widgets;

use App\Models\LaborFeeExpense;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class LaborFeeExpenseChart extends ChartWidget
{
    protected static ?int $sort = 3;

    protected static ?string $heading = 'Labor Fee (MMK)';



    protected function getData(): array
    {
        $data = Trend::model(LaborFeeExpense::class)
            ->between(
                start: now()->subYear(),
                end: now(),
            )
            ->perMonth()
            ->sum('price');

        return [
            'datasets' => [
                [
                    'label' => 'Labor Expense',
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
