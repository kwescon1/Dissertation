<?php

namespace Database\Factories;

use App\Models\Facility;
use Illuminate\Support\Str;
use App\Models\FacilityBranch;
use Illuminate\Database\Eloquent\Factories\Factory;

class FacilityBranchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FacilityBranch::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $branchName = $this->faker->colorName();

        return [
            'facility_id' => function () {
                return Facility::factory()->create()->id;
            },
            'name' => $branchName,
            'code' => strtoupper(Str::random(2)),
            'is_head_branch' => false,
            'email' => $this->makeBranchEmail($branchName),
            'phone' => config('twilio.twilio_number'),
            'status' => 1,
            'address' => $this->faker->address(),
            'country' => "GH",
        ];
    }

    private function makeBranchEmail($branchName)
    {
        return strtolower("{$branchName}.branch@example.org");
    }
}
