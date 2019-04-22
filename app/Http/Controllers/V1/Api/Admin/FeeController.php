<?php

namespace App\Http\Controllers\V1\Api\Admin;

use App\Models\FeeIndex;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class FeeController extends Controller
{
    public function fee(Request $request)
    {
        $base =  FeeIndex::where('code', 'base')->first()->value;
        $threehours = FeeIndex::where('code', 'threehours')->first()->value;
        $overthree = FeeIndex::where('code', 'overthree')->first()->value;
        $weekend = FeeIndex::where('code', 'weekend')->first()->value;
        $end_date = Carbon::createFromDate($request->end_date);
        $start_date = Carbon::createFromDate($request->start_date);
        $sum = 0;
        $week_count = $end_date->diffInWeeks($start_date);

        foreach ($request->schedule as $item) {

            $start_time = Carbon::createFromFormat('H:i:s', $item["start_time"]);
            $end_time = Carbon::createFromFormat('H:i:s', $item["end_time"]);
            $work_time = $end_time->diffInHours($start_time);
            $to_money = $work_time* $base;
            if ($work_time == 3) {
                $to_money *= (1-$threehours);
            } else if ($work_time > 3) {
                $to_money *= (1-$overthree);
            }
            if($item['day_of_week'] == 1 || $item['day_of_week'] == 7) {
                $to_money *= (1-$weekend);
            }
            $sum += $to_money;
        }
        if ($week_count != 0) {
            $sum *= $week_count;
        }

        return response()->json([
            $sum
        ], 200);
    }
}
