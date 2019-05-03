<?php

namespace App\Http\Controllers\V1\Api\Admin;

use App\Http\Requests\UpdateContractRequest;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $this->authorize('index', new Contract());
            $contracts = Contract::with(['customer', 'helper', 'creator']);

            if ($request->for == 'helper') {
                $contracts->whereHas('helper', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                });
            }
            if ($request->for == 'customer') {
                $contracts->whereHas('customer', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                });
            }
            if ($request->for == 'phone') {
                $contracts->whereHas('customer', function ($query) use ($request) {
                    $query->where('phone', 'like', '%' . $request->search . '%');
                });
            }
            if ($request->for == 'status') {
                $contracts->where('status','like', '%' . $request->search . '%' );
            }
            $contracts = $contracts->orderBy('created_at','desc');
            if ($request->page) {
                $contracts = $contracts->paginate(10);
                $contracts->appends(['search' => $request->search, 'for' => $request->for]);
            } else {
                $contracts = $contracts->get();
            }

            return response()->json([
                'success' => 'true',
                'data' => $contracts,
            ], 200);
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'This Action is Unauthorized',
            ], 403);
        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        try {
            $this->authorize('view', $contract);
            return response()->json([
                'success' => 'true',
                'data' => $contract,
            ], 200);
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'This Action is Unauthorized',
            ], 403);
        }

    }

    /**
     * Update status specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Contract $contract
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, Contract $contract)
    {
        try {
            $this->authorize('update', $contract);
            $request->validate([
                'status' => 'required | string',
                'last_editor_id' => 'required | numeric',
            ]);
            $contract->update([
                'status' => $request->status,
            ]);

            return response()->json([
                'success' => 'true',
                'message' => 'Successfully Updated Contract Status',
            ], 200);
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'This Action is Unauthorized',
            ], 403);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContractRequest $request, Contract $contract)
    {
        try {
            $this->authorize('update', $contract);
            $contract->update($request->all());

            return response()->json([
                'success' => 'true',
                'message' => 'Successfully Updated Contract',
            ], 200);
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'This Action is Unauthorized',
            ], 403);
        }
    }

    public function findHelper(Contract $contract)
    {
        $start_date = $contract->start_date;
        $end_date = $contract->end_date;

        $schedule_list = $contract->with('schedule')
            ->get();
        $result = User::with(['helpersContracts.schedule'])
            ->where('role', 1)
            ->orderBy('id')
            ->get();
        $check = false;

        $available = [];

        foreach ($result as $user) {
            $check = false;
            foreach ($user->helpersContracts as $c) {
                if ($c->start_date > $end_date
                    || $c->end_date < $start_date) {
                    continue;
                } else foreach ($contract->schedule as $item) {
                    foreach ($c->schedule as $schedule) {
                        if ($schedule->day_of_week == $item->day_of_week
                            && $schedule->shift == $item->shift) {
                            $check = true;
                            break;
                        }
                    }
                    if ($check) {
                        break;
                    }
                }
            }
            if (!$check) {
                $available[] = $user;
            }
        }

        return response()->json([
            'total' => count($available),
            'data' => $available,
        ]);
    }
}
