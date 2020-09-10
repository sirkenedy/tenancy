<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $table= "tenants";

    public static function getTenant()
    {
        $url = request()->getHttpHost();

        // echo $url;
        $url_array = explode('.', $url);
        $subdomain =  $url_array[0];

        if($subdomain == 'www'){
            $subdomain =  $url_array[1];
        }

        $tenant = Tenant::where('subdomain', 'LIKE', $subdomain)->first();

        if(!$tenant){
            echo view('tenant-not-found')->with(['tenant'=>$subdomain]);
            exit();
        }
        \View::share('tenant', $tenant);
    }
}
