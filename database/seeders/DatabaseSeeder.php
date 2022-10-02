<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Group::factory(10)->create();
        \App\Models\Item::factory(10)->create();
        \App\Models\Customer::factory(10)->create();
        \App\Models\Supplier::factory(10)->create();
        \App\Models\Export::factory(10)->create();
        \App\Models\Emport::factory(10)->create();
        \App\Models\Emport::factory(10)->create();

       
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'change']);
        Permission::create(['name' => 'mange item']);


        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        $user = \App\Models\User::create([
            'name'      =>  'admin',
            'email'     =>  'admin@gmail.com',
            'password'  => Hash::make('123456'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole($role);
    }
}
