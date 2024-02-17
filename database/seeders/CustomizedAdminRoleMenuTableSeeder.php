<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedAdminRoleMenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_role_menu')->delete();
        
        \DB::table('admin_role_menu')->insert(array (
            0 => 
            array (
                'role_id' => 2,
                'menu_id' => 35,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'role_id' => 4,
                'menu_id' => 26,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'role_id' => 4,
                'menu_id' => 27,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'role_id' => 4,
                'menu_id' => 28,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'role_id' => 4,
                'menu_id' => 29,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'role_id' => 4,
                'menu_id' => 30,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'role_id' => 4,
                'menu_id' => 31,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'role_id' => 4,
                'menu_id' => 32,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'role_id' => 4,
                'menu_id' => 33,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'role_id' => 4,
                'menu_id' => 21,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'role_id' => 4,
                'menu_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'role_id' => 4,
                'menu_id' => 36,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'role_id' => 2,
                'menu_id' => 44,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'role_id' => 1,
                'menu_id' => 9,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'role_id' => 4,
                'menu_id' => 9,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'role_id' => 5,
                'menu_id' => 45,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'role_id' => 6,
                'menu_id' => 44,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'role_id' => 4,
                'menu_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}