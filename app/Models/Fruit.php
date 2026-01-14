<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fruit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'unit',        // kg / pcs
        'stock',       // stok dalam kg atau pcs
        'avg_weight',  // berat rata-rata per buah (kg) khusus pcs
        'image',
        'category_id',
    ];

    protected $casts = [
        'price' => 'float',
        'stock' => 'float',
        'avg_weight' => 'float',
    ];

    // Relasi ke kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Helper: cek apakah buah dijual per KG
     */
    public function isKg()
    {
        return $this->unit === 'kg';
    }

    /**
     * Helper: cek apakah buah dijual per PCS
     */
    public function isPcs()
    {
        return $this->unit === 'pcs';
    }

    /**
     * Helper: format harga tampil
     */
    public function formattedPrice()
    {
        if ($this->unit === 'kg') {
            return 'Rp ' . number_format($this->price) . ' / kg';
        }

        return 'Rp ' . number_format($this->price) . ' / buah (± ' . $this->avg_weight . ' kg)';
    }
}
