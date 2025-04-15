<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarRequestRequest;
use App\Models\CarRequest;
use Illuminate\Http\Request;

class CarRequestController extends Controller
{
    public function store(StoreCarRequestRequest $request)
    {
        CarRequest::create([
            'car_id' => $request->carId,
            'credit_program_id' => $request->programId,
            'initial_payment' => $request->initialPayment,
            'loan_term' => $request->loanTerm,
        ]);

        return response()->json(['success' => true]);
    }
}
