<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentApproved;
use Filament\Notifications\Notification;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function beforeSave(): void
    {
        // Get the current status before saving
        $previousStatus = $this->record->status;

        // Get the new status from the form data
        $newStatus = $this->data['status'];

        // Check if the status is being changed from "unpaid" to "paid"
        if ($previousStatus === 'unpaid' && $newStatus === 'paid') {
            // Send the email
            Mail::to($this->record->user->email)->send(new PaymentApproved($this->record));

            // Show a success notification
            Notification::make()
                ->title('Payment Approved')
                ->body('An email has been sent to the user notifying them of the payment approval.')
                ->success()
                ->send();
        }
    }

    protected function getSaveFormAction(): Actions\Action
    {
        return parent::getSaveFormAction()
            ->requiresConfirmation() // Add a confirmation modal before saving
            ->modalHeading('Confirm Changes')
            ->modalDescription('Are you sure you want to save these changes?')
            ->modalSubmitActionLabel('Yes, save changes');
    }
}
