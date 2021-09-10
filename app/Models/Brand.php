<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string description
 * @property string link
 */
class Brand extends Model
{
    const ID = 'id';
    const NAME = 'name';
    const DESCRIPTION = 'description';
    const LINK = 'link';
}
