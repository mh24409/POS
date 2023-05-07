<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Product extends Model implements TranslatableContract
{
    use HasFactory, Translatable;
    protected $fillable = ['category_id', 'purchase_price', 'sale_price', 'stock'];
    public $translatedAttributes = ['name', 'description'];
    protected $append = ['profit_percent'];

    public function getProfitPercentAttribute()
    {
        $profit = $this->sale_price - $this->purchase_price;
        return $profit_percent = $profit * 100 / $this->purchase_price;
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_order');
    }
}
