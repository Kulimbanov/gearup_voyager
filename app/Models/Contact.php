<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contact
 * @package App\Models
 * @mixin Builder
 */
class Contact extends Model
{
    use HasFactory;

    const ID = 'id';
    const NAME = 'name';
    const EMAIL = 'email';
    const PHONE = 'phone';
    const SUBJECT = 'subject';
    const MESSAGE = 'message';

    public $fillable = ['name', 'email', 'phone', 'subject', 'message'];
}
