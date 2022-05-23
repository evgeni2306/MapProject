<?php

namespace App\Http;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


trait helpfunc
{
    public function GetUser()
    {
        $_SESSION['User'] = DB::table('users')
            ->where('users.id', Auth::id())
            ->join('ranks', 'ranks.id', '=', 'users.rank')
            ->select('users.id', 'users.name', 'surname','nickname', 'avatar', 'transport', 'mapstyle', 'rating', 'ranks.name as rname', 'maxrating')
            ->first();
        if($_SESSION['User']->nickname == null){
            $_SESSION['User']->nickname = $_SESSION['User']->name.' '.$_SESSION['User']->surname;
        }
    }
    public function GetUserBySocialId($socialid){
        $user = DB::table('users')
            ->where('social_id', $socialid->id)
            ->join('ranks', 'ranks.id', '=', 'users.rank')
            ->select('users.id', 'users.name', 'surname','nickname', 'avatar', 'transport', 'mapstyle', 'rating', 'ranks.name as rname', 'maxrating')
            ->first();
        if($_SESSION['User']->nickname == null){
            $_SESSION['User']->nickname = $_SESSION['User']->name.' '.$_SESSION['User']->surname;
        }
        return $user;

    }

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
        DB::table('users')
            ->where('id', Auth::user()->id)
            ->update([
                'rating' => $_SESSION['User']->rating,
                'rank' => $updaterank[0]->id
            ]);
    }
//-------------------------------------------------


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
                    $comment->rating = "/PageMap/img/icons/stars-0-5.svg";
                    break;
                case 1:
                    $comment->rating = "/PageMap/img/icons/stars-1-5.svg";
                    break;
                case 2:
                    $comment->rating = "/PageMap/img/icons/stars-2-5.svg";
                    break;
                case 3:
                    $comment->rating = "/PageMap/img/icons/stars-3-5.svg";
                    break;
                case 4:
                    $comment->rating = "/PageMap/img/icons/stars-4-5.svg";
                    break;
                case 5:
                    $comment->rating = "/PageMap/img/icons/stars-5-5.svg";
                    break;
            }
        }
        return $commentArr;
    }
}



