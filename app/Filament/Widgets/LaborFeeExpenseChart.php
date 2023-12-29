<?php

namespace App\Filament\Widgets;

use App\Models\LaborFeeExpense;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;
use Livewire\Attributes\On;

class LaborFeeExpenseChart extends ChartWidget
{
    protected static ?int $sort = 4;

    protected static ?string $heading = 'Labor Fee (MMK)';


    public Carbon $fromDate;
    public Carbon $toDate;
    // ...
    #[On('updateFromDate')]
    public function updateFromDate(string $from): void
    {
        $this->fromDate = Carbon::parse($from);
        // $this->updateChartData();
    }
    #[On('updateToDate')]
    public function updateToDate(string $to): void
    {
        $this->toDate = Carbon::parse($to);
        // $this->updateChartData();
    }


    protected function getData(): array
    {
        $fromDate = $this->fromDate ?? now()->subYear();
        $toDate = $this->toDate ?? now();

        $data = Trend::model(LaborFeeExpense::class)
            ->between(
                start: $fromDate,
                end: $toDate,
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
