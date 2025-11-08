<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Http;

class RecaptchaHelper
{
    /**
     * Validate reCAPTCHA response
     *
     * @param string $recaptchaResponse
     * @return bool
     */
    public static function validateRecaptcha($recaptchaResponse)
    {
        if (empty($recaptchaResponse)) {
            return false;
        }

        $secretKey = env('RECAPTCHA_SECRET_KEY');
        
        if (empty($secretKey)) {
            return false;
        }

        try {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $secretKey,
                'response' => $recaptchaResponse,
                'remoteip' => request()->ip(),
            ]);

            $result = $response->json();

            return isset($result['success']) && $result['success'] === true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
