<?php

namespace App\Helpers\IsoManagement;

class OfficeMapper{

    // Map office code to full office name
    public static function map(string $code) : string{
        $code = strtoupper(trim($code));
        $mappings = config('offices.mappings');

        // Check if code exists in mappings
        if(array_key_exists($code, $mappings)){
            return $mappings[$code];
        }

        // If not found, throw exception
        throw new \Exception("Invalid originating section code: '{$code}'. Please use valid office codes (e.g., AAC-BED, OOP-ITC).");
    }

    // Check if office code is valid
    public static function isValid(string $code) : bool {
        $code = strtoupper(trim($code));
        return array_key_exists($code, config('offices.mappings'));
    }

    // Get all of the valid office codes
    public static function getAllCodes() : array{
        return array_keys(config('offices.mappings'));
    }
}