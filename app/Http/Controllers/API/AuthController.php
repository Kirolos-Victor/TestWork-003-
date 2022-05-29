<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, User $user)
    {
        $data = $user->saveUser($request)->generateAndSaveApiAuthToken();
        return responseJson(200, 'Successfully registered', $data);
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')
                ->user()
                ->generateAndSaveApiAuthToken();
            return responseJson(200, 'success', $user);
        }
        return responseJson(401, 'Please enter the correct credentials');
    }

    public function logout()
    {
        $user = Auth::guard('api')->user();
        $user->update([
            'api_token' => null
        ]);
        return responseJson(200, 'Logged out successfully', $user);
    }
}
