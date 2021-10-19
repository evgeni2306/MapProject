<?php

namespace App\Http\Controllers;
use App\Models\Pcomment;
use Illuminate\Http\Request;

class AddPcommentController extends Controller
{
    public function AddPcomment(Request $request)
    {
        $validateFields = $request->validate([
            'rating'=> 'required',
            'text' => 'required',
        ]);
        $validateFields['creatorid'] = 1;
//        $validateFields['pointid'] = $_SESSION['CurrentPoint']->id;
        $validateFields['pointid'] = 1;

        $pcomment = Pcomment::create($validateFields);

//        return redirect()->intended('/point=' . $_SESSION['CurrentPoint']->id);
        return redirect()->intended('/point=' . 1);



    }
}
