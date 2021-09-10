<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductCategory
 * @package App\Models
 *
 * @property int id
 * @property int partner_id
 * @property string name
 * @property string title
 * @property string slug
 * @property string description
 * @property string image
 */
class ProductCategory extends Model
{
    use HasFactory;

    const ID = 'id';
    const PARENT_ID = 'parent_id';
    const NAME = 'name';
    const TITLE = 'title';
    const SLUG = 'slug';
    const DESCRIPTION = 'description';
    const IMAGE = 'image';
}
