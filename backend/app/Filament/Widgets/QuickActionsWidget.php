<?php

namespace App\Filament\Widgets;

use App\Models\Commission;
use App\Models\Lead;
use App\Models\OcrJob;
use Filament\Widgets\Widget;

class QuickActionsWidget extends Widget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 1;
    protected static string $view = 'filament.widgets.quick-actions';

    public function getViewData(): array
    {
        return [
            'ocrPending'        => OcrJob::where('status', 'review_requested')->count(),
            'commissionsDue'    => Commission::where('status', 'due')->count(),
            'leadsOnHold'       => Lead::where('status', 'on_hold')->count(),
            'visaProcessing'    => Lead::where('status', 'visa_processing')->count(),
        ];
    }
}
