<?php

namespace App\Services;


use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

abstract class AbstractImportFromCSV
{

    protected function parseFileFromRequest(Request $request, $fileName){
        $data = null;
        if ($request->hasFile($fileName)) {
            $path = $request->file($fileName)->getRealPath();
            $data = Excel::load($path)->get();
        }
        return $data;
    }

    protected function getDataFromFile($path){
        $resultData = null;
        if (file_exists($path)){
            $resultData = Excel::load($path)->get();
        }
        return $resultData;
    }

    abstract public function import(Request $request);
}