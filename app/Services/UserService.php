<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserService extends Service
{
    public $_rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
    ];

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function registerUser($data)
    {
        $this->validate($data);

        if ($this->hasErrors()) {
            return false;
        }

        $data['password'] = Hash::make($data['password']);

        $user = $this->_model->create($data);

        return $user;
    }
    
    public array $credentialRules = [
        'email' => 'required|string|email',
        'password' => 'required|string',
    ];
    

    function login($data) : ?string {
        $this->validate($data, $this->credentialRules);
    
        if ($this->hasErrors()) {
            return null;
        }
    
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];
        $token = auth()->attempt($credentials);
        return $token;
    }
    
}






