<?php

namespace App\Filament\Resources\Rsvps\Tables;

use App\Filament\Imports\RsvpImporter;
use App\Models\Rsvp;
use App\Services\WhatsAppService;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ImportAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Collection;
use Livewire\Component;

class RsvpsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('attendance')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'hadir' => 'success',
                        'tidak hadir' => 'danger',
                    })
                    ->searchable(),
                TextColumn::make('guests')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                ImportAction::make()
                    ->importer(RsvpImporter::class),
            ])
            ->recordActions([
                Action::make('copyLink')
                    ->label('Copy Link')
                    ->icon(Heroicon::OutlinedClipboard)
                    ->color('info')
                    ->action(function (Rsvp $record, Component $livewire) {
                        $url = url('/').'?u='.$record->unique_id;
                        $livewire->dispatch('copy-to-clipboard', text: $url);

                        Notification::make()
                            ->title('Link copied to clipboard')
                            ->success()
                            ->send();
                    })
                    ->extraAttributes(fn (Rsvp $record): array => [
                        'onclick' => "navigator.clipboard.writeText('".url('/').'?u='.$record->unique_id."')",
                    ]),
                Action::make('sendWhatsApp')
                    ->label('Send WA')
                    ->icon(Heroicon::OutlinedChatBubbleLeftEllipsis)
                    ->color('success')
                    ->schema([
                        Textarea::make('message')
                            ->required()
                            ->default(fn (Rsvp $record) => "Halo *{$record->name}*, kami mengundang Anda ke pernikahan Rizal & Mila. Silakan buka undangan Anda di sini: ".url('/').'?u='.$record->unique_id),
                    ])
                    ->action(function (Rsvp $record, array $data, WhatsAppService $service) {
                        if (! $record->phone) {
                            Notification::make()
                                ->title('Phone number missing')
                                ->danger()
                                ->send();

                            return;
                        }

                        if ($service->sendMessage($record->phone, $data['message'])) {
                            Notification::make()
                                ->title('WhatsApp message sent')
                                ->success()
                                ->send();
                        } else {
                            Notification::make()
                                ->title('Failed to send WhatsApp message')
                                ->danger()
                                ->send();
                        }
                    }),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('sendBulkWhatsApp')
                        ->label('Send Bulk WA')
                        ->icon(Heroicon::OutlinedChatBubbleLeftEllipsis)
                        ->color('success')
                        ->schema([
                            Textarea::make('message')
                                ->required()
                                ->placeholder('Gunakan [name] untuk menyisipkan nama tamu dan [link] untuk link undangan.')
                                ->default('Halo *[name]*, kami mengundang Anda ke pernikahan Rizal & Mila. Silakan buka undangan Anda di sini: [link]'),
                        ])
                        ->action(function (Collection $records, array $data, WhatsAppService $service) {
                            $successCount = 0;
                            foreach ($records as $record) {
                                if (! $record->phone) {
                                    continue;
                                }

                                $message = str_replace(
                                    ['[name]', '[link]'],
                                    [$record->name, url('/').'?u='.$record->unique_id],
                                    $data['message']
                                );

                                if ($service->sendMessage($record->phone, $message)) {
                                    $successCount++;
                                }
                            }

                            Notification::make()
                                ->title("Sent {$successCount} WhatsApp messages")
                                ->success()
                                ->send();
                        }),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
