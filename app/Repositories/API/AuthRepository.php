<?php
 
 namespace App\Repositories\API;

use Auth;
use App\Models\User;
use App\Interfaces\API\AuthInterface;

class AuthRepository implements AuthInterface{
   
    public function getLoginDetails($request){
            
        if (!Auth::attempt($request->all())) {
            return response()->json([
                'message' => 'Invalid login details.'
                           ], 401);
        }
        $user = auth()->user();
        return response()->json(
            [
                'token' => $user->createToken('auth_token')->plainTextToken,
                'user' => $user            
            ]);  
    }

    public function getLogout($id){

            $user = User::find($id);
            if ($user) {
                $user->tokens()->delete();
                return response()->json('Log out successfully.', 200); 
            }
            return response()->json('Failed.', 201);
            

    }
}

?>