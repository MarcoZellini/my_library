<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Book;

class LoginController extends Controller
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
}
