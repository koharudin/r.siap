<?php

namespace App\Models;

use Exception;

class AcceptedClass {
    public function hook(Request $request){
        throw new Exception("hooked");
    }
}
