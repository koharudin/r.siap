<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedAdminUserPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_user_permissions')->delete();
        
        
        
    }
}