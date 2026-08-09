<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'category_id',
        'harga',
        'stok',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'harga' => 'decimal:2',
            'stok' => 'integer',
            'status' => 'boolean',
        ];
    }
    protected function statusLabel(): Attribute
{
    return Attribute::make(
        get: fn () => $this->status ? 'Aktif' : 'Tidak Aktif',
    );
}
public function category()
{
    return $this->belongsTo(Category::class);
}

public function transactionDetails()
{
    return $this->hasMany(TransactionDetail::class);
}
}