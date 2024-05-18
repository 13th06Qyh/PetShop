<?php

namespace App\Http\Controllers;

use App\Http\Services\AccountServices;
use App\Models\User;
// use App\Http\Requests\StoreAccountRequest;
// use App\Http\Requests\UpdateAccountRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    private AccountServices $accountService;
    public function __construct(AccountServices $accountService)
    {
        $this->accountService = $accountService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    // public function index(): View|Factory|Application
    // {
    //     $user = $this->accountService->getAll();
    //     return view('user.pages.index', compact('user'));
    // }

    public function index()
    {
        $users = $this->accountService->getAll();
        return view('admin.pages.adminQLuser', compact('users'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('sigin.view');
    }

    public function createadmin(): View|Factory|Application
    {
        return view('admin.pages.adduser');
    }
    /**
     * 
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $users = $this->accountService->checkName($request);
        if (!$users) {
            $usermail = $this->accountService->checkEmail($request);
            if (!$usermail) {
                $usersdt = $this->accountService->checkSDT($request);
                if ($usersdt==true) {
                    $this->accountService->create($request);
                    return redirect()->route('login.view');
                }
                else {
                    session()->flash('error', 'SĐT đã được sử dụng hoặc không hợp lệ!');
                    return redirect()->back()->withInput();
                }
            }
            else {
                session()->flash('error', 'Email đã được sử dụng!');
                return redirect()->back()->withInput();
            }
            
        }
        else {
            session()->flash('error', 'Tên người dùng đã tồn tại');
            return redirect()->back()->withInput();
        }
        
    }

    public function storeadmin(Request $request)
    {
        $users = $this->accountService->checkName($request);
        if (!$users) {
            $usermail = $this->accountService->checkEmail($request);
            if (!$usermail) {
                $usersdt = $this->accountService->checkSDT($request);
                // \dd($usersdt);
                if ($usersdt==true) {
                    $this->accountService->create($request);
                    return redirect()->route('admin.customer');
                }
                else {
                    session()->flash('error', 'SĐT đã được sử dụng hoặc không hợp lệ!');
                    return redirect()->back()->withInput();
                }
            }
            else {
                session()->flash('error', 'Email đã được sử dụng!');
                return redirect()->back()->withInput();
            }
        }
        else {
            session()->flash('error', 'Ten người dùng đã tồn tại');
            return redirect()->back()->withInput();
        }
        // $this->accountService->create($request);
        // return redirect()->route('admin.customer');
    }

    public function getLogin(Request $request): RedirectResponse
    {
        $users = $this->accountService->checkLogin($request->username, $request->password);
        // \dd($users);
        if ($users) {
            if ($users != 'yes') {
                auth()->login($users);
                if (!auth()->check()) return redirect()->route('login.view');
                return redirect()->route('user.view');
            }
            else
            {
                session()->flash('error', 'Tài khoản đã bị khoá!');
                return redirect()->back()->withInput();
            }
            
            
        }
            else
            {
                session()->flash('error', 'Tên đăng nhập hoặc mật khẩu sai!');
                return redirect()->back()->withInput();
            }

    }

    public function logout(){
        auth()->logout();
        return redirect()->route('login.view');
    }

    public function updateuser(Request $request, $id): RedirectResponse
    {
        $this->accountService->updateuser($id, $request);
        return redirect()->route('account.view');
    }

    public function updateadmin(Request $request, $id): RedirectResponse
    {
        $this->accountService->updateuser($id, $request);
        return redirect()->route('admin.customer');
    }

    public function destroy($id): RedirectResponse
    {
        $this->accountService->delete($id);
        return redirect()->route('admin.customer');
    }

    public function change(Request $request, $id): RedirectResponse
    {
        $user = $this->accountService->findOne($id);
        if (password_verify($request->current_password, auth()->user()->password)) {
        
            $newPassword = $request->password1;
            $confirmPassword = $request->password2;

            if ($newPassword === $confirmPassword && strlen($newPassword) >= 8) {
                // Hash and update the new password
                $user->password = password_hash($newPassword, PASSWORD_BCRYPT);
                if ($user->update()) {
                    // đổi oke
                    session()->flash('error', 'Mật khẩu đã được cập nhật thành công.');
                    return redirect()
                        ->route('account.view');
                        // ->with('success', 'Mật khẩu đã được cập nhật thành công.');
                } else {
                    session()->flash('error', 'Có lỗi xảy ra. Vui lòng thử lại.');
                    return redirect()
                        ->back();
                        // ->with('error', 'Có lỗi xảy ra. Vui lòng thử lại.');
                }

            } else {
                session()->flash('error', 'Mật khẩu mới không khớp hoặc không đủ độ dài.');
                return redirect()
                    ->back();
                    // ->with('error', 'Mật khẩu mới không khớp hoặc không đủ độ dài.');
            }
        } else {
            // pass cũ k đúm
            session()->flash('error', 'Mật khẩu hiện tại không đúng.');
            return redirect()
                ->back();
                // ->with('error', 'Mật khẩu hiện tại không đúng.');
        }
    }

    public function lock($id, Request $request): RedirectResponse
    {
        $this->accountService->lock($id, $request);
        return redirect()->route('admin.customer');
    }

    public function blacklist()
    {
        $users = $this->accountService->getBlacklist();
        return view('admin.pages.adminBlackList', compact('users'));
    }

   
}