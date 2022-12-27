<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        // create permissions
        $admin = Permission::create(['name' => 'super_admin', 'guard_name' => 'admin']);
        $vendor = Permission::create(['name' => 'vendor', 'guard_name' => 'vendor']);
        $user = Permission::create(['name' => 'customer', 'guard_name' => 'web']);

        // create roles and assign existing permissions
        /* Super Admin */
        $role1 = Role::create(['name' => 'admin', 'guard_name' => 'admin']);
        $role1->givePermissionTo($admin);

        /* Vendor Type */
        $role2 = Role::create(['name' => 'vendor', 'guard_name' => 'vendor']);
        $role2->givePermissionTo($vendor);

        /* Customer */
        $role3 = Role::create(['name' => 'user', 'guard_name' => 'web']);
        $role3->givePermissionTo($user);


        // create demo users
        $user = \App\Models\Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'phone' => '0934893802938409',
            'password' => Hash::make(12345678),
        ]);
        $user->assignRole($role1);

        $user = \App\Models\Vendor::create([
            'name' => 'Vendor Admin',
            'email' => 'vendor@gmail.com',
            'phone' => '0934893802938409',
            'password' => Hash::make(12345678),
        ]);
        $user->assignRole($role2);

        $user = \App\Models\Vendor::create([
            'name' => 'Vendor Admin',
            'email' => 'dadyd@gmail.com',
            'password' => Hash::make(12345678),
            'phone' => '093489380093',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'phone' => '0934893802938409',
            'password' => Hash::make(12345678),
        ]);
       
    }
}
