<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalculateCreditRequest;
use App\Services\CreditCalculator;
use Illuminate\Http\JsonResponse;

class CreditCalculatorController extends Controller
{
    protected $creditCalculator;

    public function __construct(CreditCalculator $creditCalculator)
    {
        $this->creditCalculator = $creditCalculator;
    }
    public function calculate(CalculateCreditRequest $request): JsonResponse
    {

        $validated = $request->validated();

        try {
            $result = $this->creditCalculator->calculate(
                $validated['price'],
                $validated['initialPayment'],
                $validated['loanTerm']
            );

            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
