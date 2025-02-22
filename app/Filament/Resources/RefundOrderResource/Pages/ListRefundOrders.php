<?php

namespace App\Filament\Resources\RefundOrderResource\Pages;

use App\Filament\Resources\RefundOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRefundOrders extends ListRecords
{
    protected static string $resource = RefundOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
