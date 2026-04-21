<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; // Posisikan HasApiTokens di depan biar enak dibaca

    protected $fillable = [
        'name',
        'email',
        'password',
        // 'password_confirmation', <- Hapus ini karena tidak ada kolomnya di DB
    ];

    // ... (hidden & casts tetep sama)

    public function bukus(): HasMany
    {
        // Secara standar: 'user_id' adalah foreign key di tabel bukus
        return $this->hasMany(Buku::class, 'user_id');
    }
}
    
  

