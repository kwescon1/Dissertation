<?php

namespace Tests\Unit\Utilities;

use PHPUnit\Framework\TestCase;
use App\Exceptions\AppRuntimeException;
use App\Utils\ClientNumberUtils;

class GenerateNhsNumberTest extends TestCase
{

    const FACILITY_CODE = 'YSJ';
    const FACILITY_BRANCH_CODE = '2K';
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @param $input
     * @param $expected
     * @dataProvider provides_test_generate_input
     * @throws AppRuntimeException
     */
    public function test_generate_input($input, $expected)
    {
        $this->assertEquals($expected, ClientNumberUtils::generate(self::FACILITY_CODE, self::FACILITY_BRANCH_CODE, $input));
    }

    public function provides_test_generate_input(): array
    {
        $facilityCode = 'YSJ';
        $facilityBranchCode = '2K';

        return [
            'when-number-is-first' => [
                '10001',
                ClientNumberUtils::make($facilityCode, $facilityBranchCode, '10002')
            ],
            'when-number-is-fifth' => [
                '10005',
                ClientNumberUtils::make($facilityCode, $facilityBranchCode, '10006')
            ],
            'when-number-is-twentieth' => [
                '10020',
                ClientNumberUtils::make($facilityCode, $facilityBranchCode, '10021')
            ],
        ];
    }

    /**
     * @param $input
     * @throws AppRuntimeException
     * @dataProvider provides_test_generate_when_input_nhs_number_is_not_valid_should_return_error
     */
    public function test_generate_when_input_nhs_number_is_not_valid_should_return_error($input)
    {
        $this->expectException(AppRuntimeException::class);
        ClientNumberUtils::generate(self::FACILITY_CODE, self::FACILITY_BRANCH_CODE, $input);
    }

    public function provides_test_generate_when_input_nhs_number_is_not_valid_should_return_error(): array
    {
        return [
            'when-uniquenhsnumber-is-strlen-is-less-than-expected' => [
                '1000',
            ],

            'when-numseq-is-not-a-number' => [
                'GXL00100',
            ],
        ];
    }
}
