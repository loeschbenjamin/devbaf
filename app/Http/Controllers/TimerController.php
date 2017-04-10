<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class TimerController extends Controller
{
    public function show()
    {
        $now = Carbon::now();
        $target_appointment = Carbon::parse('this friday 16:00');

        if( $target_appointment->lessThanOrEqualTo($now) ) {
            $isDevBaF = true;
        } else {
            $isDevBaF = false;
        }

        $unit_hr = 'Tag';
        $unit_js = 'countdown.DAYS';
        $value = $now->diffInDays($target_appointment);

        if ($value > 1) {
            $unit_hr .= 'e';
        }

        return view('welcome', [
            'value' => $value,
            'unit' => $unit_hr,
            'unit_js' => $unit_js,
            'isDevBaF' => $isDevBaF,
            'now' => $now->toDayDateTimeString(),
            'end' => $target_appointment
        ]);
    }

    public function useUnit($unit = 'd')
    {
        $now = Carbon::now();
        $target_appointment = Carbon::parse('this friday 16:00');
        $unit_js = 'countdown.';

        if( $target_appointment->lessThanOrEqualTo($now) ) {
            $isDevBaF = true;
        } else {
            $isDevBaF = false;
        }

        switch($unit)
        {
            case 'sec':
                $unit_hr = 'Sekunde';
                $unit_js .= 'SECONDS';
                $value = $now->diffInSeconds($target_appointment);
                break;
            case 'min':
                $unit_hr = 'Minute';
                $unit_js .= 'MINUTES';
                $value = $now->diffInMinutes($target_appointment);
                break;
            case 'h':
                $unit_hr = 'Stunde';
                $unit_js .= 'HOURS';
                $value = $now->diffInHours($target_appointment);
                break;
            case 'd':
            default:
                $unit_hr = 'Tag';
                $unit_js .= 'DAYS';
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
            'unit_js' => $unit_js,
            'isDevBaF' => $isDevBaF,
            'now' => $now->toDayDateTimeString(),
            'end' => $target_appointment
        ]);
    }
}
