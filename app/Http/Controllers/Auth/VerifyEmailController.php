<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    /**
     * Verifica o e-mail do usuário quando ele clica no link enviado.
     */
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill(); // marca o e-mail como verificado
        return redirect('/dashboard'); // para onde o usuário vai após a verificação
    }

    /**
     * Reenvia o link de verificação.
     */
    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Link de verificação enviado!');
    }
}
