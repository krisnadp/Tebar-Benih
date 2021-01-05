<?php

use App\Status;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\CaraKerja\Entities\Way;
use Modules\Project\Entities\Project;
use Modules\Project\Entities\ProjectCategory;
use Modules\Project\Entities\ProjectStatus;
use Modules\User\Entities\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        Role::create([
            'name' => 'Administrator'
        ]);

        Role::create([
            'name' => 'Member'
        ]);

        Status::create([
            'name' => 'Active'
        ]);

        Status::create([
            'name' => 'Inactive'
        ]);

        ProjectStatus::create([
            'name' => 'Started'
        ]);
        ProjectStatus::create([
            'name' => 'On-Going'
        ]);
        ProjectStatus::create([
            'name' => 'Finished'
        ]);

        ProjectCategory::create([
            'name' => 'Pertanian'
        ]);
        ProjectCategory::create([
            'name' => 'Perkebunan'
        ]);
        ProjectCategory::create([
            'name' => 'Peternakan'
        ]);

        for($i=1; $i<=10; $i++){
            Project::create([
                'project_status_id' => 1,
                'project_category_id' => 1,
                'name' => 'Project '. $i,
                'description' => 'Project Description '. $i,
                'price' => 1000000,
                'periode' => 12,
                'profit' => 25,
                'stock' => 50
            ]);
        }

        User::create([
            'name' => 'Admin',
            'last_name' => 'Tebar Benih',
            'email' => 'admin@tebar.id',
            'password' => Hash::make('password'),
            'role_id' => 1
        ]);

        User::create([
            'name' => 'Member',
            'last_name' => 'Tebar Benih',
            'email' => 'member@tebar.id',
            'password' => Hash::make('password'),
            'role_id' => 2
        ]);

        Way::create([
            'title' => "Satu"
        ]);

    }
}
