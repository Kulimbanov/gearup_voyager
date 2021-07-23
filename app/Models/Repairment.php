<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Repairment extends Model
{
    const ID = 'id';
    const NAME = 'name';
    const PRICE = 'price';
    const DESCRIPTION = 'descriptions';
    const SLUG = 'slug';

    public $timestamps = false;
}
