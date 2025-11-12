<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Occasion extends Model
{
    protected $table = 'occasions';
    protected $primaryKey = 'occasion_id';
    public $timestamps = false;
    protected $fillable = ['occasion_name'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_occasions', 'occasion_id', 'product_id');
    }
}
