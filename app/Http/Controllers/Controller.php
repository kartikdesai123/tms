<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;
use App;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public $loginUser;
    public function __construct() {         
         
        $this->middleware(function ($request, $next) {
            
            if(isset($_COOKIE["language"])){
                $lang = $_COOKIE["language"];
            }else{
                $lang = 'en';
                $_COOKIE["language"] = $lang;
            }
            

            if (!empty($lang)) {
                App::setLocale($lang);
            } else {
                App::setLocale('en');
            }

            if (!empty(Auth()->guard('admin')->user())) {
                $this->loginUser = Auth()->guard('admin')->user();
            }
            if (!empty(Auth()->guard('customer')->user())) {
                $this->loginUser = Auth()->guard('customer')->user();
            }
            if (!empty(Auth::user())) {
                $this->loginUser = Auth::user();
            }
            
            return $next($request);
        });
       
       
    }
}
