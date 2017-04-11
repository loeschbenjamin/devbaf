<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Storage;

class TimerController extends Controller
{
    public function show()
    {
        $now = Carbon::now();
        $target_appointment = Carbon::parse('this friday 16:00');
        $img_src = false;

        if( $target_appointment->lessThanOrEqualTo($now) ) {
            $isDevBaF = true;

            $img_src = '/storage';
            $files = Storage::disk('public')->allFiles('img');
            $img_src .= '/' . $files[rand(1, ( count($files))) - 1];
        } else {
            $isDevBaF = false;
        }

        return view('welcome', [
            'isDevBaF' => $isDevBaF,
            'img_src' => $img_src,
            'end' => $target_appointment
        ]);
    }

    public function setDevBaF()
    {
        $isDevBaF = true;

        $img_src = '/storage';

        $files = Storage::disk('public')->allFiles('img');

        $img_src .= '/' . $files[rand(1, ( count($files))) - 1];

        return view('welcome', [
            'isDevBaF' => $isDevBaF,
            'img_src' => $img_src
        ]);
    }
}
