<?php

namespace App\Http\Controllers;

use App\Http\helpfunc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    use helpfunc;
    public function GetSearchPage()
    {

        $getcities = $this->GetCityArr();


        return view('search', ['city' => $getcities]);
    }

    public function Search(Request $request)
    {
        $validateFields = $request->validate([
            'city' => ['nullable', 'string'],
            'difficult' => ['nullable', 'string', 'ends_with:Легко,Средне,Сложно'],
            'status' => ['nullable', 'string', 'ends_with:Под вопросом,Работает,Не работает'],
            'distancefrom' => ['nullable', 'numeric'],
            'distanceto' => ['nullable', 'numeric'],
            'timefrom' => ['nullable', 'numeric'],
            'timeto' => ['nullable', 'numeric']

        ]);
        if (!isset($validateFields['status'])) {
            $validateFields['status'] = null;
        }
        if (!isset($validateFields['difficult'])) {
            $validateFields['difficult'] = null;
        }
        if (!isset($validateFields['city'])) {
            $validateFields['city'] = null;
        }
        if (!isset($validateFields['distancefrom'])) {
            $validateFields['distancefrom'] = null;
        }
        if (!isset($validateFields['distanceto'])) {
            $validateFields['distanceto'] = null;
        }
        if (!isset($validateFields['timefrom'])) {
            $validateFields['timefrom'] = null;
        }
        if (!isset($validateFields['timeto'])) {
            $validateFields['timeto'] = null;
        }

        $results = DB::table('routes')
            ->select('id', 'name', 'icon', 'city','type', 'shortdescription', 'difficult', 'distance', 'time', 'rating', 'status')
            ->get();

        $arr = [];
        foreach($results as $res){
            array_push($arr,$res);
        }
        $results = $arr;
        if ($validateFields['city']!= null ){
            foreach ($results as $res) {
                if ($res->city != $validateFields['city']){
                    unset($results[array_search($res,$results)]);
                }
            }
            $results = array_values($results);

        }
        if ($validateFields['difficult']!=null){
            foreach ($results as $res) {
                if ($res->difficult != $validateFields['difficult']){
                    unset($results[array_search($res,$results)]);
                }
            }
            $results = array_values($results);
        }
        if ($validateFields['status']!=null){
            foreach ($results as $res) {
                if ($res->status != $validateFields['status']){
                    unset($results[array_search($res,$results)]);
                }
            }
            $results = array_values($results);
        }

        if ($validateFields['status']!=null){
            foreach ($results as $res) {
                if ($res->status != $validateFields['status']){
                    unset($results[array_search($res,$results)]);
                }
            }
            $results = array_values($results);
        }
        if ($validateFields['distancefrom']!=null){
            foreach ($results as $res) {
                if ((float)$res->distance < (float)$validateFields['distancefrom']){
                    unset($results[array_search($res,$results)]);
                }
            }
            $results = array_values($results);
        }
        if ($validateFields['distanceto']!=null){
            foreach ($results as $res) {
                if ((float)$res->distance > (float)$validateFields['distanceto']){
                    unset($results[array_search($res,$results)]);
                }
            }
            $results = array_values($results);
        }
        if ($validateFields['timefrom']!=null){
            foreach ($results as $res) {
                if ((float)$res->time < (float)$validateFields['timefrom']){
                    unset($results[array_search($res,$results)]);
                }
            }
            $results = array_values($results);
        }
        if ($validateFields['timeto']!=null){
            foreach ($results as $res) {
                if ((float)$res->time > (float)$validateFields['timeto']){
                    unset($results[array_search($res,$results)]);
                }
            }
            $results = array_values($results);
        }

        foreach ($results as $res){
            $Route = $this->GetObjectRatingIcon($res);
            $count = $this->GetObjectCommentsCount("route", $res->id);
            $res->rating =  [$Route->rating, $count];
            if (is_numeric((float)$res->time) and (float)$res->time != 0) {
                $res->time = $res->time."Ч";
            }
            if ($res->difficult == "Сложно") {
                $res->icon = "redroute";
            }
            if ($res->difficult == "Средне") {
                $res->icon = "yellowroute";
            }
            if ($res->difficult == "Легко") {
                $res->icon = "greenroute";
            }
        }

        $getcities = $this->GetCityArr();
        return view('search', ['city' => $getcities,'results'=>$results]);
    }


    public function GetCityArr()
    {
        $cities = DB::table('routes')
            ->select('city')->distinct()->get();
        return $cities;
    }
}
