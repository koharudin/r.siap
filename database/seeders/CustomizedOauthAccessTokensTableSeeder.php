<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedOauthAccessTokensTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('oauth_access_tokens')->delete();
        
        
        
    }
}