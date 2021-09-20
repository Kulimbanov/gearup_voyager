<?php

namespace App\ENUM;

class ResponseMessages
{
    const PASSWORD_RESET_SEND = 'Password resetting e-mail send successfully';
    const REGISTER_SUCCESS = 'User register successfully';
    const REGISTER_FAIL = 'Register failed! no Auth';
    const LOGIN_SUCCESS = 'User login successfully';
    const LOGIN_FAIL = 'Unauthorized';
    const LOGOUT = 'Successfully logged out';
    const VERIFY_SUCCESS = 'Email verified successfully';
}
