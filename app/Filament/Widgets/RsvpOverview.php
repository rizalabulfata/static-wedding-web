<?php

namespace App\Filament\Widgets;

use App\Models\Rsvp;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RsvpOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Hadir', Rsvp::where('attendance', 'hadir')->count())
                ->description('Jumlah konfirmasi hadir')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
            Stat::make('Tidak Hadir', Rsvp::where('attendance', 'tidak hadir')->count())
                ->description('Jumlah konfirmasi tidak hadir')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
            Stat::make('Total Tamu', Rsvp::where('attendance', 'hadir')->sum('guests'))
                ->description('Total tamu yang akan datang')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),
        ];
    }
}
