<?php
// Deklarasi namespace untuk model ini
namespace App\Models;

// Import trait dan kelas yang akan digunakan dalam model ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Deklarasi kelas InventarisTransaksi yang merupakan turunan dari Model Eloquent Laravel
class InventarisTransaksi extends Model
{
    // Menggunakan trait HasFactory dan SoftDeletes
    use HasFactory, SoftDeletes;

    // Mendefinisikan bahwa kolom 'foto_data_inventaris' akan diperlakukan sebagai array
    protected $casts = [
        'foto_data_inventaris' => 'array',
    ];

    // Method boot() digunakan untuk mengatur perilaku default saat model dibuat
    protected static function boot()
    {
        parent::boot();

        // Saat model sedang dibuat, method ini memastikan relasi kategori, merk, dan bagian telah di-load
        // Kemudian, kode barang akan digenerate sebelum model disimpan ke database
        static::creating(function ($model) {
            $model->load('kategori', 'merk', 'bagian');
            $model->kode_barang = $model->generateKodeBarang();
        });
    }

    // Method generateKodeBarang() digunakan untuk membuat kode barang unik berdasarkan kategori, merk, dan bagian
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

    // Relasi belongsTo dengan InventarisKategori
    public function kategori()
    {
        return $this->belongsTo(InventarisKategori::class);
    }

    // Relasi belongsTo dengan InventarisMerk
    public function merk()
    {
        return $this->belongsTo(InventarisMerk::class);
    }

    // Relasi belongsTo dengan InventarisSatuan
    public function satuan()
    {
        return $this->belongsTo(InventarisSatuan::class);
    }

    // Relasi belongsTo dengan InventarisBagian
    public function bagian()
    {
        return $this->belongsTo(InventarisBagian::class);
    }

    // Relasi belongsTo dengan InventarisSuplier
    public function suplier()
    {
        return $this->belongsTo(InventarisSuplier::class);
    }

    // Relasi hasOne dengan InventarisPenyusutan
    public function penyusutan()
    {
        return $this->hasOne(InventarisPenyusutan::class);
    }

    // Metode untuk mengubah string menjadi format Proper Case (huruf pertama setiap kata kapital)
    public function setAttributesToProperCase($value)
    {
        return ucwords(strtolower($value));
    }

    public function setNamaDataInventarisAttribute($value)
    {
        $this->attributes['nama_data_inventaris'] = $this->setAttributesToProperCase($value);
    }

    public function setJenisDataInventarisAttribute($value)
    {
        $this->attributes['jenis_data_inventaris'] = $this->setAttributesToProperCase($value);
    }

    public function setKeteranganDataInventarisAttribute($value)
    {
        $this->attributes['keterangan_data_inventaris'] = $this->setAttributesToProperCase($value);
    }
}
