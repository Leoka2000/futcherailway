<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RefundOrderResource\Pages;
use App\Models\RefundOrder;
use App\Mail\RefundOrderMail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Mail;

class RefundOrderResource extends Resource
{
    protected static ?string $model = RefundOrder::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('order_hashed_id')->label('Order Hashed ID')->required(),
                Forms\Components\TextInput::make('email')->label('Email')->email(),
                Forms\Components\Textarea::make('refund_reason')->label('Refund Reason'),
                Forms\Components\TextInput::make('refund_pix_key')->label('Refund Pix Key'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_hashed_id')->label('Order Hashed ID')->searchable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->searchable(),
                Tables\Columns\TextColumn::make('refund_reason')->label('Refund Reason')->limit(50),
                Tables\Columns\TextColumn::make('refund_pix_key')->label('Refund Pix Key')->limit(30),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('refund_user')
                    ->label('Refund User')
                    ->modalHeading('Confirm Refund')
                    ->modalDescription('Are you sure you want to refund this user? An email notification will be sent.')
                    ->modalSubmitActionLabel('Yes, Refund')
                    ->modalCancelActionLabel('Cancel')
                    ->action(fn(RefundOrder $record) => self::sendRefundEmail($record)),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function sendRefundEmail(RefundOrder $record)
    {
        if ($record->email) {
            Mail::to($record->email)->send(new RefundOrderMail($record));
        }
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRefundOrders::route('/'),
            'create' => Pages\CreateRefundOrder::route('/create'),
            'edit' => Pages\EditRefundOrder::route('/{record}/edit'),
        ];
    }
}
