<?php

namespace App\Http\Controllers\V1\Api\Admin;

use App\Models\Contract;
use Illuminate\Auth\Access\AuthorizationException;
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
        try {
            $this->authorize('index', new Contract());
            $contracts = Contract::with(['customer', 'helper', 'creator'])->orderBy('status')->get();

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
    public function show(Request $request, Contract $contract)
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
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



}
