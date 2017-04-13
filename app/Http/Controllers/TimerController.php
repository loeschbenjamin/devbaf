<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Storage;

class TimerController extends Controller
{
    public function show()
    {
        $now = Carbon::now();
        $target_appointment = Carbon::parse('this friday 16:00');
        $title = 'DEV - BaF';

        $holidays = [
            "2017-01-01", "2017-01-06",
            "2017-04-14", "2017-04-16", "2017-04-17",
            "2017-05-01", "2017-05-25",
            "2017-06-04", "2017-06-05", "2017-06-15",
            "2017-10-03",
            "2017-11-01",
            "2017-12-24", "2017-12-25", "2017-12-26",
        ];

        if( in_array($target_appointment->format('Y-m-d'), $holidays) ) {
            $target_appointment = $target_appointment->subDay(1);
            $title = 'DEV - BaD';
        }
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
            'title' => $title,
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
