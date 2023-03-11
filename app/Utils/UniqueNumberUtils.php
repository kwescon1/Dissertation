<?php


namespace App\Utils;


class UniqueNumberUtils
{
    /**
     * helper util function generates unique number sequence
     * @return string
     */
    public static function generate($charSequence,  $numSequence): string
    {
        return $charSequence . str_pad($numSequence, 6, '0', STR_PAD_LEFT);
    }
}
