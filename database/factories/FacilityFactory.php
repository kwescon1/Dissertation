<?php

namespace Database\Factories;

use App\Models\Facility;
use Illuminate\Database\Eloquent\Factories\Factory;

class FacilityFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Facility::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->facilityName();

        return [
            'name' =>  $name,
            'code' => strtoupper(substr($name, 0, 3)),
            'status' => 1,
        ];
    }

    /**
     * @return string
     */
    private function facilityName(): string
    {
        $name = $this->faker->randomElement([
            $this->faker->colorName(),
            $this->faker->city(),
        ]);
        $name .= ' ';
        $name .= $this->faker->randomElement([
            'Eye Care Center',
            'Medical & Specialist Clinic',
            'Hospital',
        ]);
        return $name;
    }
}
