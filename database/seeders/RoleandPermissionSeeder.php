<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleandPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'users:view']);
        Permission::create(['name' => 'users:edit']);
        Permission::create(['name' => 'users:create']);
        Permission::create(['name' => 'users:delete']);

        $adminRole = Role::create(['name' => 'Admin']);
        $adminRole->givePermissionTo(Permission::all());

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'ikhsanmajid@gmail.com',
            'password' => Hash::make('12345678')
        ]);

        $admin->assignRole($adminRole);
    }
}
