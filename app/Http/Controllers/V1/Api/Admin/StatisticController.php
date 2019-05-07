<?php

namespace App\Http\Controllers\V1\Api\Admin;

use App\Models\Contract;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class StatisticController extends Controller
{
    public function bussinessStatisticize(Request $request)
    {

        $request->validate([
            'end_date' => 'date_format:Y-m-d|after: start_date',
            'start_date' => 'date_format:Y-m-d',
        ]);

        $end_date = Carbon::now()->endOfMonth();
        $start_date = Carbon::now()->startOfMonth();
        if ($request->start_date) {
            $start_date = $request->start_date;
        }
        if ($request->end_date) {
            $end_date = $request->end_date;
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

        return response()->json([
            'end_date' => $end_date,
            'start_date' => $start_date,
            'data' => [
                'new_customer_count' => count($user),
                'contract' => [
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
