<?php

namespace App\ENUM;

class ResponseMessages
{
    const REGISTER_SUCCESS = 'User register successfully';
    const LOGIN_SUCCESS = 'User login successfully';
    const PASSWORD_RESET_SEND = 'Password resetting e-mail send successfully';
    const LOGIN_FAIL = 'Unauthorized';
    const LOGOUT = 'Successfully logged out';
}
