<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Facility;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $firstname = $this->faker->firstName();
        $lastname = $this->faker->lastName();
        return [
            'facility_id' => function () {
                return Facility::factory()->create()->id;
            },
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $this->makeUserEmail($firstname, $lastname),
            'phone' => $this->faker->numerify('23354#######'),
            'username' => $this->makeUsername($firstname, $lastname),
            'password' => Hash::make($this->makeUserPassword($firstname, $lastname)),
            'position' => $this->faker->word(10),
            'status' => 1,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    private function makeUserEmail($firstname, $lastname)
    {
        return strtolower("{$firstname}.{$lastname}@example.org");
    }

    private function makeUsername(string $firstname, string $lastname)
    {
        return strtolower("{$firstname}.{$lastname}");
    }

    private function makeUserPassword(string $firstname, string $lastname)
    {
        return strtolower("{$firstname}.{$lastname}");
    }
}
