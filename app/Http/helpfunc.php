<?php
namespace App\Http;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
trait helpfunc {
   public  function GetUser(){
       $_SESSION['User'] =DB::table('users')
           ->where('id',Auth::id())
           ->select('id','name','surname','avatar','transport')
           ->first();
    }
}

