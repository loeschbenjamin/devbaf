<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class TimerController extends Controller
{
    public function show()
    {
        return view('welcome');
    }

    public function useUnit($unit = 'd')
    {
        $now = Carbon::now();
        $target_appointment = Carbon::parse('this friday 16:00');

        if( $target_appointment->lessThanOrEqualTo($now) ) {
            $isDevBaF = true;
        } else {
            $isDevBaF = false;
        }

        switch($unit)
        {
            case 'sec':
                $unit_hr = 'Sekunde';
                $value = $now->diffInSeconds($target_appointment);
                break;
            case 'min':
                $unit_hr = 'Minute';
                $value = $now->diffInMinutes($target_appointment);
                break;
            case 'h':
                $unit_hr = 'Stunde';
                $value = $now->diffInHours($target_appointment);
                break;
            case 'd':
            default:
                $unit_hr = 'Tag';
                $value = $now->diffInDays($target_appointment);
                break;
        }

        if ($value > 1) {
            if($unit == 'd') {
                $unit_hr .= 'e';
            } else {
                $unit_hr .= 'n';
            }
        }

        return view('welcome', [
            'value' => $value,
            'unit' => $unit_hr,
            'isDevBaF' => $isDevBaF,
            'now' => $now->toDayDateTimeString(),
            'target_appointment' => $target_appointment
        ]);
    }
}
