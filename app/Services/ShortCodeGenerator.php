<?php

namespace App\Services;

use App\Models\Link;

class ShortCodeGenerator
{
    public function generate(): string
    {
        $length = (int) config('shortener.code_length');
        $characters = (string) config('shortener.allowed_characters');
        $reservedCodes = config('shortener.reserved_codes', []);

        do {
            $code = $this->randomCode($length, $characters);
        } while (
            in_array($code, $reservedCodes, true) ||
            Link::where('short_code', $code)->exists()
        );

        return $code;
    }

    private function randomCode(int $length, string $characters): string
    {
        $code = '';
        $lastIndex = strlen($characters) - 1;

        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[random_int(0, $lastIndex)];
        }

        return $code;
    }
}
