<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use NumberFormatter;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'price_discount',
        'available',
        'image_thumbnail',
        'images',
        'description',
        'category',
        'user_id',
        'shop_id',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity')->withTimestamps();
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value;
    }

    // Accessor for retrieving price in currency format for index view
    public function getPriceAttribute($value)
    {
        // Check if the request is coming from an index view
        if (request()->routeIs('product.index')) {
            $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
            return $formatter->formatCurrency($value, 'IDR');
        }

        // Return the price as-is for other views
        return $value;
    }
}
