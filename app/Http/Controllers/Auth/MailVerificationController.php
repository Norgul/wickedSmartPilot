<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MailVerificationController extends Controller
{
    public function verify(Request $request, $signature, User $user)
    {
        if ($user->verifySignature($signature)) {
            $user->verifyAccount();

            $message       = 'Account Verified Kindly Login';
            $messageStatus = 'success';
        } else {
            $messageStatus = 'danger';
            $message       = 'Invalid Request';
        }

        $request->session()->flash('message', $message);
        $request->session()->flash('message_status', $messageStatus);

        return redirect()->route('login');
    }
}
