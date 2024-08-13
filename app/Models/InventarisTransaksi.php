<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventarisTransaksi extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'foto_data_inventaris' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Pastikan relasi telah di-load sebelum generate kode
            $model->load('kategori', 'merk', 'bagian');

            // Generate kode barang
            $model->kode_barang = $model->generateKodeBarang();
        });
    }

    public function generateKodeBarang()
    {
        // Mengambil inisial dari kategori, merk, dan bagian
        $kategoriInisial = substr($this->kategori->nama_kategori, 0, 3);
        $merkInisial = substr($this->merk->nama_merk, 0, 3);
        $bagianInisial = substr($this->bagian->nama_bagian, 0, 3);

        // Mendapatkan kode barang terakhir berdasarkan kategori, merk, dan bagian
        $lastKode = self::where('kategori_id', $this->kategori_id)
            ->where('merk_id', $this->merk_id)
            ->where('bagian_id', $this->bagian_id)
            ->orderBy('kode_barang', 'desc')
            ->first();

        // Menentukan nomor urut berikutnya
        $lastNumber = $lastKode ? intval(substr($lastKode->kode_barang, -4)) : 0;
        $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);

        // Menghasilkan kode barang
        return strtoupper($kategoriInisial . $merkInisial . $bagianInisial . $newNumber);
    }

    public function kategori()
    {
        return $this->belongsTo(InventarisKategori::class);
    }

    public function merk()
    {
        return $this->belongsTo(InventarisMerk::class);
    }

    public function satuan()
    {
        return $this->belongsTo(InventarisSatuan::class);
    }

    public function bagian()
    {
        return $this->belongsTo(InventarisBagian::class);
    }

    public function suplier()
    {
        return $this->belongsTo(InventarisSuplier::class);
    }

    public function penyusutan()
    {
        return $this->hasOne(InventarisPenyusutan::class);
    }
}
