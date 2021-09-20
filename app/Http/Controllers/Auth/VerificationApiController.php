<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationApiController extends Controller
{
    use VerifiesEmails;

    private UsersApiController $usersApiController;

    public function __construct(UsersApiController $usersApiController)
    {
        $this->usersApiController = $usersApiController;
    }

    public function show()
    {
    }

    public function verify(Request $request)
    {

        logger('VerificationApiController');
        $userID = $request['id'];
        $user = User::findOrFail($userID);
        $user->email_verified_at = strtotime(now()); // to enable the “email_verified_at field of that user be a current time stamp by mimicing the must verify email feature
        $user->save();
        $userA = new Registered($user);

        Auth::login($userA->user);
        $this->usersApiController->login();

        return redirect(route('home'));
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json('User already have verified email!', 422);
            // return redirect($this->redirectPath());
        }
        $request->user()->sendEmailVerificationNotification();

        return response()->json('The notification has been resubmitted');
        // return back()->with('resent', true);
    }
}
