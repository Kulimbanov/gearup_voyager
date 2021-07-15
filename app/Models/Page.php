<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    const ID = 'id';
    const TITLE = 'title';
    const SLUG = 'slug';
    const BODY = 'body';
    const STATUS = 'status';
    const PARENT_ID = 'parent_id';
}
