<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedAdminRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_roles')->delete();
        
        \DB::table('admin_roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Administrator',
                'slug' => 'administrator',
                'created_at' => '2023-06-24 10:35:31',
                'updated_at' => '2023-06-24 10:35:31',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Pegawai',
                'slug' => 'pegawai',
                'created_at' => '2023-07-05 03:26:52',
                'updated_at' => '2023-07-05 03:26:52',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'auditor',
                'slug' => 'auditor',
                'created_at' => '2023-07-08 00:14:42',
                'updated_at' => '2023-07-08 00:14:42',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Super Administrator',
                'slug' => 'superadministrator',
                'created_at' => '2023-07-12 08:16:33',
                'updated_at' => '2023-07-12 08:16:58',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Verifikator',
                'slug' => 'verifikator',
                'created_at' => '2023-08-03 10:29:29',
                'updated_at' => '2023-08-03 10:29:29',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Pengusul',
                'slug' => 'pengusul',
                'created_at' => '2023-08-03 10:31:00',
                'updated_at' => '2023-08-03 10:31:00',
            ),
        ));
        
        
    }
}