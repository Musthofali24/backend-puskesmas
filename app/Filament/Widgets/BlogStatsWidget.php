<?php

namespace App\Filament\Widgets;

use App\Models\Blog;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BlogStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalBlogs = Blog::count();
        $publishedBlogs = Blog::where('is_published', true)->count();
        $draftBlogs = Blog::where('is_published', false)->count();
        $totalViews = Blog::sum('views_count');
        $publishedPercentage = $totalBlogs > 0 ? round(($publishedBlogs / $totalBlogs) * 100) : 0;

        return [
            Stat::make('Total Blog', $totalBlogs)
                ->description('Semua artikel blog')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary')
                ->chart([7, 12, 15, 18, 22, 25, $totalBlogs]),

            Stat::make('Blog Dipublikasi', $publishedBlogs)
                ->description($publishedPercentage . '% dari total')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->chart([5, 8, 12, 15, 18, 20, $publishedBlogs]),

            Stat::make('Blog Draft', $draftBlogs)
                ->description('Belum dipublikasi')
                ->descriptionIcon('heroicon-m-pencil-square')
                ->color('warning')
                ->chart([2, 4, 3, 3, 4, 5, $draftBlogs]),

            Stat::make('Total Views', number_format($totalViews))
                ->description('Total tayangan blog')
                ->descriptionIcon('heroicon-m-eye')
                ->color('info')
                ->chart([100, 250, 400, 600, 850, 1200, $totalViews]),
        ];
    }
}
