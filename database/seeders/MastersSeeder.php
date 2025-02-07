<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Taluka;
use App\Models\Village;
use App\Models\Year;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MastersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // District Seeder
        $districts = [
            [
                'id' => 1,
                'district_name' => 'Pune',
                'district_initial' => 'PN',
            ],
            [
                'id' => 2,
                'district_name' => 'Satara',
                'district_initial' => 'ST',
            ],
        ];

        foreach ($districts as $district)
        {
            District::updateOrCreate([
                'id' => $district['id']
            ], [
                'id' => $district['id'],
                'district_name' => $district['district_name'],
                'district_initial' => $district['district_initial']
            ]);
        }



        // Taluka Seeder
        $talukas = [
            [
                'id' => 1,
                'district_id' => '1',
                'taluka_name' => 'Ambegaon',
                'taluka_ini' => 'AMB',
            ],
            [
                'id' => 2,
                'district_id' => '1',
                'taluka_name' => 'Mulshi',
                'taluka_ini' => 'ML',
            ],
            [
                'id' => 3,
                'district_id' => '1',
                'taluka_name' => 'Velhe',
                'taluka_ini' => 'VL',
            ],
            [
                'id' => 4,
                'district_id' => '1',
                'taluka_name' => 'Purandar',
                'taluka_ini' => 'PRD',
            ],
            [
                'id' => 5,
                'district_id' => '1',
                'taluka_name' => 'Indapur',
                'taluka_ini' => 'IND',
            ],
            [
                'id' => 6,
                'district_id' => '1',
                'taluka_name' => 'Baramati',
                'taluka_ini' => 'BRT',
            ],
            [
                'id' => 7,
                'district_id' => '2',
                'taluka_name' => 'Karad',
                'taluka_ini' => 'KRD',
            ],
            [
                'id' => 8,
                'district_id' => '2',
                'taluka_name' => 'Wai',
                'taluka_ini' => 'WAI',
            ],
            [
                'id' => 9,
                'district_id' => '2',
                'taluka_name' => 'Mahabaleshwar',
                'taluka_ini' => 'MBL',
            ],
            [
                'id' => 10,
                'district_id' => '2',
                'taluka_name' => 'Phaltan',
                'taluka_ini' => 'PHL',
            ],
            [
                'id' => 11,
                'district_id' => '2',
                'taluka_name' => 'Khatav',
                'taluka_ini' => 'KHT',
            ],
            [
                'id' => 12,
                'district_id' => '2',
                'taluka_name' => 'Khandala',
                'taluka_ini' => 'KHD',
            ],
        ];

        foreach ($talukas as $taluka)
        {
            Taluka::updateOrCreate([
                'id' => $taluka['id']
            ], [
                'id' => $taluka['id'],
                'district_id' => $taluka['district_id'],
                'taluka_name' => $taluka['taluka_name'],
                'taluka_ini' => $taluka['taluka_ini']
            ]);
        }



        // Villages Seeder
        $villages = [
            [
                'id' => 1,
                'taluka_id' => '1',
                'village_name' => 'Village 1',
                'village_init' => 'V1',
            ],
            [
                'id' => 2,
                'taluka_id' => '1',
                'village_name' => 'Village 2',
                'village_init' => 'V2',
            ],
            [
                'id' => 3,
                'taluka_id' => '2',
                'village_name' => 'Village 3',
                'village_init' => 'V3',
            ],
            [
                'id' => 4,
                'taluka_id' => '2',
                'village_name' => 'Village 4',
                'village_init' => 'V4',
            ],
            [
                'id' => 5,
                'taluka_id' => '3',
                'village_name' => 'Village 5',
                'village_init' => 'V5',
            ],
            [
                'id' => 6,
                'taluka_id' => '3',
                'village_name' => 'Village 6',
                'village_init' => 'V6',
            ],
            [
                'id' => 7,
                'taluka_id' => '4',
                'village_name' => 'Village 7',
                'village_init' => 'V7',
            ],
            [
                'id' => 8,
                'taluka_id' => '4',
                'village_name' => 'Village 8',
                'village_init' => 'V8',
            ],
            [
                'id' => 9,
                'taluka_id' => '5',
                'village_name' => 'Village 9',
                'village_init' => 'V9',
            ],
            [
                'id' => 10,
                'taluka_id' => '5',
                'village_name' => 'Village 10',
                'village_init' => 'V10',
            ],

            [
                'id' => 11,
                'taluka_id' => '6',
                'village_name' => 'Village 11',
                'village_init' => 'V11',
            ],
            [
                'id' => 12,
                'taluka_id' => '6',
                'village_name' => 'Village 12',
                'village_init' => 'V12',
            ],
            [
                'id' => 13,
                'taluka_id' => '7',
                'village_name' => 'Village 13',
                'village_init' => 'V13',
            ],
            [
                'id' => 14,
                'taluka_id' => '7',
                'village_name' => 'Village 14',
                'village_init' => 'V14',
            ],
            [
                'id' => 15,
                'taluka_id' => '8',
                'village_name' => 'Village 15',
                'village_init' => 'V15',
            ],
            [
                'id' => 16,
                'taluka_id' => '8',
                'village_name' => 'Village 16',
                'village_init' => 'V16',
            ],
            [
                'id' => 17,
                'taluka_id' => '9',
                'village_name' => 'Village 17',
                'village_init' => 'V17',
            ],
            [
                'id' => 18,
                'taluka_id' => '9',
                'village_name' => 'Village 18',
                'village_init' => 'V18',
            ],
            [
                'id' => 19,
                'taluka_id' => '10',
                'village_name' => 'Village 19',
                'village_init' => 'V19',
            ],
            [
                'id' => 20,
                'taluka_id' => '10',
                'village_name' => 'Village 20',
                'village_init' => 'V20',
            ],
        ];

        foreach ($villages as $village)
        {
            Village::updateOrCreate([
                'id' => $village['id']
            ], [
                'id' => $village['id'],
                'taluka_id' => $village['taluka_id'],
                'village_name' => $village['village_name'],
                'village_init' => $village['village_init']
            ]);
        }




        // Years Seeder
        $startYear = 1984;
        $currentYear = date('Y');

        for ($year = $startYear; $year <= $currentYear; $year++)
        {
            Year::updateOrCreate([
                'year' => $year
            ], [
                'year' => $year,
            ]);
        }
    }
}
