<?php

namespace App\Utils;

use App\Exceptions\AppRuntimeException;

class CharSequenceUtils
{

    /**
     * helper util function generates character sequence
     * @param $currentSequence
     * @return string
     * @throws AppRuntimeException
     */
    public static function nextCharSequence($currentSequence): ?string
    {
        $nextSequence = null;
        $charSet = self::charSet();
        $i = 0;

        if ($currentSequence == 'ZZ') {
            throw new AppRuntimeException("Character sequence has reached it's limit at 'ZZ', a new sequence cannot be generated");
        }

        while ($nextSequence === null) {
            if (strtoupper($currentSequence) === $charSet[$i]) {
                $nextSequence = $charSet[$i + 1];
            }
            $i++;
        }

        return $nextSequence;
    }

    /**
     * helper util function generates character sequence
     * @param $currentSequence
     * @return string
     * @throws AppRuntimeException
     */
    public static function nextChar($currentChar): ?string
    {
        $nextSequence = null;
        $charSet = self::chars();
        $i = 0;

        if ($currentChar == 'Z') {
            throw new AppRuntimeException("Character sequence has reached it's limit at 'Z', a new sequence cannot be generated");
        }

        while ($nextSequence === null) {
            if (strtoupper($currentChar) === $charSet[$i]) {
                $nextSequence = $charSet[$i + 1];
            }
            $i++;
        }

        return $nextSequence;
    }

    public static function charSet(): array
    {
        $char1 = range('A', 'Z');
        $char2 = range('A', 'Z');

        $combinations = [];
        for ($i = 0; $i < count($char1); $i++) {
            for ($j = 0; $j < count($char2); $j++) {
                array_push($combinations, $char1[$i] . $char2[$j]);
            }
        }
        return $combinations;
    }

    public static function chars(): array
    {
        return range('A', 'Z');
    }

    /**
     * @throws AppRuntimeException
     */
    public static function validateCharSequence($charSeq)
    {
        if (strlen($charSeq) !== 2) {
            throw new AppRuntimeException("Character sequence must have 2 characters. '$charSeq' was provided");
        }

        if (!in_array($charSeq, self::charSet())) {
            throw new AppRuntimeException("Unknown character sequence '$charSeq' was provided.");
        }
    }

    /**
     * @throws AppRuntimeException
     */
    public static function validateChar($char)
    {
        if (strlen($char) !== 1) {
            throw new AppRuntimeException("Character sequence must have 1 character. '$char' was provided");
        }

        if (!in_array($char, self::chars())) {
            throw new AppRuntimeException("Unknown character sequence '$char' was provided.");
        }
    }
}
