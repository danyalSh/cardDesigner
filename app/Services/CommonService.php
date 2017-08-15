<?php
/**
 * Created by PhpStorm.
 * User: ahsan
 * Date: 7/24/16
 * Time: 4:14 PM
 */

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class CommonService{

    public function uploadFile($request) {
        try {
            if (Input::hasFile('uploadImage')) {
                $dt = Carbon::parse(Carbon::Now());
                $timeStamp = $dt->timestamp;
                $destinationPath = public_path() . '/company';
                $extension = Input::file('uploadImage')->getClientOriginalExtension();
                $fileOriginalName = Input::file('uploadImage')->getClientOriginalName();
                $fileOriginalName = str_replace('.' . $extension, "", $fileOriginalName);
                $fileName = $timeStamp . '__' . $fileOriginalName . '.' . $extension;
                Input::file('uploadImage')->move($destinationPath, $fileName);
                return collect([
                    'status' => 'success',
                    'message' => 'File uploaded...!'
                ]);
            } else {
                return collect([
                    'status' => 'failure',
                    'message' => 'no Input file...!'
                ]);
            }
        } catch(\Exception $e) {
            return collect([
                'status' => 'failure',
                'message' => $e
            ]);
        }
    }
    
    public function uploadFileNew($request) {
        try {
            if (Input::hasFile('image')) {
                $dt = Carbon::parse(Carbon::Now());
                $timeStamp = $dt->timestamp;
                $destinationPath = public_path() . '/images';
                $extension = Input::file('image')->getClientOriginalExtension();
                $fileOriginalName = Input::file('image')->getClientOriginalName();
                $fileOriginalName = str_replace('.' . $extension, "", $fileOriginalName);
                $fileName = $fileOriginalName . '.' . $extension;
                Input::file('image')->move($destinationPath, $fileName);
                return collect([
                    'status' => 'success',
                    'message' => 'File uploaded...!'
                ]);
            } else {
                return collect([
                    'status' => 'failure',
                    'message' => 'no Input file...!'
                ]);
            }
        } catch(\Exception $e) {
            return collect([
                'status' => 'failure',
                'message' => $e
            ]);
        }
    }

}