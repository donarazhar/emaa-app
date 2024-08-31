<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\KasKecilTransaksi;
use Illuminate\Support\Facades\DB;

class KasKecilStats extends BaseWidget
{

    public static function canView(): bool
    {
        return request()->routeIs('filament.admin.resources.kas-kecil-transaksis.index');
    }

    protected function getStats(): array
    {
        // Mendapatkan data awal pembentukan
        $pembentukan = KasKecilTransaksi::where('kategori', 'pembentukan')
            ->sum('jumlah');

        // Mendapatkan bulan dan tahun saat ini
        $bulanini = date('m');
        $tahunini = date('Y');

        // Mendapatkan data pengeluaran bulan ini
        $pengeluaranbulanini = KasKecilTransaksi::where('kategori', 'pengeluaran')
            ->whereMonth('tgl_transaksi', $bulanini)
            ->whereYear('tgl_transaksi', $tahunini)
            ->sum('jumlah');

        // Mendapatkan data pengisian bulan ini yang tidak null atau 0
        $pengisianbulanini = KasKecilTransaksi::where('kategori', 'pengisian')
            ->whereNotNull('pengisian_id')
            ->where('pengisian_id', '!=', 0)
            ->whereMonth('tgl_transaksi', $bulanini)
            ->whereYear('tgl_transaksi', $tahunini)
            ->sum('jumlah');

        // Mendapatkan saldo berjalan
        $saldoberjalan = DB::table('kas_kecil_transaksis')
            ->select(
                DB::raw('COALESCE(SUM(CASE WHEN kategori = "pembentukan" THEN jumlah ELSE 0 END), 0) AS total_pembentukan'),
                DB::raw('COALESCE(SUM(CASE WHEN kategori = "pengisian" AND pengisian_id IS NOT NULL AND pengisian_id != 0 THEN jumlah ELSE 0 END), 0) AS total_pengisian'),
                DB::raw('COALESCE(SUM(CASE WHEN kategori = "pengeluaran" THEN jumlah ELSE 0 END), 0) AS total_pengeluaran'),
                DB::raw('COALESCE(SUM(CASE WHEN kategori = "pembentukan" THEN jumlah ELSE 0 END), 0) + 
        COALESCE(SUM(CASE WHEN kategori = "pengisian" AND pengisian_id IS NOT NULL AND pengisian_id != 0 THEN jumlah ELSE 0 END), 0) - 
        COALESCE(SUM(CASE WHEN kategori = "pengeluaran" THEN jumlah ELSE 0 END), 0) AS total_result')
            )
            ->first();


        return [
            Stat::make('Pembentukan Kas', 'Rp ' . number_format($pembentukan, 0, ',', ','))
                ->description('Awal pembentukan kas')
                ->icon('heroicon-m-credit-card')
                ->color('success'),

            Stat::make('Pengeluaran Kas', 'Rp ' . number_format($pengeluaranbulanini, 0, ',', ','))
                ->description('Pengeluaran bulan ini')
                ->icon('heroicon-m-banknotes')
                ->color('danger'),

            Stat::make('Pengisian Kas', 'Rp ' . number_format($pengisianbulanini, 0, ',', ','))
                ->description('Pengisian bulan ini')
                ->icon('heroicon-m-arrow-trending-up')
                ->color('primary'),

            Stat::make('Saldo Berjalan', 'Rp ' . number_format($saldoberjalan->total_result, 0, ',', ','))
                ->description('Saldo saat ini')
                ->icon('heroicon-m-calculator')
                ->color('warning'),
        ];
    }
}
