<?php

namespace App\Filament\Widgets;

use App\Models\GeneralExpense;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;
use Livewire\Attributes\On;

class GeneralExpenseChart extends ChartWidget
{
    protected static ?int $sort = 3;

    protected static ?string $heading = 'General Expense (MMK)';


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

        $data = Trend::model(GeneralExpense::class)
            ->between(
                start: $fromDate,
                end: $toDate,
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
