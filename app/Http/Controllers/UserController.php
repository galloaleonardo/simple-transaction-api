<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            if ($data = $this->userService->getAll()) {
                return $this->sendSuccessfulResponse($data);
            }
        } catch (\Exception $e) {
            return $this->sendErrorResponse($e->getMessage());
        }

        return $this->sendErrorResponse(
            'Error getting user.',
            JsonResponse::HTTP_BAD_REQUEST
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest  $request
     *
     * @return JsonResponse
     */
    public function store(UserRequest $request): JsonResponse
    {
        $user = $request->validated();
        $user['password'] = Hash::make($user['password']);

        try {
            if ($data = $this->userService->save($user)) {
                return $this->sendSuccessfulResponse(
                    $data,
                    JsonResponse::HTTP_CREATED
                );
            }
        } catch (\Exception $e) {
            return $this->sendErrorResponse($e->getMessage());
        }

        return $this->sendErrorResponse(
            'Error saving user.',
            JsonResponse::HTTP_BAD_REQUEST
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            if ($data = $this->userService->getOne($id)) {
                return $this->sendSuccessfulResponse($data);
            }
        } catch (\Exception $e) {
            return $this->sendErrorResponse($e->getMessage());
        }

        return $this->sendErrorResponse(
            'Error getting user.',
            JsonResponse::HTTP_BAD_REQUEST
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest  $request
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function update(UserRequest $request, int $id): JsonResponse
    {
        $user = $request->validated();

        try {
            if ($data = $this->userService->update($user, $id)) {
                return $this->sendSuccessfulResponse($data);
            }
        } catch (\Exception $e) {
            return $this->sendErrorResponse($e->getMessage());
        }

        return $this->sendErrorResponse(
            'Error updating user.',
            JsonResponse::HTTP_BAD_REQUEST
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            if ($data = $this->userService->destroy($id)) {
                return $this->sendSuccessfulResponse($data);
            }
        } catch (\Exception $e) {
            return $this->sendErrorResponse($e->getMessage());
        }

        return $this->sendErrorResponse(
            'Error deleting user.',
            JsonResponse::HTTP_BAD_REQUEST
        );
    }
}
