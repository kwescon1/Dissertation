<?php

namespace Database\Factories;

use App\Models\Role;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //default admin role

            'id' => Uuid::uuid6(),
            'name' => "Administrator",
            'description' => "Role manages facility",
            'guard_name' => 'api',
            'facility_branch_id' => ''
        ];
    }
}
