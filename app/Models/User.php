<?php
// Deklarasi namespace untuk model ini
namespace App\Models;

// Import trait dan kelas yang akan digunakan dalam model ini
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Relations\HasMany;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

// Deklarasi kelas User yang merupakan turunan dari Authenticatable Laravel
// Kelas ini mengimplementasikan interface FilamentUser dan HasAvatar untuk mendukung fitur Filament
class User extends Authenticatable implements FilamentUser, HasAvatar
{
    // Menggunakan trait HasFactory, Notifiable, HasRoles, dan HasPanelShield
    // HasFactory: Untuk memungkinkan pembuatan instance model menggunakan factory
    // Notifiable: Untuk memungkinkan pengiriman notifikasi kepada pengguna
    // HasRoles: Untuk mengelola peran dan izin pengguna menggunakan Spatie Permissions
    // HasPanelShield: Untuk mengelola izin panel Filament
    use HasFactory, Notifiable, HasRoles, HasPanelShield;

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'roles_id',
        'avatar_url',
    ];

    /**
     * Atribut yang harus disembunyikan untuk serialisasi.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Mendapatkan atribut yang harus di-cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi one-to-many dengan model Marbot
    // Setiap user dapat memiliki banyak Marbot terkait, dihubungkan melalui kolom email_user
    public function marbots(): HasMany
    {
        return $this->hasMany(Marbot::class, 'email_user', 'email');
    }

    // Mengimplementasikan metode getFilamentAvatarUrl untuk mendapatkan URL avatar pengguna
    // Jika avatar_url ada, metode ini mengembalikan URL yang dibangun menggunakan Storage facade
    // Jika tidak, mengembalikan null
    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url ? Storage::url("$this->avatar_url") : null;
    }
}
