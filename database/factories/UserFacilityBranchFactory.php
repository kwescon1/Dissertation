<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Facility;
use App\Models\FacilityBranch;
use App\Models\UserFacilityBranch;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFacilityBranchFactory extends Factory
{
    protected $model = UserFacilityBranch::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'facility_id' => function () {
                return Facility::factory()->create()->id;
            },
            'facility_branch_id' => function () {
                return FacilityBranch::factory()->create()->id;
            },
            'last_login_at' => Carbon::now()
        ];
    }
}
