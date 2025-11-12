<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlowerType extends Model
{
    protected $table = 'flower_types';
    protected $primaryKey = 'flower_type_id';
    public $timestamps = false;
    protected $fillable = ['flower_type_name'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_flower_types', 'flower_type_id', 'product_id');
    }
}