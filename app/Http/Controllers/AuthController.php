<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => [
                'login',
                'create',
                'Unauthorized'
            ]
        ]);
    }

    public function create(Request $request){
        $array = ['error' => ''];

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $birthdate = $request->input('birthdate');

        if($name && $email && $password && $birthdate){
            if(strtotime($birthdate) == false){
                $array['error'] = 'Data de nascimento inválida';
                return $array;
            }

            $validaEmail = User::where('email', $email)->count();
            if($validaEmail === 0){
                $hash = password_hash($password, PASSWORD_DEFAULT);

                $newUser = new User();
                $newUser->name = $name;
                $newUser->email = $email;
                $newUser->password = $hash;
                $newUser->birthdate = $birthdate;
                $newUser->save();

                $token = Auth::attempt(['email' => $email, 'password' => $password]);

                if(!$token){
                    $array['error'] = 'Ocorreu um erro!';
                    return $array;
                }
                $arrayn['token'] = $token;
            }else{
                $array['erro'] = 'O e-mail informado já existe';
                return $array;
            }
        }else{
            $array['error'] = 'Favor enviar todos os campos';
            return $array;
        }

        return $array;
    }
}
