<?php
namespace App\Traits;

use Illuminate\Support\Str;

trait Tokenable
{
    public function generateAndSaveApiAuthToken()
    {
        $token = Str::random(60);
        self::update([
            $this->api_token = $token
        ]);
        return "API_TOKEN=" . $token;
    }
}
