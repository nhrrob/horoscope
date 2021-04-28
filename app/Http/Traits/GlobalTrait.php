<?php 

namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;

trait GlobalTrait {
    
    public function adminOnly(){
        if(Auth::user()->role != 'admin'){
            die('Permission denied!');
        }
    }

}