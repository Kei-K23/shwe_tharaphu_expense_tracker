<?php

namespace App\Filament\Widgets;

use App\Models\GeneralExpense;
use App\Models\LaborFeeExpense;
use App\Models\PurchasingExpense;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;
use Livewire\Attributes\On;

class TotalExpenseOverview extends BaseWidget
{
    protected static ?int $sort = 2;


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

    protected function getStats(): array
    {
        $fromDate = $this->fromDate ?? now()->subYear();
        $toDate = $this->toDate ?? now();

        $totalGeneralExpense = GeneralExpense::whereBetween('created_at', [$fromDate, $toDate])->sum('price');
        $totalLaborExpense = LaborFeeExpense::whereBetween('created_at', [$fromDate, $toDate])->sum('price');
        $totalPurchaseExpense = PurchasingExpense::whereBetween('created_at', [$fromDate, $toDate])->sum('total_cost');


        return [
            Stat::make('General (MMK)', $totalGeneralExpense),
            Stat::make('Labor Fee (MMK)', $totalLaborExpense),
            Stat::make('Purchasing (MMK)', $totalPurchaseExpense)
        ];
    }
}
