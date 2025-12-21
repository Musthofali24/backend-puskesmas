<?php

namespace App\Filament\Widgets;

use App\Models\Blog;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class BlogsChart extends ChartWidget
{
    protected ?string $heading = 'Blog per Kategori';
    protected ?string $description = 'Distribusi blog berdasarkan kategori';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $categories = [
            'berita-kesehatan' => 'Berita Kesehatan',
            'promosi-kesehatan' => 'Promosi Kesehatan',
            'artikel-kesehatan' => 'Artikel Kesehatan',
            'kegiatan-puskesmas' => 'Kegiatan Puskesmas',
        ];

        $data = [];
        $labels = [];
        $colors = [];
        $colorMap = [
            'berita-kesehatan' => '#cf7cb2',
            'promosi-kesehatan' => '#61cade',
            'artikel-kesehatan' => '#0cab9c',
            'kegiatan-puskesmas' => '#f59e0b',
        ];

        foreach ($categories as $key => $label) {
            $count = Blog::where('category', $key)->count();
            $labels[] = $label;
            $data[] = $count;
            $colors[] = $colorMap[$key];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Blog',
                    'data' => $data,
                    'backgroundColor' => $colors,
                    'borderColor' => $colors,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
