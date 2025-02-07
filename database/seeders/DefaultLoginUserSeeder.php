<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class DefaultLoginUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Super Admin / Collector Seeder ##
        $superAdminRole = Role::updateOrCreate(['name'=> 'Super Admin']);
        $permissions = Permission::pluck('id','id')->all();
        $superAdminRole->syncPermissions($permissions);

        $user = User::updateOrCreate([
            'id' => '1',
        ],[
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'mobile' => '9999999991',
            'password' => Hash::make('12345678'),
        ]);
        $user->assignRole([$superAdminRole->id]);



        // Admin Seeder ##
        $user = User::updateOrCreate([
            'id' => '2',
        ],[
            'name' => 'Collector',
            'email' => 'collector@gmail.com',
            'mobile' => '9999999992',
            'password' => Hash::make('12345678')
        ]);
        $user->assignRole([$superAdminRole->id]);



        // Officer Seeder ##
        $officerRole = Role::updateOrCreate(['name'=> 'Officer']);
        $permissions = Permission::pluck('id','id')->whereIn('id', [49,50,51,52,53,54,57,58,59,60,61,62,63]);
        $officerRole->syncPermissions($permissions);

        $user = User::updateOrCreate([
            'id' => '3',
        ],[
            'name' => 'Officer',
            'email' => 'officer@gmail.com',
            'mobile' => '9999999993',
            'password' => Hash::make('12345678'),
            'officer_id' => null,
            'district_id' => 2,
        ]);
        $user->assignRole([$officerRole->id]);



        // Assistant Officer Seeder ##
        $assistantOfficerRole = Role::updateOrCreate(['name'=> 'Assistant Officer']);
        $permissions = Permission::pluck('id','id')->whereIn('id', [53,54,55,56,57,58,59,62,63]);
        $assistantOfficerRole->syncPermissions($permissions);

        $user = User::updateOrCreate([
            'id' => '4',
        ],[
            'name' => 'Assistant Officer',
            'email' => 'assistant.officer@gmail.com',
            'mobile' => '9999999994',
            'password' => Hash::make('12345678'),
            'officer_id' => 3,
            'district_id' => 2,
        ]);
        $user->assignRole([$assistantOfficerRole->id]);



        // Divisional Seeder ##
        $divisionalRole = Role::updateOrCreate(['name'=> 'Divisional']);
        $permissions = Permission::pluck('id','id')->whereIn('id', [49,50,51,52,53,54,57,58,59,60,61,62,63]);
        $divisionalRole->syncPermissions($permissions);

        $user = User::updateOrCreate([
            'id' => '5',
        ],[
            'name' => 'Divisional Officer',
            'email' => 'divisional@gmail.com',
            'mobile' => '9999999995',
            'password' => Hash::make('12345678'),
            'officer_id' => null,
            'district_id' => 2,
        ]);
        $user->assignRole([$divisionalRole->id]);



        // Sub-Divisional Officer Seeder ##
        $subDivisionalRole = Role::updateOrCreate(['name'=> 'Sub Divisional']);
        $permissions = Permission::pluck('id','id')->whereIn('id', [53,54,55,56,57,58,59,62,63]);
        $subDivisionalRole->syncPermissions($permissions);

        $user = User::updateOrCreate([
            'id' => '6',
        ],[
            'name' => 'Sub Divisional',
            'email' => 'sub.divisional@gmail.com',
            'mobile' => '9999999996',
            'password' => Hash::make('12345678'),
            'officer_id' => 3,
            'district_id' => 2,
        ]);
        $user->assignRole([$subDivisionalRole->id]);



        // Other User Seeder ##
        $otherRole = Role::updateOrCreate(['name'=> 'Other']);
        $permissions = Permission::pluck('id','id')->all();
        $otherRole->syncPermissions($permissions);

        $user = User::updateOrCreate([
            'id' => '7',
        ],[
            'name' => 'Other',
            'email' => 'other@gmail.com',
            'mobile' => '9999999997',
            'password' => Hash::make('12345678'),
            'district_id' => 2,
        ]);
        $user->assignRole([$otherRole->id]);

    }
}
