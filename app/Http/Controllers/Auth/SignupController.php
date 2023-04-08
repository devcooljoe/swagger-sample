<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignupRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;

/**
 * Summary of SignupController
 */
class SignupController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/auth/signup",
     *     tags={"Auth"},
     *     summary="Register any user of any type",
     *     description="Register new user",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 schema="Request",
     *                 title="Register Title",
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="confrim_password",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *      ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation",
     *     ),
     * )
     */

    public function signup(SignupRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $token = $user->createToken('authToken')->accessToken;

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'data' => [
                'user' => new UserResource($user),
                'authToken' => $token,
            ],
        ]);
    }
}
