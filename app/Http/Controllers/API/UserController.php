<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Book;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    /**
     * Method to check the login parameters
     */
    public function login(Request $request)
    {
        $email = $request->input('email');
        // $request_data = $request->all();
        $user = User::where('email', $email)->first();


        if ($user) {
            return response()->json([
                'success' => true,
                'result' => [
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'user_lastname' => $user->lastname,
                ]
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'This email is not registered!'
            ]);
        }
    }

    /**
     * Method to register a new user
     */
    public function register(StoreUserRequest $request)
    {
        $val_data = $request->validated();


        if ($val_data) {

            $user = User::create([
                'name' => $val_data['name'],
                'lastname' => $val_data['lastname'],
                'email' => $val_data['email'],
            ]);

            return response()->json([
                'success' => true,
                'result' => $user
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Invalid Data!'
            ]);
        }
    }
}
