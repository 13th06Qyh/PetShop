<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AccountServices
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAll(): Collection
    {
        return $this->user->all();
    }

    public function getAllPaginate()
    {
        return $this->user->paginate(10);
    }

    public function findOne($id)
    {
        return $this->user->find($id);
    }

    // public function getLoggedInUser(): User
    // {
    //     return Auth::user();
    // }

    public function create($request): bool
    {
        $new = new User([
            'username' => $request->name,
            'email' => $request->email,
            'sdt' => $request->sdt,
            'password' => bcrypt($request->password),
            'role' => 'user',
        ]);
        return $new->save();
    }

    public function updateuser($id, $request)
    {
        $user = $this->findOne($id);
        $user->username = $request->tentk;
        $user->email = $request->mail;
        $user->sdt = $request->sdt;
        return $user->update();
    }

/**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function delete($id)
    {
        $item = $this->findOne($id);
        if ($item){
            $item->delete();
        }
    }

    public function checkLogin($username, $password)
    {
        $user = $this->user->where('username', $username)->first();
        if ($user) {
            // \dd($user->blacklist);
            if ($user->blacklist == null) {
                if (password_verify($password, $user->password)) {
                    return $user;
                }
            }
            return $user->blacklist;
            
        }
        return false;
    }

    public function checkName($request){
        return $this->user->where('username', 'like', '%'.$request->name.'%')
                          ->get()
                          ->isNotEmpty();
    }

    public function checkEmail($request){
        return $this->user->where('email', 'like', '%'.$request->email.'%')
                          ->get()
                          ->isNotEmpty();
        
    }

    public function checkSDT($request){
        $sdt = $this->user->where('sdt', 'like', '%'.$request->sdt.'%')
                          ->get()
                          ->isNotEmpty();
        if ((!$sdt)&&((strlen($request->sdt) == 9))) {
            // \dd(strlen($request->sdt));
            return true;
        }
        else{
            return false;

        }
    }

    public function lock($id, $request){
        $user = $this->findOne($id);
        if ($user->blacklist == null) {
            $user->blacklist = 'yes';
            $user->note = $request->note;
            return $user->update();
        }else {
            $user->blacklist = null;
            $user->note = null;
            return $user->update();
        }
        
    }

    public function getBlacklist(){
        return $this->user->where('blacklist', 'yes')
                          ->get();
    }
    
}