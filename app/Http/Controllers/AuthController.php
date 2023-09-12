<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request $request)
    {
        $input = $request->all();

        $user = $this->userService->registerUser($input);

        if (!$user) {
            return response()->json(['errors' => $this->userService->getErrors()], 400);
        }

        return response()->json(['message' => 'Registered succesfully'], 200);
    }

    public function login(Request $request)
    {
        $input = $request->all();

        if (!$this->userService->login($input)) {
            return response()->json(['errors' => 'Invalid credentials'], 401);
        }

        $token = $this->userService->login($input);

        return response([
            "status" => "success"
        ], 200)->withCookie(
            'token',
            $token,
            config('jwt.ttl'),
            '/',
            null,
            true,
            true,
            false,
            "None"
        );
        
        
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }
    

}

/*

data body post request login = 
{
    "email": "tester@outlook.com",
    "password": "password123"
}
*/

/*

data body post request register = 
{
    "name": "tester",
    "email": "tester@outlook.com",
    "password": "password123"

*/