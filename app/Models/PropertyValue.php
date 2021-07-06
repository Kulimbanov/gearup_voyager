<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyValue extends Model
{
    use HasFactory;

    const ID = 'id';
    const PRODUCT_ID = 'product_id';
    const CATEGORY_PROPERTY_ID = 'category_property_id';
    const VALUE = 'value';

    const R_CATEGORY_PROPERTY = 'category_properties';
    const R_PRODUCT = 'product';

    protected $fillable = [
        self::PRODUCT_ID,
        self::CATEGORY_PROPERTY_ID,
        self::VALUE
    ];

    public function category_properties()
    {
        return $this->belongsTo(CategoryProperty::class, $this::CATEGORY_PROPERTY_ID);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class, $this::PRODUCT_ID);
    }

}
