<?php

namespace App\Http\Controllers\V1\Api\Admin;

use App\Http\Requests\StoreEmpContractRequest;
use App\Http\Requests\UpdateEmpContractRequest;

use App\Models\EmployeeContract;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class EmpContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $this->authorize('index', new EmployeeContract());
            $contracts = EmployeeContract::with('user')->get();

            return response()->json([
                'success' => 'true',
                'data' => $contracts,
            ], 200);
        }catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'Bạn không có quyền để thực hiện hành động này.',
            ], 403);
        }
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
            $emp_contract->expired_date = Carbon::createFromFormat('Y-m-d', $request->valid_date, null)
                    ->addMonths($request->duration)->format('Y-m-d');

            if ($emp_contract->save()) {
                return response()->json([
                    'message' => 'Tạo hợp đồng lao động thành công.',
                    'data' => $emp_contract,
                ], 201);
            }
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'Bạn không có quyền để thực hiện hành động này.',
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
                'message' => 'Lấy thông tin hợp đồng lao động thành công.',
            ], 200);
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'Bạn không có quyền để thực hiện hành động này.',
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
                    'message' => 'Xóa hợp đồng lao động thành công.',
                ], 204);
            }
        }catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'Bạn không có quyền để thực hiện hành động này.',
            ], 403);
        }
    }
}
