<?php

namespace App\Helpers;

class TextHelper
{
    public static function removeDiacritics($string)
    {
        $diacritics = [
            'ș' => 's', 'ț' => 't', 'ă' => 'a', 'â' => 'a', 'î' => 'i',
            'Ș' => 'S', 'Ț' => 'T', 'Ă' => 'A', 'Â' => 'A', 'Î' => 'I',
        ];

        return strtr($string, $diacritics);
    }
}
