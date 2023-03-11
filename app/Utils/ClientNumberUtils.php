<?php


namespace App\Utils;


use App\Exceptions\AppRuntimeException;

class ClientNumberUtils
{

    const STRLEN_UNIQUE_CLIENT_NUMBER = 5;

    /**
     *client numbers are 13 characters
     *chars 1-3 represent the Facility Account Code ex: "ABC" for "ABC Hospital". 
     *only uppercase alphabets  (A-Z) can be used
     *this is stored in the accounts table as code
     *chars 4-5 represent the Branch Code ex. "99" for the Tema branch of ABC Hospital
     *this can be any uppercase A-Z, 0-9 characters
     *this is stored in the accounts_branch table as code
     *chars 6-7 is the last 2 digits of the year the client was registered ex. "21" for year 2021
     *char 8 '-' is a separator
     *chars 9-13 represent the client number
     *this is a sequential number starting at 10001 for each branch account
     *numbering continues in a new year; it does not reset at the beginning of a new year 
     *
     * @param $facilityCode
     * @param $facilityBranchCode
     * @param $currentUniqueClientNumber
     * @return string
     * @throws AppRuntimeException
     */
    public static function generate($facilityCode, $facilityBranchCode, $currentUniqueClientNumber): string
    {
        self::validateUniqueClientNumber($currentUniqueClientNumber);

        $nextNumSeq = $currentUniqueClientNumber + 1;

        return self::make($facilityCode, $facilityBranchCode, $nextNumSeq);
    }


    /**
     * @param $facilityCode
     * @param $facilityBranchCode
     * @param $uniqueClientNumber
     * @return string
     */
    public static function make($facilityCode, $facilityBranchCode, $uniqueClientNumber): string
    {
        return "{$facilityCode}{$facilityBranchCode}" . date('y') . "-{$uniqueClientNumber}";
    }

    /**
     * @param $clientNumber
     * @return mixed|string
     */
    public static function extractUniqueClientNumber($clientNumber)
    {
        return explode('-', $clientNumber)[1];
    }



    /**
     * @throws AppRuntimeException
     */
    private static function validateUniqueClientNumber($uniqueClientNumber): void
    {

        if (!is_numeric($uniqueClientNumber)) {
            throw new AppRuntimeException("Numeric sequence for the unique record number must be a number, $uniqueClientNumber was provided");
        }

        if (strlen($uniqueClientNumber) < self::STRLEN_UNIQUE_CLIENT_NUMBER) {
            throw new AppRuntimeException("Client Unique number should not be less than " . self::STRLEN_UNIQUE_CLIENT_NUMBER . "characters. " . strlen($uniqueClientNumber) . " was provided");
        };
    }
}
