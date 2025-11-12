<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    protected $table = 'styles';
    protected $primaryKey = 'style_id';
    public $timestamps = false;
    protected $fillable = ['style_name'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_styles', 'style_id', 'product_id');
    }
}