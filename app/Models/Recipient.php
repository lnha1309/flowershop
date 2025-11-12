<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    protected $table = 'recipients';
    protected $primaryKey = 'recipient_id';
    public $timestamps = false;
    protected $fillable = ['recipient_name'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_recipients', 'recipient_id', 'product_id');
    }
}