<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Morilog\Jalali;
use Morilog\Jalali\Jalalian;

class persianDateTimeController extends Controller
{
    public static function gregorianToPersian(DateTime $gdate)
    {
        $persianDate = Jalalian::forge($gdate)->format('%A, %d %B %Y ساعت : %H:%M:%S');
        return $persianDate;
    }
}
