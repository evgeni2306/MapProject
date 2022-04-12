<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Models\Route;
use App\Models\Rpoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;
use PHPUnit\Framework\Constraint\Count;
use SimpleXMLElement;

class UploadRouteController extends Controller
{
    public function Test(Request $request)
    {
        $validateFields = $request->validate([
            'text' => 'required',
            'file' => 'required',
            'spisok' => 'required'

        ]);

        $path = Storage::putFile('routes', $request->file('file'));
        switch ($validateFields['spisok']) {
            case "CSV":
                $this->CSVparse($path);
                break;
            case "GPX":
                $this->XMLparse($path);
                break;

        }
    }

    public function XMLparse($path)
    {
        $xml = new SimpleXMLElement(file_get_contents(storage_path('app\\' . $path)));
        $count = Count($xml->trk->trkseg->trkpt);
        $rroute = array("text" => '123');
        $Route = Route::create($rroute);

        for ($i = 0; $i <= $count - 101; $i += 100) {
            $point = array("routeid" => $Route->id, "lat" => $xml->trk->trkseg->trkpt[$i]['lat'], "lng" => $xml->trk->trkseg->trkpt[$i]['lon']);
            set_time_limit(20);
            Rpoint::create($point);
        }
        $this->DeleteFile($path);
    }

    public function CSVparse($path)
    {
        $file = explode("\r\n", (string)file_get_contents(storage_path('app\\' . $path)));
        $count = Count($file);
        $rroute = array("text" => '123');
        $Route = Route::create($rroute);
        for ($i = 1; $i <= $count - 101; $i += 100) {
            $row = explode(',', $file[$i]);
            $point = array("routeid" => $Route->id, "x" => $row[2], "y" => $row[3]);
            set_time_limit(20);
            Rpoint::create($point);
        }
        $this->DeleteFile($path);
    }
    public function DeleteFile($path){
        $delete = Storage::delete($path);
        if ($delete) {
            echo 'удалено';
        }
    }


}
