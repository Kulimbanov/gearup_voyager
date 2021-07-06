<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    const ID = 'id';
    const PARENT_ID = 'parent_id';
    const USER_ID = 'user_id';
    const CATEGORY_ID = 'category_id';
    const NAME = 'name';
    const SLUG = 'slug';
    const DESCRIPTION = 'descriptions';
    const IMAGE = 'image';

    const R_PRODUCT_PROPERTIES = 'productProperties';

    public function productProperties(): HasMany
    {
        return $this->hasMany(PropertyValue::class, PropertyValue::PRODUCT_ID);
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
