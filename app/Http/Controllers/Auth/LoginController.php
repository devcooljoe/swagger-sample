<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     tags={"Auth"},
     *     summary="Login any user of any type",
     *     description="Login the user",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 schema="Request",
     *                 title="Login Title",
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *      ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation",
     *       @OA\JsonContent(),
     *     ),
     * )
     */

    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->accessToken;

            return response()->json([
                'status' => 'success',
                'message' => 'Login successful',
                'data' => [
                    'user' => new UserResource($user),
                    'authToken' => $token,
                ],
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Credentials',
                'data' => null,
            ], 401);
        }
    }
}
