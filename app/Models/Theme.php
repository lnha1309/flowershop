<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $table = 'themes';
    protected $primaryKey = 'theme_id';
    public $timestamps = false;
    protected $fillable = ['theme_name'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_themes', 'theme_id', 'product_id');
    }
}