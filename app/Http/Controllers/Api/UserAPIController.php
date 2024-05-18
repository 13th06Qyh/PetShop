<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\AccountServices;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAPIController extends Controller
{
    private AccountServices $accountService;

    public function __construct(AccountServices $accountService)
    {
        $this->accountService = $accountService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = $this->accountService->getAll();
        return response()->json($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $existingUser = $this->accountService->checkName($validated['name']);
        if ($existingUser) {
            return response()->json(['error' => 'Tên người dùng đã tồn tại'], 409);
        }

        $existingEmail = $this->accountService->checkEmail($validated['email']);
        if ($existingEmail) {
            return response()->json(['error' => 'Email đã được sử dụng'], 409);
        }

        $existingPhone = $this->accountService->checkSDT($validated['phone']);
        if ($existingPhone) {
            return response()->json(['error' => 'SĐT đã được sử dụng hoặc không hợp lệ!'], 409);
        }

        $this->accountService->create($request);
        return response()->json(['message' => 'User created successfully'], 201);
    }

    /**
     * Login the user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getLogin(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = $this->accountService->checkLogin($validated['username'], $validated['password']);
        if ($user) {
            if ($user === 'yes') {
                return response()->json(['error' => 'Tài khoản đã bị khóa!'], 403);
            }

            Auth::login($user);
            if (!Auth::check()) {
                return response()->json(['error' => 'Login failed'], 401);
            }

            return response()->json(['message' => 'Login successful'], 200);
        }

        return response()->json(['error' => 'Tên đăng nhập hoặc mật khẩu sai!'], 401);
    }

    /**
     * Logout the user.
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        Auth::logout();
        return response()->json(['message' => 'Logout successful'], 200);
    }

    /**
     * Update the specified user.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateuser(Request $request, $id): JsonResponse
    {
        $this->accountService->updateuser($id, $request);
        return response()->json(['message' => 'User updated successfully'], 200);
    }

    /**
     * Remove the specified user from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $this->accountService->delete($id);
        return response()->json(['message' => 'User deleted successfully'], 200);
    }

    /**
     * Change user's password.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function change(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'current_password' => 'required|string',
            'password1' => 'required|string|min:8|confirmed',
            'password2' => 'required|string|min:8',
        ]);

        $user = $this->accountService->findOne($id);

        if (!Hash::check($validated['current_password'], auth()->user()->password)) {
            return response()->json(['error' => 'Mật khẩu hiện tại không đúng'], 403);
        }

        if ($validated['password1'] !== $validated['password2']) {
            return response()->json(['error' => 'Mật khẩu mới không khớp hoặc không đủ độ dài'], 400);
        }

        $user->password = Hash::make($validated['password1']);
        if ($user->update()) {
            return response()->json(['message' => 'Mật khẩu đã được cập nhật thành công.'], 200);
        }

        return response()->json(['error' => 'Có lỗi xảy ra. Vui lòng thử lại.'], 500);
    }

    /**
     * Lock the user account.
     *
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function lock($id, Request $request): JsonResponse
    {
        $this->accountService->lock($id, $request);
        return response()->json(['message' => 'User account locked successfully'], 200);
    }

    /**
     * Get all blacklisted users.
     *
     * @return JsonResponse
     */
    public function blacklist(): JsonResponse
    {
        $users = $this->accountService->getBlacklist();
        return response()->json($users, 200);
    }
}