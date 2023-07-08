<?php 
namespace App\Providers;

use Illuminate\Support\Facades\App;

class MD5HashProvider extends \Illuminate\Hashing\HashServiceProvider
{
    public function boot()
    {
    App::bind('hash', function () {
        return new MD5HashProvider();
    });
}}