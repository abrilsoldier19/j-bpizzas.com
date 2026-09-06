<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Usuario;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/procesar';


    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'roles' =>['required'],
        ]);
    }

    protected function create(array $data)
    {
        $roleIdValue = 2; 
        
        if (isset($data['roles'])) {
            $rolesArray = is_array($data['roles']) ? $data['roles'] : [$data['roles']];
            $roleSelected = Role::whereIn('name', $rolesArray)->first();
            if ($roleSelected) {
                $roleIdValue = $roleSelected->id;
            }
        }

        $user = Usuario::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id'  => $roleIdValue, 
        ]);
    
        if (isset($data['roles'])) {
            $roles = Role::whereIn('name', $data['roles'])->pluck('id');
            $user->roles()->sync($roles);
        }
    
        return $user;
    }
}
