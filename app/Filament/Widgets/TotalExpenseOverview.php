<?php

namespace App\Filament\Widgets;

use App\Models\GeneralExpense;
use App\Models\LaborFeeExpense;
use App\Models\PurchasingExpense;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalExpenseOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalGeneralExpense = 0;
        $generalExpense = GeneralExpense::pluck('price');

        foreach ($generalExpense as $price) {
            $totalGeneralExpense += $price;
        }

        $totalLaborExpense = 0;
        $laborExpense = LaborFeeExpense::pluck('price');

        foreach ($laborExpense as $price) {
            $totalLaborExpense += $price;
        }

        $totalPurchaseExpense = 0;
        $purchaseExpense = PurchasingExpense::pluck('total_cost');

        foreach ($purchaseExpense as $price) {
            $totalPurchaseExpense += $price;
        }

        return [
            Stat::make('General (MMK)', $totalGeneralExpense),
            Stat::make('Labor Fee (MMK)', $totalLaborExpense),
            Stat::make('Purchasing (MMK)', $totalPurchaseExpense)
        ];
    }
}
