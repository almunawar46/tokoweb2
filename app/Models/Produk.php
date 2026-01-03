<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    public $timestamps = true;
    protected $table = "produk";
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   // app/Models/Produk.php

public function fotoProduk()
{
    // Pastikan nama model dan foreign key-nya sesuai (produk_id)
    return $this->hasMany(FotoProduk::class, 'produk_id');
}
}
