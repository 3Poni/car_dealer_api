<?php

namespace App\Services;

use App\Models\CreditProgram;

class CreditCalculator
{
    /**
     * Расчёт ежемесячного платежа и выбор кредитной программы
     *
     * @param float $price — Цена автомобиля
     * @param float $initialPayment — Первоначальный взнос
     * @param int $loanTerm — Срок кредита в месяцах
     * @return array
     */
    public function calculate(float $price, float $initialPayment, int $loanTerm): array
    {
        $loanAmount = $price - $initialPayment;

        if ($loanAmount <= 0) {
            throw new \Exception('Первоначальный взнос должен быть больше суммы кредита.');
        }

        $programs = CreditProgram::all();
        $best = null;

        foreach ($programs as $program) {
            $rate = $program->interest_rate;
            $monthlyRate = $rate / 12 / 100;
            $monthlyPayment = $loanAmount * ($monthlyRate * pow(1 + $monthlyRate, $loanTerm)) / (pow(1 + $monthlyRate, $loanTerm) - 1);
            $monthlyPayment = ceil($monthlyPayment);

            if (!$best || $monthlyPayment < $best['monthlyPayment']) {
                $best = [
                    'programId' => $program->id,
                    'interestRate' => round($rate, 1),
                    'monthlyPayment' => $monthlyPayment,
                    'title' => $program->title,
                ];
            }
        }

        return $best;
    }
}
