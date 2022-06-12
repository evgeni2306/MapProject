<?php

namespace App\Http\Controllers;

use App\Http\helpfunc;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;

class GetProfileController extends Controller
{
    use helpfunc;

    public function GetProfile($id)
    {
        if (!isset($_SESSION['User']) and Auth::check()) {
            $this->GetUser();
        }
        $id = (int)$id;
        if ((is_numeric($id)) and ($id > 0) and User::where('id', $id)->exists()) {

            $user = DB::table('users')
                ->where('users.id',$id)
                ->join('ranks', 'ranks.id', '=', 'users.rank')
                ->select('users.id', 'users.name', 'surname','users.rank','nickname', 'avatar', 'transport','rating','ranks.name as rname',
                    'maxrating')
                ->first();
            if($user->nickname == null){
                $user->nickname = $user->name.' '.$user->surname;
            }
            $userinfo = $this->GetInformation($id);

            if($user->rank !=4){
                $getnextrank = DB::table('ranks')
                    ->where('id',"=",$user->rank+1)
                    ->select('ranks.name')
                    ->first();
                $nextrank = ": ". $getnextrank->name;
            }else
            {
                $nextrank = "";
            }


            return view('profile',[
                'user' => $user,
                'userinfo' =>$userinfo,
                'nextrank'=>$nextrank
            ]);




        }else
            redirect(route('map'));

    }



//метод для получения данных юзера(кол-во маршуртов комментов и точек)
public
function GetInformation($id)
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
            ->where('creatorid', $id)->get()); //Тут нужно будет еще посчитать количество комментов у маршрутов и суммировать
    $arr = array(
        "points" => $Pointscount,
        "comments" => $Commentscount,
        "routes" => $Routescount
    );
    return $arr;
}
}
