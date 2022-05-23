<?php

namespace App\Http\Controllers;

use App\Http\helpfunc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;
use App\Models\Point;

class PointPageController extends Controller
{
    use helpfunc;

    public function GetCurrentPoint($id)
    {

        if (!isset($_SESSION['User']) and Auth::check()) {
            $this->GetUser();
        }
        $id = (int)$id;
        if ((is_numeric($id)) and ($id > 0) and Point::where('id', $id)->exists()) {
            //Получение точки из бд
            $_SESSION['CurrentPoint'] = DB::table('points')
                ->join('users', 'users.id', '=', 'points.creatorId')
                ->select('points.id', 'users.name as uname', 'users.nickname as nickname', 'users.avatar', 'points.status', 'users.surname as usurname', 'points.name', 'points.type', 'points.rating', 'address', 'lat', 'lng', 'icon', 'description', 'photo')
                ->where('points.id', $id)->first();
            if ($_SESSION['CurrentPoint']->nickname == null) {
                $_SESSION['CurrentPoint']->nickname = $_SESSION['CurrentPoint']->uname . ' ' . $_SESSION['CurrentPoint']->usurname;
            }

//Определение типа и иконки по группe type
            if ($_SESSION['CurrentPoint']->type == 'zpoints') {
                $_SESSION['CurrentPoint']->type = array(0 => "socket.svg", 1 => 'Розетка');
            } else if ($_SESSION['CurrentPoint']->type == 'dpoints') {
                $_SESSION['CurrentPoint']->type = array(0 => "building.svg", 1 => 'Достопримечательность');
            }
            //Определение нужной иконки звездочек в зависимости от значения rating
            $_SESSION['CurrentPoint'] = $this->GetObjectRatingIcon($_SESSION['CurrentPoint']);

//Рейтинг, 0 - иконка, 1 -  кол-во комментов, пока что просто объявление, нужно будет потом в этом же контроллере
            $_SESSION['CurrentPoint']->rating = array(0 => $_SESSION['CurrentPoint']->rating, 1 => 0);

//Получение комментов из бд
            $_SESSION['Pcomments'] = DB::table('pcomments')
                ->join('users', 'pcomments.creatorId', '=', 'users.id')
                ->select('users.name', 'users.surname','users.nickname', 'pcomments.rating', 'text', 'pcomments.created_at', 'avatar', 'login')
                ->where('pointid', $id)
                ->latest()
                ->get();

            foreach ($_SESSION['Pcomments'] as $pcomment){
                if($pcomment->nickname == null){
                    $pcomment->nickname = $pcomment->name.' '.$pcomment->surname;
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
