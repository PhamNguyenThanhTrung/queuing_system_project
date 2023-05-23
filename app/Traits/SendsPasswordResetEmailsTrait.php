<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;

trait SendsPasswordResetEmailsTrait
{


public function sendResetLinkEmailTrait(Request $request)
{
    $this->validateEmail($request);

    $email = $request->input('email');

    $user = DB::table('members')->where('email', $email)->first();

    if (!$user) {
        return $this->sendResetLinkFailedResponse($request, trans('passwords.user'));
    }
     else {
        return $this->sendResetLinkEmail($request);

    }
    

    $response = $this->broker()->sendResetLink($request->only('email'));

    return $response == Password::RESET_LINK_SENT
        ? $this->sendResetLinkResponse($response)
        : $this->sendResetLinkFailedResponse($request, $response);
}

    protected function broker()
    {
        return Password::broker();
    }


    protected function validateEmail(Request $request)
{
    $request->validate([
        // 'email' => 'required|email',
        'email' => 'required|unique:password_reset_tokens,"email"',
    ], [
        'email.required' => 'Bạn cần nhập địa chỉ email.',
        'email.email' => 'Địa chỉ email không hợp lệ.',
    ]);
}

}
