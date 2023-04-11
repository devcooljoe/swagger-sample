<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SendEmailVerificationCodeRequest;
use App\Http\Requests\Auth\SignupRequest;
use App\Http\Resources\User\UserResource;
use App\Mail\SendVerificationCodeEmail;
use App\Models\User;
use Mail;

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
     *                     property="password_confirmation",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *      ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation",
     *        @OA\JsonContent(),
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

    /**
     * @OA\Post(
     *     path="/api/auth/sendEmailVerificationCode",
     *     tags={"Auth"},
     *     summary="Send an email verification code to the user",
     *     description="Send an email verification code to the user",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 schema="Request",
     *                 title="Email Verification Title",
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *      ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation",
     *        @OA\JsonContent(),
     *     ),
     *    security={{ "Bearer": {}}},
     * )
     */
    public function sendEmail(SendEmailVerificationCodeRequest $request)
    {
        Mail::to($request->email)->send(new SendVerificationCodeEmail(auth()->user(), '555555'));
        return response()->json([
            'status' => 'success',
            'message' => 'Verification code sent successfully',
            'data' => null,
        ]);
    }
}
