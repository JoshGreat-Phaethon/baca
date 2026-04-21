<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'name',
        'author',
        'tanggal_terbit',
        'category',
        'genre',
    ];
    public function bukus()
    {
        return $this->hasMany(Buku::class,'user_id','user_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','user_id');
    }


}
