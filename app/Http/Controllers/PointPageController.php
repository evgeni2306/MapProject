<?php

namespace App\Http\Controllers;

use App\Classes\PointPageClass;
use App\Http\helpfunc;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Point;

class PointPageController extends Controller
{
    use helpfunc;

    //Метод получения данных для личной страницы точки
    public function GetCurrentPoint($id)
    {

        if (!isset($_SESSION['User']) and Auth::check()) {
            $this->GetUser();
        }
        $id = (int)$id;
        if ((is_numeric($id)) and ($id > 0) and Point::where('id', $id)->exists()) {
            //Получение точки из бд
            $getpoint = DB::table('points')
                ->join('users', 'users.id', '=', 'points.creatorId')
                ->select('points.id', 'creatorid', 'users.name as uname', 'users.nickname as nickname', 'users.avatar', 'points.status', 'users.surname as usurname', 'points.name', 'points.type', 'points.rating', 'address','city', 'lat', 'lng', 'icon', 'description', 'photo')
                ->where('points.id', $id)->first();
            if ($getpoint->nickname == null) {
                $getpoint->nickname = $getpoint->uname . ' ' . $getpoint->usurname;
            }

            //Определение типа и иконки
            if ($getpoint->type == 'zpoints') {
                $getpoint->type = array(0 => "socket.svg", 1 => 'Розетка');
            } else if ($getpoint->type == 'dpoints') {
                $getpoint->type = array(0 => "building.svg", 1 => 'Достопримечательность');
            }
            if ($getpoint->icon == "insocket") {
                $getpoint->type = array(0 => "socket.svg", 1 => 'Розетка');
            }
            if ($getpoint->icon == "inhouse") {
                $getpoint->type = array(0 => "building.svg", 1 => 'Достопримечательность');
            }
            //Определение нужной иконки звездочек в зависимости от значения rating
            $getpoint = $this->GetObjectRatingIcon($getpoint);

            //Рейтинг, 0 - иконка, 1 -  кол-во комментов, пока что просто объявление, нужно будет потом в этом же контроллере
            $getpoint->rating = array(0 => $getpoint->rating, 1 => 0);

            $checkComment = DB::table('pcomments')
                ->where('creatorid', "=", Auth::id())
                ->where('pointid', "=", $id)
                ->get();

            if (Count($checkComment) == 1 or !Auth::check()) {
                $canAddComment = false;
            } else {
                $canAddComment = true;
            }
            $_SESSION['CurrentPoint'] = new PointPageClass(
                $getpoint->id,
                $getpoint->creatorid,
                $getpoint->name,
                $getpoint->status,
                $getpoint->description,
                $getpoint->rating,
                $getpoint->type,
                $getpoint->city,
                $getpoint->address,
                $getpoint->lat,
                $getpoint->lng,
                $getpoint->icon,
                $getpoint->photo,
                $getpoint->avatar,
                $getpoint->uname,
                $getpoint->usurname,
                $getpoint->nickname,
                $canAddComment

            );

//Получение комментов из бд
            $_SESSION['Pcomments'] = DB::table('pcomments')
                ->join('users', 'pcomments.creatorId', '=', 'users.id')
                ->join('ranks', 'ranks.id', '=', 'users.rank')
                ->select('pcomments.id', 'users.name', 'users.surname', 'creatorid', 'users.nickname', 'pcomments.rating', 'text', 'users.rating as urate', 'ranks.name as rname', 'pcomments.created_at', 'avatar')
                ->where('pointid', $id)
                ->latest()
                ->get();
            foreach ($_SESSION['Pcomments'] as $pcomment) {
                if ($pcomment->nickname == null) {
                    $pcomment->nickname = $pcomment->name . ' ' . $pcomment->surname;
                }
            }


//ОПределение иконок рейтинга у комментариев
            $_SESSION['Pcomments'] = $this->GetCommentRatingIcon($_SESSION['Pcomments']);
            $_SESSION['CurrentPoint']->rating[1] = Count($_SESSION['Pcomments']);
            return view('pointpersonal');
        } else {
            return redirect(route('map'));
        }


    }


}
