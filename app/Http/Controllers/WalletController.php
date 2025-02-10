<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Tag(
 *     name="Wallet",
 *     description="Wallet operations for deposit, withdrawal, and balance checks"
 * )
 */
class WalletController extends Controller
{
    /**
     * Get user wallet balance
     * 
     * @OA\Get(
     *     path="/api/wallet/balance",
     *     summary="Get user wallet balance",
     *     tags={"Wallet"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(response=200, description="Wallet balance retrieved successfully"),
     *     @OA\Response(response=401, description="Unauthorized"),
     * )
     */

    public function balance()
    {
        return response()->json(['balance' => Auth::user()->balance]);
    }
    /**
     * Deposit funds into the user's wallet
     * 
     * @OA\Post(
     *     path="/api/wallet/deposit",
     *     summary="Deposit money into wallet",
     *     tags={"Wallet"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"amount"},
     *             @OA\Property(property="amount", type="number", example=100)
     *         )
     *     ),
     *     @OA\Response(response=200, description="Deposit successful"),
     *     @OA\Response(response=400, description="Invalid input"),
     *     @OA\Response(response=401, description="Unauthorized"),
     * )
     */
    public function deposit(Request $request)
    {
        $request->validate(['amount' => 'required|numeric|min:1']);
        Auth::user()->deposit($request->amount);
        return response()->json(['message' => 'Deposit successful']);
    }
    /**
     * Withdraw funds from the user's wallet
     * 
     * @OA\Post(
     *     path="/api/wallet/withdraw",
     *     summary="Withdraw money from wallet",
     *     tags={"Wallet"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"amount"},
     *             @OA\Property(property="amount", type="number", example=50)
     *         )
     *     ),
     *     @OA\Response(response=200, description="Withdrawal successful"),
     *     @OA\Response(response=400, description="Invalid input"),
     *     @OA\Response(response=401, description="Unauthorized"),
     * )
     */
    public function withdraw(Request $request)
    {
        $request->validate(['amount' => 'required|numeric|min:1']);
        Auth::user()->withdraw($request->amount);
        return response()->json(['message' => 'Withdrawal successful']);
    }
    /**
     * Force withdraw funds (allow negative balance)
     * 
     * @OA\Post(
     *     path="/api/wallet/forceWithdraw",
     *     summary="Force withdraw money from wallet (can result in a negative balance)",
     *     tags={"Wallet"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"amount", "description"},
     *             @OA\Property(property="amount", type="number", example=200),
     *             @OA\Property(property="description", type="string", example="Payment for services")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Forced withdrawal successful"),
     *     @OA\Response(response=400, description="Invalid input"),
     *     @OA\Response(response=401, description="Unauthorized"),
     * )
     */
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
