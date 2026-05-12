<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\PipelineChartWidget;
use App\Filament\Widgets\QuickActionsWidget;
use App\Filament\Widgets\RecentLeadsWidget;
use App\Filament\Widgets\TensaiStatsOverview;

class Dashboard extends \Filament\Pages\Dashboard
{
    public function getColumns(): int | string | array
    {
        return 3;
    }

    public function getWidgets(): array
    {
        return [
            TensaiStatsOverview::class,
            PipelineChartWidget::class,
            QuickActionsWidget::class,
            RecentLeadsWidget::class,
        ];
    }
}
