<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create data user
        $userCreate = User::create([
            'name' => 'Medi Hermanto Tinambunan',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
        ]);

        // assign permission to role
        $role = Role::find(1);
        $permissions = Permission::all();

        $role->syncPermissions($permissions);

        // assign role with permission to user
        $user = User::find(1);
        $user->assignRole($role->name);
    }
}
