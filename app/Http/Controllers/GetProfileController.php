<?php

namespace App\Http\Controllers;

use App\Http\helpfunc;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GetProfileController extends Controller
{
    use helpfunc;
//Метод получения данных для страницы профиля
    public function GetProfile($id)
    {
        if (!isset($_SESSION['User']) and Auth::check()) {
            $this->GetUser();
        }
        $id = (int)$id;
        if ((is_numeric($id)) and ($id > 0) and User::where('id', $id)->exists()) {

            $user = DB::table('users')
                ->where('users.id', $id)
                ->join('ranks', 'ranks.id', '=', 'users.rank')
                ->select('users.id', 'users.name','ranks.id  as rankid', 'surname', 'users.rank', 'nickname', 'avatar', 'transport', 'rating', 'ranks.name as rname',
                    'maxrating')
                ->first();
            if ($user->nickname == null) {
                $user->nickname = $user->name . ' ' . $user->surname;
            }
            $userinfo = $this->GetInformation($id);
            if ($user->rank != 4) {
                $getnextrank = DB::table('ranks')
                    ->where('id', "=", $user->rank + 1)
                    ->select('ranks.name')
                    ->first();
                $nextrank = $getnextrank->name;
            } else {
                $nextrank = "";
            }
            $roleicon = "/PageProfile/img/role_" . $user->rank . ".svg";
            return view('profile', [
                'user' => $user,
                'userinfo' => $userinfo,
                'nextrank' => $nextrank,
                'roleicon' => $roleicon
            ]);
        } else
            redirect(route('map'));
    }


//метод для получения данных юзера(кол-во маршуртов комментов и точек)
    public function GetInformation($id)
    {
        $Pointscount = Count(DB::table('points')
            ->select('id')
            ->where('creatorid', $id)->get());
        $Routescount = Count(DB::table('routes')
            ->select('id')
            ->where('creatorid', $id)->get());
        $Commentscount =
            Count(DB::table('pcomments')
                ->select('id')
                ->where('creatorid', $id)->get())
            + Count(DB::table('rcomments')
                ->select('id')
                ->where('creatorid', $id)->get());
        $arr = array(
            "points" => $Pointscount,
            "comments" => $Commentscount,
            "routes" => $Routescount
        );
        return $arr;
    }
}
