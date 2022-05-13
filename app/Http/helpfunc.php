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
            ->select('users.id', 'users.name', 'surname', 'avatar', 'transport', 'mapstyle', 'rating', 'ranks.name as rname', 'maxrating')
            ->first();
    }

    public function UpdateUserRating(int $score)
    {
        $_SESSION['User']->rating += $score;

//
        DB::table('users')
            ->where('id', Auth::user()->id)
            ->update([
                'rating' => $_SESSION['User']->rating,
            ]);
//        dd($_SESSION['User']->rating);
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
}



