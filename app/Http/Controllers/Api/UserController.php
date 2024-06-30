<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        $id = $request->route('user');
        $result = $this->userService->show($id);

        return response()->json($result['data'], $result['status']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request): JsonResponse
    {
        $id = $request->route('user');
        $validatedData = $request->validated();
        $result = $this->userService->update($id, $validatedData);

        return response()->json($result['data'], $result['status']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        $id = $request->route('user');
        $result = $this->userService->destroy($id);

        return response()->json($result['data'], $result['status']);
    }
}
