<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class CategoryProperty
 * @package App\Models
 */
class CategoryProperty extends Model
{
    use HasFactory;

    const ID = 'id';
    const CATEGORY_ID = 'category_id';
    const NAME = 'name';
    const DESCRIPTION = 'description';
    const TYPE = 'type';
    const VALIDATOR = 'validator';

    const R_PROPERTY_VALUE = 'propertyValues';

    public function propertyValues(): HasOne
    {
        return $this->hasOne(PropertyValue::class, PropertyValue::CATEGORY_PROPERTY_ID);
    }
}
