<?php

namespace App\Filament\Resources\Blogs\Widgets;

use App\Models\Blog;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BlogOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalBlogs = Blog::count();
        $publishedBlogs = Blog::where('is_published', true)->count();
        $draftBlogs = Blog::where('is_published', false)->count();
        $totalViews = Blog::sum('views_count');
        $avgViews = $totalBlogs > 0 ? round($totalViews / $totalBlogs) : 0;

        // Stats per category
        $beritaKesehatan = Blog::where('category', 'berita-kesehatan')->count();
        $promosiKesehatan = Blog::where('category', 'promosi-kesehatan')->count();
        $artikelKesehatan = Blog::where('category', 'artikel-kesehatan')->count();
        $kegiatanPuskesmas = Blog::where('category', 'kegiatan-puskesmas')->count();

        return [
            Stat::make('Total Blog', $totalBlogs)
                ->description('Semua artikel blog')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),

            Stat::make('Blog Dipublikasi', $publishedBlogs)
                ->description('Artikel yang sudah tayang')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Blog Draft', $draftBlogs)
                ->description('Belum dipublikasi')
                ->descriptionIcon('heroicon-m-pencil-square')
                ->color('warning'),

            Stat::make('Total Views', number_format($totalViews))
                ->description('Rata-rata: ' . number_format($avgViews) . ' views/artikel')
                ->descriptionIcon('heroicon-m-eye')
                ->color('info'),

            Stat::make('Berita Kesehatan', $beritaKesehatan)
                ->description('Kategori berita')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('primary'),

            Stat::make('Promosi Kesehatan', $promosiKesehatan)
                ->description('Kategori promosi')
                ->descriptionIcon('heroicon-m-megaphone')
                ->color('secondary'),

            Stat::make('Artikel Kesehatan', $artikelKesehatan)
                ->description('Kategori artikel')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('success'),

            Stat::make('Kegiatan Puskesmas', $kegiatanPuskesmas)
                ->description('Kategori kegiatan')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('warning'),
        ];
    }
}
