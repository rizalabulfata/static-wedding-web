<?php

namespace App\Filament\Resources\Comments\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CommentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Textarea::make('comment')
                    ->required()
                    ->maxLength(1000)
                    ->columnSpanFull(),
                Toggle::make('is_visible')
                    ->required()
                    ->default(true),
            ]);
    }
}
