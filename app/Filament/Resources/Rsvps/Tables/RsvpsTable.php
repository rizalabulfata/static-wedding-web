<?php

namespace App\Filament\Resources\Rsvps\Tables;

use App\Filament\Imports\RsvpImporter;
use App\Models\MessageTemplate;
use App\Models\Rsvp;
use App\Services\WhatsAppService;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ImportAction;
use Filament\Forms\Components\RichEditor;
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
                    ->color(fn(string $state): string => match ($state) {
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
                Action::make('manageTemplate')
                    ->label('Manage Template')
                    ->icon(Heroicon::OutlinedDocumentText)
                    ->color('gray')
                    ->modalHeading('Manage WhatsApp Template')
                    ->fillForm(fn() => [
                        'content' => MessageTemplate::getTemplate('invitation'),
                    ])
                    ->schema([
                        RichEditor::make('content')
                            ->label('Invitation Template')
                            ->helperText('Use {{tamu}} for guest name and {{link}} for invitation link.')
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        MessageTemplate::updateOrCreate(
                            ['key' => 'invitation'],
                            ['content' => $data['content']]
                        );

                        Notification::make()
                            ->title('Template saved successfully')
                            ->success()
                            ->send();
                    }),
                ImportAction::make()
                    ->importer(RsvpImporter::class),
            ])
            ->recordActions([
                Action::make('copyLink')
                    ->label('Copy Link')
                    ->icon(Heroicon::OutlinedClipboard)
                    ->color('info')
                    ->action(function (Rsvp $record, Component $livewire) {
                        $url = url('/') . '?u=' . $record->unique_id;
                        $livewire->dispatch('copy-to-clipboard', text: $url);

                        Notification::make()
                            ->title('Link copied to clipboard')
                            ->success()
                            ->send();
                    })
                    ->extraAttributes(fn(Rsvp $record): array => [
                        'onclick' => "navigator.clipboard.writeText('" . url('/') . '?u=' . $record->unique_id . "')",
                    ]),
                Action::make('sendWhatsApp')
                    ->label('Send WA')
                    ->icon(Heroicon::OutlinedChatBubbleLeftEllipsis)
                    ->color('success')
                    ->disabled(fn(Rsvp $record) => empty($record->phone))
                    ->modalHeading(fn(Rsvp $record) => "Send WhatsApp to {$record->name}")
                    ->modalWidth('lg')
                    ->schema([
                        Textarea::make('message')
                            ->label('Message Content')
                            ->rows(15)
                            ->required()
                            ->live()
                            ->default(function (Rsvp $record) {
                                $template = MessageTemplate::getTemplate('invitation');

                                if (blank($template)) {
                                    $path = base_path('invitation-message.txt');
                                    $template = file_exists($path) ? file_get_contents($path) : 'Halo {{tamu}}, silakan buka undangan Anda di sini: {{link}}';
                                }

                                $template = MessageTemplate::formatForWhatsApp($template);

                                return str_replace(
                                    ['{{tamu}}', '{{link}}'],
                                    [$record->name, url('/') . '?u=' . $record->unique_id],
                                    $template
                                );
                            }),
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
                    })
                    ->extraModalFooterActions([
                        Action::make('openInWhatsApp')
                            ->label('Open in WhatsApp')
                            ->icon(Heroicon::OutlinedArrowTopRightOnSquare)
                            ->color('info')
                            ->url(function (Rsvp $record, array $data, WhatsAppService $service) {
                                $message = $data['message'] ?? null;

                                if (blank($message)) {
                                    $template = MessageTemplate::getTemplate('invitation');
                                    if (blank($template)) {
                                        $path = base_path('invitation-message.txt');
                                        $template = file_exists($path) ? file_get_contents($path) : 'Halo {{tamu}}, silakan buka undangan Anda di sini: {{link}}';
                                    }

                                    $template = MessageTemplate::formatForWhatsApp($template);

                                    $message = str_replace(
                                        ['{{tamu}}', '{{link}}'],
                                        [$record->name, url('/') . '?u=' . $record->unique_id],
                                        $template
                                    );
                                }

                                return $service->getWhatsAppUrl($record->phone, $message);
                            }, true),
                    ]),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('sendBulkWhatsApp')
                        ->label('Send Bulk WA')
                        ->icon(Heroicon::OutlinedChatBubbleLeftEllipsis)
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Send Bulk WhatsApp')
                        ->modalDescription('This will send the invitation message to all selected records using the API.')
                        ->schema([
                            Textarea::make('message_template')
                                ->label('Message Template')
                                ->helperText('Use {{tamu}} for guest name and {{link}} for invitation link.')
                                ->rows(10)
                                ->required()
                                ->default(function () {
                                    $template = MessageTemplate::getTemplate('invitation');

                                    if (blank($template)) {
                                        $path = base_path('invitation-message.txt');
                                        $template = file_exists($path) ? file_get_contents($path) : 'Halo {{tamu}}, silakan buka undangan Anda di sini: {{link}}';
                                    }

                                    return MessageTemplate::formatForWhatsApp($template);
                                }),
                        ])
                        ->action(function (Collection $records, array $data, WhatsAppService $service) {
                            $successCount = 0;
                            foreach ($records as $record) {
                                if (! $record->phone) {
                                    continue;
                                }

                                $message = str_replace(
                                    ['{{tamu}}', '{{link}}'],
                                    [$record->name, url('/') . '?u=' . $record->unique_id],
                                    $data['message_template']
                                );

                                if ($service->sendMessage($record->phone, $message)) {
                                    $successCount++;
                                }
                            }

                            Notification::make()
                                ->title("Successfully sent {$successCount} messages")
                                ->success()
                                ->send();
                        }),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
