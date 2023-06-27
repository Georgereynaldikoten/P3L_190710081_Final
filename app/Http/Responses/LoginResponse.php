<?php

namespace App\Http\Responses;

use App\Models\Role;
use App\Models\User;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {   
        return $request->wantsJson()
        ? response()->json(['two_factor' => false])
        : $this->redirect();
    }
    
    private function redirect()
    {
        $roles = Role::all();
        foreach ($roles as $role) 
        {
           if(auth()->user()->level == $role->role_name)
                return redirect($role->redirect_to);
            elseif(auth()->user()->level == 'member'|| auth()->user()->level == 'instructure')
                return abort(403);
        }
    }
}