<?php

namespace App\Filament\Resources\ParkingReportResource\Widgets;

use App\Models\ParkingReport;
use Carbon\Carbon;
use Filament\Widgets\BarChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ParkingReportChart extends BarChartWidget
{
    protected static ?string $heading = 'Pengguna Parkir/Hari';

    public ?string $filter = 'week';

    protected function getFilters(): ?array
    {
        return [
            'week' => 'Mingguan',
            'month' => 'Bulanan',
        ];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;

        if($activeFilter == 'week') {
            $data = Trend::model(ParkingReport::class)
            ->between(
                start: now()->subWeek()->startOfWeek(),
                end: now()->endOfDay(),
            )
            ->perDay()
            ->count();
        }

        if($activeFilter == 'month') {
            $data = Trend::model(ParkingReport::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();
        }
            
        return [
            'datasets' => [
                [
                    'label' => 'Pengguna Parkir',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => ['#FFC300', '#FF6384', '#4BC0C0', '#FF9F40', '#36A2EB', '#FFCE56', '#8C88FF', '#00CECB']

                ],
            ],
            'labels' => $data->map(function (TrendValue $value) {
                $date = Carbon::parse($value->date);
                if ($this->filter == 'week') {
                    return $date->format('j F Y'); // Format dengan tanggal
                } else {
                    return $date->format('F Y'); // Format tanpa tanggal
                }
            }),
        ];
    }

    protected static ?array $options = [
        'plugins' => [
            'legend' => [
                'display' => false,
            ],
        ],
        'scales' => [
            'y' => [
                'ticks' => [
                    'stepSize' => 1
                ]
            ]
        ]
    ];

}
