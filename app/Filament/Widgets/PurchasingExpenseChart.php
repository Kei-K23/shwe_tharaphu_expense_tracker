<?php

namespace App\Filament\Widgets;

use App\Models\PurchasingExpense;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class PurchasingExpenseChart extends ChartWidget
{
    protected static ?int $sort = 4;

    protected static ?string $heading = 'Purchasing Expense (MMK)';

    protected function getData(): array
    {
        $data = Trend::model(PurchasingExpense::class)
            ->between(
                start: now()->subYear(),
                end: now(),
            )
            ->perMonth()
            ->sum('total_cost');

        return [
            'datasets' => [
                [
                    'label' => 'Purchasing Expense',
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
