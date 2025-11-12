<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	// Table name
	protected $table = 'products';

	// Primary key
	protected $primaryKey = 'product_id';

	// No timestamps on this table
	public $timestamps = false;

	protected $fillable = [
		'name',
		'description',
		'size',
		'wrapping',
		'care',
		'price',
		'image_url',
		'is_visible',
	];

	protected $casts = [
		'price' => 'decimal:2',
		'is_visible' => 'boolean',
	];

	// Provide $product->id alias for product_id
	public function getIdAttribute()
	{
		return $this->product_id;
	}

	// Full image URL accessor
	public function getImageUrlFullAttribute()
	{
		if ($this->image_url) {
			return asset($this->image_url);
		}
		return asset('images/placeholder.png');
	}

	// Scope visible products
	public function scopeVisible($query)
	{
		return $query->where('is_visible', true);
	}

	// Search scope
	public function scopeSearch($query, $keyword)
	{
		return $query->where('name', 'LIKE', "%{$keyword}%")
					 ->orWhere('description', 'LIKE', "%{$keyword}%");
	}

	// Relationships
	public function themes()
	{
		return $this->belongsToMany(
			Theme::class,
			'product_themes',
			'product_id',
			'theme_id'
		);
	}

	public function recipients()
	{
		return $this->belongsToMany(
			Recipient::class,
			'product_recipients',
			'product_id',
			'recipient_id'
		);
	}

	public function styles()
	{
		return $this->belongsToMany(
			Style::class,
			'product_styles',
			'product_id',
			'style_id'
		);
	}

	public function flowerTypes()
	{
		return $this->belongsToMany(
			FlowerType::class,
			'product_flower_types',
			'product_id',
			'flower_type_id'
		);
	}

	public function occasions()
	{
		return $this->belongsToMany(
			Occasion::class,
			'product_occasions',
			'product_id',
			'occasion_id'
		);
	}
}