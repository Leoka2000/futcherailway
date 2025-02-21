<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentApproved;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('status')
                    ->options([
                        'unpaid' => 'Unpaid',
                        'paid' => 'Paid',
                        'under_process' => 'Under Process',
                    ])
                    ->required()
                    ->label('Order Status')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('user.name')->label('Customer'),
                Tables\Columns\TextColumn::make('quantity')->sortable(),
                Tables\Columns\TextColumn::make('unit_price')->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'unpaid' => '<span class="inline-flex items-center rounded-md bg-red-100 px-2 py-1 text-xs font-medium text-red-800 border border-red-400">Ainda não pago ❌ 🖕</span>',
                        'under_process' => '<span class="inline-flex items-center rounded-md bg-red-100 px-2 py-1 text-xs font-medium text-red-800 border border-red-400">Em processo 🙄🙏</span>',
                        'paid' => '<span class="inline-flex items-center rounded-md bg-green-100 px-2 py-1 text-xs font-medium text-green-800 border border-green-400">PAGO! ✅ 🙌</span>',
                    })
                    ->html()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('changeStatus')
                    ->label('Change Status')
                    ->requiresConfirmation()
                    ->action(function (Order $record) {
                        $previousStatus = $record->status;
                        $newStatus = $previousStatus === 'paid' ? 'unpaid' : 'paid';
                        $record->update(['status' => $newStatus]);

                        if ($previousStatus === 'unpaid' && $newStatus === 'paid') {
                            Mail::to($record->user->email)->send(new PaymentApproved($record));
                        }
                    })
                    ->color(fn(Order $record) => $record->status === 'paid' ? 'danger' : 'success'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
