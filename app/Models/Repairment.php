<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property float price
 * @property string description
 * @property string slug
 */
class Repairment extends Model
{
    const ID = 'id';
    const NAME = 'name';
    const PRICE = 'price';
    const DESCRIPTION = 'description';
    const SLUG = 'slug';

    public $timestamps = false;
}
