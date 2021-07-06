<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    const ID = 'id';
    const PARENT_ID = 'parent_id';
    const NAME = 'name';
    const SLUG = 'slug';
    const DESCRIPTION = 'descriptions';
    const IMAGE = 'image';
}
