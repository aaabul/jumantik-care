<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetsUserPasswords;

class ResetUserPassword implements ResetsUserPasswords
{
    use PasswordValidationRules;

    public function reset($user, array $input): void
    {
        Validator::make($input, [
            'password' => $this->passwordRules(),
        ])->validate();

        // Reset password harus menggunakan Supabase Auth API.
        // Implementasi final memerlukan access token dari proses reset Supabase.
        throw new \RuntimeException(
            'Password reset melalui Supabase Auth belum dikonfigurasi.'
        );
    }
}
