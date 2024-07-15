<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Order extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'orders';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const PENGIRIMAN = [
        'jnt' => 'JNT',
        'jne' => 'JNE',
        'sicepat' => 'sicepat',
    ];

    public const STATUS = [
        'terbayar' => 'Terbayar',
        'belum terbayar' => 'Belum Terbayar',
        'pending' => 'Pending', // Add this status if not already present
        'selesai' => 'Selesai',
    ];

    protected $fillable = [
        'name',
        'email',
        'no_telepon',
        'alamat',
        'product_id',
        'pengiriman',
        'total',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
