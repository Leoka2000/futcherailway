<?php

namespace App\Filament\Resources\RefundOrderResource\Pages;

use App\Filament\Resources\RefundOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRefundOrder extends EditRecord
{
    protected static string $resource = RefundOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
