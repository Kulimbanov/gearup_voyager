<?php

namespace App\Models;

use App\Notifications\VerifyApiEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use TCG\Voyager\Models\User as VoyagerUser;

/**
 * Class User
 * @package App\Models
 * @mixin Builder
 *
 * @property string name
 * @property string email
 * @property string password
 * @property string email_verified_at
 */
class User extends VoyagerUser implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    const ID = 'id';
    const NAME = 'name';
    const EMAIL = 'email';
    const PASSWORD = 'password';
    const EMAIL_VERIFIED_AT = 'email_verified_at';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token'
    ];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //
    //public function handle(Registered $event)
    //{
    //    if ($event->user instanceof MustVerifyEmail && ! $event->user->hasVerifiedEmail()) {
    //        $event->user->sendEmailVerificationNotification();
    //    }
    //}
    //public function sendApiEmailVerificationNotification()
    //{
    //    $this->notify(new VerifyApiEmail()); // my notification
    //}
}
