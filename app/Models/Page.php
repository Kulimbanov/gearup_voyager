<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int parent_id
 * @property string status
 * @property string title
 * @property string sub_title
 * @property string header_image
 * @property string template
 * @property string slug
 * @property string body
 */
class Page extends Model
{
    use HasFactory;

    const ID = 'id';
    const TITLE = 'title';
    const SUB_TITLE = 'sub_title';
    const SLUG = 'slug';
    const BODY = 'body';
    const STATUS = 'status';
    const TEMPLATE = 'template';
    const PARENT_ID = 'parent_id';
}
