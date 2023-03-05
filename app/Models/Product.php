<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'enable',
    ];

    public function category()
    {
        return $this->belongsToMany(Category::class,'category_products');
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'product_images');
    }
}
