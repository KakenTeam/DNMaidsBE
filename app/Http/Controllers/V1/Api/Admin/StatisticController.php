<?php

namespace App\Http\Controllers\V1\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class StatisticController extends Controller
{
    public function bussinessStatisticize(Request $request)
    {

        $request->validate([
            'end_date' => 'date_format:Y-m-d|after:start_date',
            'start_date' => 'date_format:Y-m-d',
            'filter' => 'required',
        ]);

        $end_date = Carbon::now('Asia/Ho_Chi_Minh')->endOfMonth();
        $start_date = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth();



        if ($request->start_date) {
            $start_date = Carbon::createFromFormat('Y-m-d', $request->start_date);
        }
        if ($request->end_date) {
            $end_date = Carbon::createFromFormat('Y-m-d', $request->end_date);
        }


        $start = new Carbon($start_date);
        $user = User::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->where('role', 2)->get();
        $contract = Contract::whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->where('status', '!=', 'unverified')
            ->where('status', '!=', 'verified')
            ->where('status', '!=', 'canceled')
            ->count();


        $canceled = Contract::whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->where('status', 'canceled')
            ->get();

        //single use
        $single = Contract::whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->where('service_type', 1)
            ->where('status', '!=', 'unverified')
            ->where('status', '!=', 'verified')
            ->where('status', '!=', 'canceled')
            ->get();
        $single_income = $single->sum('fee');

        //longterm use
        $longterm = Contract::whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->where('service_type', 0)
            ->where('status', '!=', 'unverified')
            ->where('status', '!=', 'verified')
            ->where('status', '!=', 'canceled')
            ->get();
        $longterm_income = $longterm->sum('fee');
        $totalincome = Contract::whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->where('status', '!=', 'unverified')
            ->where('status', '!=', 'verified')
            ->where('status', '!=', 'canceled')
            ->sum('fee');

        if ($request->filter == 'day') {
            $diff = $end_date->diffInDays($start_date);
            for ($i = 0; $i <= $diff; $i++) {
                //USER
                $user_count = User::whereDate('created_at', $start_date)->where('role', 2)->count();
                $user_per_unit = [
                    'count' => $user_count,
                ];
                //SINGLE CONTRACT
                $single_contract = Contract::whereDate('created_at', $start_date)
                    ->where('service_type', 1)
                    ->where('status', '!=', 'unverified')
                    ->where('status', '!=', 'verified')
                    ->where('status', '!=', 'canceled');

                $single_contract_count = $single_contract->count();
                $single_contract_sum = $single_contract->sum('fee');
                $single_contract_canceled = Contract::whereDate('created_at', $start_date)
                    ->where('service_type', 1)
                    ->where('status', 'canceled')->count();
                $single_contract_per_unit = [
                    'count' => $single_contract_count,
                    'sum' => $single_contract_sum,
                    'canceled' => $single_contract_canceled,
                ];
                //LONG TERM CONTRACT
                $longterm_contract = Contract::whereDate('created_at', $start_date)
                    ->where('service_type', 0)
                    ->where('status', '!=', 'unverified')
                    ->where('status', '!=', 'verified')
                    ->where('status', '!=', 'canceled');

                $longterm_contract_count = $longterm_contract->count();
                $longterm_contract_sum = $longterm_contract->sum('fee');
                $longterm_contract_canceled = Contract::whereDate('created_at', $start_date)
                    ->where('service_type', 0)
                    ->where('status', 'canceled')->count();
                $longterm_contract_per_unit = [

                    'count' => $longterm_contract_count,
                    'sum' => $longterm_contract_sum,
                    'canceled' => $longterm_contract_canceled,
                ];
                $statistic[] = [
                    'time' => $start_date->format('Y-m-d'),
                    'user' => $user_per_unit,
                    'contract' => [
                        'single' => $single_contract_per_unit,
                        'longterm' => $longterm_contract_per_unit,
                    ]
                ];
                $start_date = $start_date->addDay();
            }
        } else if ($request->filter == 'month') {
            $diff = $end_date->diffInMonths($start_date);
            for ($i = 0; $i <= $diff; $i++) {
                //USER
                $user_count = User::whereMonth('created_at', $start_date)->where('role', 2)->count();
                $user_per_unit = [
                    'count' => $user_count,
                ];
                //SINGLE CONTRACT
                $single_contract = Contract::whereMonth('created_at', $start_date)
                    ->where('service_type', 1)
                    ->where('status', '!=', 'unverified')
                    ->where('status', '!=', 'verified')
                    ->where('status', '!=', 'canceled');

                $single_contract_count = $single_contract->count();
                $single_contract_sum = $single_contract->sum('fee');
                $single_contract_canceled = Contract::whereMonth('created_at', $start_date)
                    ->where('service_type', 1)
                    ->where('status', 'canceled')->count();
                $single_contract_per_unit = [
                    'count' => $single_contract_count,
                    'sum' => $single_contract_sum,
                    'canceled' => $single_contract_canceled,
                ];
                //LONG TERM CONTRACT
                $longterm_contract = Contract::whereMonth('created_at', $start_date)
                    ->where('service_type', 0)
                    ->where('status', '!=', 'unverified')
                    ->where('status', '!=', 'verified')
                    ->where('status', '!=', 'canceled');

                $longterm_contract_count = $longterm_contract->count();
                $longterm_contract_sum = $longterm_contract->sum('fee');
                $longterm_contract_canceled = Contract::whereMonth('created_at', $start_date)
                    ->where('service_type', 0)
                    ->where('status', 'canceled')->count();
                $longterm_contract_per_unit = [
                    'count' => $longterm_contract_count,
                    'sum' => $longterm_contract_sum,
                    'canceled' => $longterm_contract_canceled,
                ];
                $statistic[] = [
                    'time' => $start_date->format('Y-m-d'),
                    'user' => $user_per_unit,
                    'contract' => [
                        'single' => $single_contract_per_unit,
                        'longterm' => $longterm_contract_per_unit,
                    ]
                ];
                $start_date = $start_date->addMonth();
                if ($diff == 0) break;
            }
        }

        return response()->json([
            'start_date' => $start->format('Y-m-d'),
            'end_date' => $end_date->format('Y-m-d'),
            'data' => [
                'statistic' => $statistic,
                'total_new_customer_count' => count($user),
                'total_contract' => [
                    'new_contract_count' => $contract,
                    'canceled_contract_count' => count($canceled),
                    'total_income' => $totalincome,
                    'single_contract' => [
                        'count' => count($single),
                        'total_income' => $single_income,
                    ],
                    'longterm_contract' => [
                        'count' => count($longterm),
                        'total_income' => $longterm_income,
                    ]
                ],
            ],
        ], 200);
    }


}
