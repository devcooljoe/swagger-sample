<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/auth/logout",
     *     tags={"Auth"},
     *     description="Logout the user",
     *     @OA\Response(
     *         response="200",
     *         description="Logged out successfully",
     *     ),
     *     security={{ "Bearer": {}}}
     * )
     */
    public function logout()
    {
        $user = Auth::user()->token();
        $user->revoke();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully',
            'data' => null,
        ], 200);
    }
}
