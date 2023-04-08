<?php

namespace App\Http\Controllers;

use App\Http\Helpers\UploadHelper;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/app/getUsers",
     *     tags={"Users"},
     *     description="Get all users on the database",
     *
     *      @OA\Parameter(
     *          in="query",
     *          name="page",
     *      ),
     *      @OA\Parameter(
     *          in="query",
     *          name="PageSize",
     *      ),
     *
     *     @OA\Response(
     *         response="200",
     *         description="Users fetched successfully",
     *     ),
     *     security={{ "Bearer": {}}}
     * )
     */
    public function get_user(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Users fetched successfully',
            'data' => UserResource::collection(User::paginate($request->PageSize ?? 10)),
        ], 200);
    }


    /**
     * @OA\Put(
     *     path="/api/app/updatePicture",
     *     tags={"Users"},
     *     description="Update user picture",
     *
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 schema="Request",
     *                 title="Upload Picture",
     *                 required={"Picture"},
     *                 @OA\Property(
     *                     property="Picture",
     *                     type="string",
     *                     format="binary",
     *                 ),
     *             )
     *         )
     *      ),
     *     security={{ "Bearer": {}}},
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation",
     *     ),
     * )
     */
    public function uploadPicture(Request $request): JsonResponse
    {

       $response = (new UploadHelper())->uploadFile($request->file('Picture'));

        return response()->json([
            'status' => 'success',
            'message' => 'File uploaded successfully',
            'data' => $response,
        ], 200);
    }
}
