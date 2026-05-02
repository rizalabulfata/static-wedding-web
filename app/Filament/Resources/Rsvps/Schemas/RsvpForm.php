<?php

namespace App\Filament\Resources\Rsvps\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RsvpForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                Select::make('attendance')
                    ->options([
                        'hadir' => 'Hadir',
                        'tidak hadir' => 'Tidak Hadir',
                    ])
                    ->required()
                    ->default('hadir'),
                TextInput::make('guests')
                    ->required()
                    ->numeric()
                    ->default(1)
                    ->minValue(1),
                Textarea::make('note')
                    ->columnSpanFull(),
            ]);
    }
}
