<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'id' => 1,
                'name' => 'dashboard.view',
                'group' => 'dashboard',
            ],
            [
                'id' => 2,
                'name' => 'users.view',
                'group' => 'users',
            ],
            [
                'id' => 3,
                'name' => 'users.create',
                'group' => 'users',
            ],
            [
                'id' => 4,
                'name' => 'users.edit',
                'group' => 'users',
            ],
            [
                'id' => 5,
                'name' => 'users.delete',
                'group' => 'users',
            ],
            [
                'id' => 6,
                'name' => 'users.toggle_status',
                'group' => 'users',
            ],
            [
                'id' => 7,
                'name' => 'users.change_password',
                'group' => 'users',
            ],
            [
                'id' => 8,
                'name' => 'roles.view',
                'group' => 'roles',
            ],
            [
                'id' => 9,
                'name' => 'roles.create',
                'group' => 'roles',
            ],
            [
                'id' => 10,
                'name' => 'roles.edit',
                'group' => 'roles',
            ],
            [
                'id' => 11,
                'name' => 'roles.delete',
                'group' => 'roles',
            ],
            [
                'id' => 12,
                'name' => 'roles.assign',
                'group' => 'roles',
            ],
            // [
            //     'id' => 13,
            //     'name' => 'wards.view',
            //     'group' => 'wards',
            // ],
            // [
            //     'id' => 14,
            //     'name' => 'wards.create',
            //     'group' => 'wards',
            // ],
            // [
            //     'id' => 15,
            //     'name' => 'wards.edit',
            //     'group' => 'wards',
            // ],
            // [
            //     'id' => 16,
            //     'name' => 'wards.delete',
            //     'group' => 'wards',
            // ],
            [
                'id' => 17,
                'name' => 'districts.view',
                'group' => 'districts',
            ],
            [
                'id' => 18,
                'name' => 'districts.create',
                'group' => 'districts',
            ],
            [
                'id' => 19,
                'name' => 'districts.edit',
                'group' => 'districts',
            ],
            [
                'id' => 20,
                'name' => 'districts.delete',
                'group' => 'districts',
            ],
            [
                'id' => 21,
                'name' => 'talukas.view',
                'group' => 'talukas',
            ],
            [
                'id' => 22,
                'name' => 'talukas.create',
                'group' => 'talukas',
            ],
            [
                'id' => 23,
                'name' => 'talukas.edit',
                'group' => 'talukas',
            ],
            [
                'id' => 24,
                'name' => 'talukas.delete',
                'group' => 'talukas',
            ],
            [
                'id' => 25,
                'name' => 'villages.view',
                'group' => 'villages',
            ],
            [
                'id' => 26,
                'name' => 'villages.create',
                'group' => 'villages',
            ],
            [
                'id' => 27,
                'name' => 'villages.edit',
                'group' => 'villages',
            ],
            [
                'id' => 28,
                'name' => 'villages.delete',
                'group' => 'villages',
            ],
            // [
            //     'id' => 29,
            //     'name' => 'sr_nos.view',
            //     'group' => 'sr_nos',
            // ],
            // [
            //     'id' => 30,
            //     'name' => 'sr_nos.create',
            //     'group' => 'sr_nos',
            // ],
            // [
            //     'id' => 31,
            //     'name' => 'sr_nos.edit',
            //     'group' => 'sr_nos',
            // ],
            // [
            //     'id' => 32,
            //     'name' => 'sr_nos.delete',
            //     'group' => 'sr_nos',
            // ],
            [
                'id' => 33,
                'name' => 'land_acquisitions.view',
                'group' => 'land_acquisitions',
            ],
            [
                'id' => 34,
                'name' => 'land_acquisitions.create',
                'group' => 'land_acquisitions',
            ],
            [
                'id' => 35,
                'name' => 'land_acquisitions.edit',
                'group' => 'land_acquisitions',
            ],
            [
                'id' => 36,
                'name' => 'land_acquisitions.delete',
                'group' => 'land_acquisitions',
            ],
            // [
            //     'id' => 37,
            //     'name' => 'bundles.view',
            //     'group' => 'bundles',
            // ],
            // [
            //     'id' => 38,
            //     'name' => 'bundles.create',
            //     'group' => 'bundles',
            // ],
            // [
            //     'id' => 39,
            //     'name' => 'bundles.edit',
            //     'group' => 'bundles',
            // ],
            // [
            //     'id' =>40,
            //     'name' => 'bundles.delete',
            //     'group' => 'bundles',
            // ],
            // [
            //     'id' => 41,
            //     'name' => 'years.view',
            //     'group' => 'years',
            // ],
            // [
            //     'id' => 42,
            //     'name' => 'years.create',
            //     'group' => 'years',
            // ],
            // [
            //     'id' => 43,
            //     'name' => 'years.edit',
            //     'group' => 'years',
            // ],
            // [
            //     'id' =>44,
            //     'name' => 'years.delete',
            //     'group' => 'years',
            // ],
            [
                'id' => 45,
                'name' => 'designations.view',
                'group' => 'designations',
            ],
            [
                'id' => 46,
                'name' => 'designations.create',
                'group' => 'designations',
            ],
            [
                'id' => 47,
                'name' => 'designations.edit',
                'group' => 'designations',
            ],
            [
                'id' =>48,
                'name' => 'designations.delete',
                'group' => 'designations',
            ],


            [
                'id' => 49,
                'name' => 'la_register.view',
                'group' => 'la_register',
            ],
            [
                'id' => 50,
                'name' => 'la_register.create',
                'group' => 'la_register',
            ],
            [
                'id' => 51,
                'name' => 'la_register.edit',
                'group' => 'la_register',
            ],
            [
                'id' => 52,
                'name' => 'la_register.delete',
                'group' => 'la_register',
            ],
            [
                'id' => 53,
                'name' => 'la_record.view',
                'group' => 'la_record',
            ],
            [
                'id' => 54,
                'name' => 'la_record.create',
                'group' => 'la_record',
            ],
            [
                'id' => 55,
                'name' => 'la_record.edit',
                'group' => 'la_record',
            ],
            [
                'id' => 56,
                'name' => 'la_record.delete',
                'group' => 'la_record',
            ],
            [
                'id' => 57,
                'name' => 'la_record.pending-list',
                'group' => 'la_record',
            ],
            [
                'id' => 58,
                'name' => 'la_record.approved-list',
                'group' => 'la_record',
            ],
            [
                'id' => 59,
                'name' => 'la_record.rejected-list',
                'group' => 'la_record',
            ],
            [
                'id' => 60,
                'name' => 'la_record.approve',
                'group' => 'la_record',
            ],
            [
                'id' => 61,
                'name' => 'la_record.reject',
                'group' => 'la_record',
            ],
            [
                'id' => 62,
                'name' => 'record_auth.in_process',
                'group' => 'record_auth',
            ],
            [
                'id' => 63,
                'name' => 'record_auth.completed',
                'group' => 'record_auth',
            ],
        ];

        foreach ($permissions as $permission)
        {
            Permission::updateOrCreate([
                'id' => $permission['id']
            ], [
                'id' => $permission['id'],
                'name' => $permission['name'],
                'group' => $permission['group']
            ]);
        }
    }
}
