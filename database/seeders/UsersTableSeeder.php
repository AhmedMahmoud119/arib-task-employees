<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $department = Department::create([
            'name' => 'egneering'
        ]);

        $users = [
            [
                'fname' => 'admin',
                'lname' => 'test',
                'email' => 'admin@admin.com',
                'phone' => '01021119521',
                'email_verified_at' => now(),
                'password' => bcrypt('secret'),
                'salary' => 200,
                'image' => null,
                'manager_id' => null,
                'department_id' => $department->id,
                'remember_token' => null,
            ]
        ];

        User::insert($users);
    }
}
