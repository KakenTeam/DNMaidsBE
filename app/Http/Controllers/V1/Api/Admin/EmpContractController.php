<?php

namespace App\Http\Controllers\V1\Api\Admin;

use App\Http\Requests\StoreEmpContractRequest;
use App\Http\Requests\UpdateEmpContractRequest;
use App\Models\Contract;
use App\Models\EmployeeContract;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmpContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(StoreEmpContractRequest $request)
    {
        try {
            $emp_contract = new EmployeeContract();
            $this->authorize('create', $emp_contract);
            $emp_contract->fill($request->all());

            if ($emp_contract->save()) {
                return response()->json([
                    'message' => 'Successfully Created Employee Contract.',
                    'data' => $emp_contract,
                ], 201);
            }
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'This Action is Unauthorized',
            ], 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeContract $emp_contract)
    {
        try {
            $this->authorize('view', $emp_contract);
            return response()->json([
                'success' => 'true',
                'data' => $emp_contract,
                'message' => 'Successfully Get Employee Contract.',
            ], 200);
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'This Action is Unauthorized',
            ], 403);
        }
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
    public function update(UpdateEmpContractRequest $request, EmployeeContract $emp_contract)
    {
        try {
            $this->authorize('update', $emp_contract);
            $emp_contract->update($request->all());

            return response()->json([
                'success' => 'true',
                'data' => $emp_contract,
                'message' => 'Successfully Update Employee Contract.',
            ], 200);
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'This Action is Unauthorized',
            ], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeContract $emp_contract)
    {
        try {
            $this->authorize('delete', $emp_contract);
            if($emp_contract->delete()) {
                return response()->json([
                    'message' => 'Successfully Delete Employee Contract.',
                ], 204);
            }
        }catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'This Action is Unauthorized',
            ], 403);
        }
    }
}
