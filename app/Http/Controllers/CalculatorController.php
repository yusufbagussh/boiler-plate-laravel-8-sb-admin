<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function calculate(Request $request)
    {
        $request->validate([
            'operand1' => 'required|numeric',
            'operand2' => 'required|numeric',
        ]);

        $operator = $request->operator;
        $operand1 = $request->operand1;
        $operand2 = $request->operand2;

        $result = 0;

        switch ($operator) {
            case 'tambah':
                $result = $operand1 + $operand2;
            case 'kurang':
                $result = $operand1 - $operand2;
            case 'kali':
                $result = $operand1 * $operand2;
            case 'bagi':
                $result = $operand1 / $operand2;
        }

        dd($operator, $operand1, $operand2, $result);

        return redirect('/calculation')->with('success', $result);
    }
}
