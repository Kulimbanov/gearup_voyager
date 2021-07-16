<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

/**
 * Class Product
 * @package App\Models
 * @property int id
 * @property string name
 * @property string slug
 * @property string descriptions
 * @property float price
 * @property string image
 */
class Product extends Model
{
    use HasFactory;

    const ID = 'id';
    const NAME = 'name';
    const SLUG = 'slug';
    const DESCRIPTION = 'descriptions';
    const PRICE = 'price';
    const IMAGE = 'image';
    const USER_ID = 'user_id';
    const CATEGORY_ID = 'category_id';
    const BRAND_ID = 'brand_id';

    const R_PRODUCT_PROPERTIES = 'productProperties';
    const R_PRODUCT_CATEGORY = 'productCategory';
    const R_BRANDS = 'brands';

    public function productProperties(): HasMany
    {
        return $this->hasMany(PropertyValue::class, PropertyValue::PRODUCT_ID);
    }

    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class,'category_id','id');
    }

    public function brands(): BelongsToMany
    {
        return $this->belongsToMany(Brand::class,'product_in_brand','brand_id','product_id');
    }

    public function save(array $options = [])
    {
        // If no owner has been assigned, assign the current user's id as the owner of the workstation
        if (!$this->user_id && Auth::user()) {
            $this->user_id = Auth::user()->getAuthIdentifier();
        }

        return parent::save();
    }
}
