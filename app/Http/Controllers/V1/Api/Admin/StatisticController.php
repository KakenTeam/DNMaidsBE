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
            'end_date' => 'date_format:Y-m-d|after: start_date',
            'start_date' => 'date_format:Y-m-d',
            'filter' => 'required',
        ]);

        $end_date = Carbon::now()->endOfMonth();
        $start_date = Carbon::now()->startOfMonth();
        if ($request->start_date) {
            $start_date = Carbon::createFromFormat('Y-m-d', $request->start_date);
        }
        if ($request->end_date) {
            $end_date = Carbon::createFromFormat('Y-m-d', $request->end_date);
        }
        $user = User::where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->where('role', 2)->get();
        $contract = Contract::where('created_at', '>=', $start_date)
            ->where('created_at', '<=', $end_date)
            ->where('status', '!=', 'unverified')->get();


        $canceled = Contract::where('created_at', '>=', $start_date)
            ->where('created_at', '<=', $end_date)
            ->where('status', 'canceled')
            ->get();

        //single use
        $single = Contract::where('created_at', '>=', $start_date)
            ->where('created_at', '<=', $end_date)
            ->where('service_type', 1)
            ->where('status', '!=', 'verified')
            ->where('status', '!=', 'unverified')
            ->get();
        $single_income = $single->sum('fee');

        //longterm use
        $longterm = Contract::where('created_at', '>=', $start_date)
            ->where('created_at', '<=', $end_date)
            ->where('service_type', 0)
            ->where('status', '!=', 'verified')
            ->where('status', '!=', 'unverified')
            ->get();
        $longterm_income = $longterm->sum('fee');
        $totalincome = Contract::where('created_at', '>=', $start_date)
            ->where('created_at', '<=', $end_date)
            ->where('status', '!=', 'verified')
            ->where('status', '!=', 'unverified')
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
                    ->where('status', '!=', 'unverified');

                $single_contract_count = $single_contract->where('status', '!=', 'verified')->count();
                $single_contract_sum = $single_contract->where('status', '!=', 'verified')->sum('fee');
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
                    ->where('status', '!=', 'unverified');

                $longterm_contract_count = $longterm_contract->where('status', '!=', 'verified')->count();
                $longterm_contract_sum = $longterm_contract->where('status', '!=', 'verified')->sum('fee');
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
                    ->where('status', '!=', 'unverified');

                $single_contract_count = $single_contract->where('status', '!=', 'verified')->count();
                $single_contract_sum = $single_contract->where('status', '!=', 'verified')->sum('fee');
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
                    ->where('status', '!=', 'unverified');

                $longterm_contract_count = $longterm_contract->where('status', '!=', 'verified')->count();
                $longterm_contract_sum = $longterm_contract->where('status', '!=', 'verified')->sum('fee');
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
            }
        }

        return response()->json([
            'end_date' => $end_date,
            'start_date' => $start_date,
            'data' => [
                'statistic' => $statistic,
                'total_new_customer_count' => count($user),
                'total_contract' => [
                    'new_contract_count' => count($contract),
                    'canceled_contract_count' => count($canceled),
                    'total_income' => $totalincome,
                    'onetime_contract' => [
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
