<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function balance()
    {
        return response()->json(['balance' => Auth::user()->balance]);
    }

    public function deposit(Request $request)
    {
        $request->validate(['amount' => 'required|numeric|min:1']);
        Auth::user()->deposit($request->amount);
        return response()->json(['message' => 'Deposit successful']);
    }

    public function withdraw(Request $request)
    {
        $request->validate(['amount' => 'required|numeric|min:1']);
        Auth::user()->withdraw($request->amount);
        return response()->json(['message' => 'Withdrawal successful']);
    }

    public function forceWithdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'description' => 'required|string'
        ]);
        Auth::user()->forceWithdraw($request->amount, ['description' => $request->description]);
        return response()->json(['message' => 'Forced withdrawal successful']);
    }
}
