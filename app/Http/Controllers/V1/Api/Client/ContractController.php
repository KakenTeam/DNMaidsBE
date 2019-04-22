<?php

namespace App\Http\Controllers\V1\Api\Client;

use App\Http\Requests\StoreContractRequest;
use App\Http\Resources\ContractResource;
use App\Models\Contract;
use App\Models\ContractSchedule;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $contract = Contract::with(['helper', 'schedule'])
            ->where('customer_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json([
            'success' => 'true',
            'message' => 'Successfully Get Contracts',
            'info' => [
                'total' => $contract->total(),
                'last_item' => $contract->lastItem(),
                'per_page' => $contract->perPage(),
                'previous_url' => $contract->previousPageUrl(),
                'next_url' => $contract->nextPageUrl(),
                'data' => ContractResource::collection($contract),
                ]
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContractRequest $request)
    {
        $contract = new Contract();


        $contract->fill($request->all());
        $contract->customer_id = $request->user()->id;
        //Fee Formula  HERE

            $contract->fee = '200000';


        //End Fee Formula



        if ($contract->save()) {
            foreach ($request->schedule as $item){
                $schedule = new ContractSchedule();
                $schedule->fill($item);
                $contract->schedule()->save($schedule);
            }
            return response()->json([
                'success' => 'true',
                'message' => 'Successfully Created Contract',
                'data' => $contract,
            ], 201);
        }
        return response()->json([
            'message' => 'Something wrong happened',
        ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
