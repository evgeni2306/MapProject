<?php

namespace App\Http;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;


trait helpfunc
{
    public function GetUser()
    {
        $_SESSION['User'] = DB::table('users')
            ->where('users.id', Auth::id())
            ->join('ranks', 'ranks.id', '=', 'users.rank')
            ->select('users.id', 'users.name', 'surname', 'nickname', 'avatar', 'transport', 'mapstyle', 'rating', 'ranks.id as rankid', 'ranks.name as rname', 'maxrating')
            ->first();
        if ($_SESSION['User']->nickname == null) {
            $_SESSION['User']->nickname = $_SESSION['User']->name . ' ' . $_SESSION['User']->surname;
        }
    }

    //---Получение данных юхера при авторизации через соц.сети---
    public function GetUserBySocialId($socialid)
    {
        $user = DB::table('users')
            ->where('social_id', $socialid->id)
            ->join('ranks', 'ranks.id', '=', 'users.rank')
            ->select('users.id', 'users.name', 'surname', 'nickname', 'avatar', 'transport', 'ranks.id as rankid', 'mapstyle', 'rating', 'ranks.name as rname', 'maxrating')
            ->first();
        if ($user->nickname == null) {
            $user->nickname = $user->name . ' ' . $user->surname;
        }
        return $user;

    }
    //--------------------------------------------------------


    //-----Обновление рейтинга у юзера при активностях-----
    public function UpdateUserRating(int $score)
    {
        $_SESSION['User']->rating += $score;
        DB::table('users')
            ->where('id', Auth::user()->id)
            ->update([
                'rating' => $_SESSION['User']->rating,
            ]);
        if ($_SESSION['User']->rating >= $_SESSION['User']->maxrating) {
            switch ($_SESSION['User']->rname) {
                case 'Новичок':
                    $this->UpdateUserRank(2);
                    break;
                case 'Любитель':
                    $this->UpdateUserRank(3);
                    break;
                case 'Профи':
                    $this->UpdateUserRank(4);
                    break;
////                case 4:
////                    $this->UpdateUserRating(4);
////                    break;
            }
        }
    }

    public function UpdateUserRank(int $rank)
    {
        $updaterank = DB::table('ranks')
            ->where('id', $rank)
            ->select('id', 'name', 'maxrating', 'icon')
            ->get();

        $_SESSION['User']->rname = $updaterank[0]->name;
        $_SESSION['User']->maxrating = $updaterank[0]->maxrating;
        $_SESSION['User']->rankid = $rank;
        DB::table('users')
            ->where('id', Auth::user()->id)
            ->update([
                'rating' => $_SESSION['User']->rating,
                'rank' => $updaterank[0]->id
            ]);
    }

    //-------------------------------------------------

    //---Определение иконок рейтинга для объекта и для комментария---
    public function GetObjectRatingIcon($object)
    {
        switch ($object->rating) {
            case 0:
                $object->rating = "/PageMap/img/icons/stars-0-5.svg";
                break;
            case 1:
                $object->rating = "/PageMap/img/icons/stars-1-5.svg";
                break;
            case 2:
                $object->rating = "/PageMap/img/icons/stars-2-5.svg";
                break;
            case 3:
                $object->rating = "/PageMap/img/icons/stars-3-5.svg";
                break;
            case 4:
                $object->rating = "/PageMap/img/icons/stars-4-5.svg";
                break;
            case 5:
                $object->rating = "/PageMap/img/icons/stars-5-5.svg";
                break;
        }
        return $object;
    }

    public function GetCommentRatingIcon($commentArr)
    {
        foreach ($commentArr as $comment) {
            switch ($comment->rating) {
                case 0:
                    $comment->rating = [0, "/PageMap/img/icons/stars-0-5.svg"];
                    break;
                case 1:
                    $comment->rating = [1, "/PageMap/img/icons/stars-1-5.svg"];
                    break;
                case 2:
                    $comment->rating = [2, "/PageMap/img/icons/stars-2-5.svg"];
                    break;
                case 3:
                    $comment->rating = [3, "/PageMap/img/icons/stars-3-5.svg"];
                    break;
                case 4:
                    $comment->rating = [4, "/PageMap/img/icons/stars-4-5.svg"];
                    break;
                case 5:
                    $comment->rating = [5, "/PageMap/img/icons/stars-5-5.svg"];
                    break;
            }
        }
        return $commentArr;
    }
    //------------------------------------------------

    //---Автоматическое определение города объекта---
    public function GetCityByCords($lat, $lng)
    {
        $lat = trim($lat);
        $lng = trim($lng);
        $context = stream_context_create(
            array(
                "http" => array(
                    "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                )
            )
        );
        $url = "https://nominatim.openstreetmap.org/reverse.php?lat=" . $lat . "&lon=" . $lng . "&format=jsonv2";
        $xml = file_get_contents($url, false, $context);
        $xmlArray = json_decode($xml, true);
        if (array_key_exists("city", $xmlArray["address"])) {
            $city = $xmlArray["address"]["city"];
        } else {
            $city = "Не определен";
        }
        return $city;
    }
    //------------------------------------------------

    //---Определение расстояние между 2мя точками - нужно для автоматического определения длины маршрута----
    public function GetRouteDistanceBetweenPoints($lat1, $lon1, $lat2, $lon2)
    {
        $radius = 6378.137;
        $dlat = $lat2 * pi() / 180 - $lat1 * pi() / 180;
        $dlon = $lon2 * pi() / 180 - $lon1 * pi() / 180;
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1 * pi() / 180) * cos($lat2 * pi() / 180)
            * sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $answer = $radius * $c;
        return $answer;
    }

    //--------------------------------------------------------------------------------------------------------

    public function GetObjectCommentsCount($type, $id)
    {
        if ($type == "point") {
            $getpcomments = DB::table('pcomments')
                ->select('id')
                ->where('pointid', $id)
                ->get();
            return Count($getpcomments);
        }
        if ($type == "route") {
            $getrcomments = DB::table('rcomments')
                ->select('id')
                ->where('routeid', $id)
                ->get();
            return Count($getrcomments);
        }
    }
}



