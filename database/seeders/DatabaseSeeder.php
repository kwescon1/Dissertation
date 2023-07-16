<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Facility;
use App\Models\FacilityBranch;
use Illuminate\Database\Seeder;
use App\Models\UserFacilityBranch;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create facility
        echo "Creating facility \n";
        $facility = Facility::factory()->create();

        //seed default user
        echo "creating default user instance \n";
        $defaultUser = $this->defaultUser([
            'facility_id' => $facility->id,
            'firstname' => 'Soonleh',
            'lastname' => 'Ling',
            'email' => 'soonleh.ling@example.org',
            'username' => 'soonleh.ling',
            'password' => \Illuminate\Support\Facades\Hash::make('soonleh.ling')
        ]);


        echo "Creating facility branches\n";
        FacilityBranch::factory()
            ->state([
                'facility_id' => $facility->id
            ])
            ->create()
            ->each(function ($facilityBranch) use ($facility, $defaultUser) {

                //set head branch
                if ($this->setBranchAsHeadBranch($facility->id)) {
                    $facilityBranch->update(['is_head_branch' => true]);
                }

                //seed facility branch for default user
                echo "creating default user facility branch \n";
                $defaultUserFacilityBranch = $this->userFacilityBranch([
                    'user_id' => $defaultUser->id,
                    'facility_id' => $facility->id,
                    'facility_branch_id' => $facilityBranch->id
                ]);

                // get role created from facility branch observer
                $role = Role::whereFacilityBranchId($facilityBranch->id)->first();

                //assign role to default user in facility branch
                echo "assigning role to default user in facility branch \n";
                $defaultUserFacilityBranch->assignRole($role);


                //seed two users
                echo "creating other users \n";
                User::factory()->count(2)
                    ->state([
                        'facility_id' => $facility->id
                    ])->create()
                    ->each(function ($user) use ($facility, $facilityBranch) {
                        echo "creating user facility branch \n";

                        $userFacilityBranch = $this->userFacilityBranch([
                            'user_id' => $user->id,
                            'facility_id' => $facility->id,
                            'facility_branch_id' => $facilityBranch->id
                        ]);
                    });
            });
    }

    private static function defaultUser($userData = [])
    {
        return  User::factory()->state($userData)->create();
    }

    private static function userFacilityBranch($data = [])
    {
        return UserFacilityBranch::factory()->state($data)->create();
    }

    private static function setBranchAsHeadBranch($facilityId): bool
    {
        return !FacilityBranch::where("facility_id", $facilityId)->where(['is_head_branch' => true])->exists();
    }
}
