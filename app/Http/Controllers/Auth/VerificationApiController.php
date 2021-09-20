<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\IUserService;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

class VerificationApiController extends Controller
{
    use VerifiesEmails;

    private UsersApiController $usersApiController;
    private IUserService $userService;

    public function __construct(UsersApiController $usersApiController, IUserService $userService)
    {
        $this->usersApiController = $usersApiController;
        $this->userService = $userService;
    }

    public function show()
    {
        return view('page.auth.verified');
    }

    public function verify(Request $request)
    {
        $response = $this->userService->verifyEmail($request['id']);

        return view('page.auth.verified')->with([
            'page' => $response,
        ]);
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
