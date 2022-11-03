<?php
 
 namespace App\Repositories\API;

use App\Http\Resources\API\UserDetailResource;
use App\Http\Resources\API\UsersListResource;
use App\Models\User;
use App\Interfaces\API\UserInterface;
use App\Models\Task;

class UserRepository implements UserInterface{
   
    public function getUsersList($request){
        try {
            $users = User::orderBy('created_at','DESC')->paginate($request->itemPerPage);
            if($users){
                return  UsersListResource::collection($users);
            }else{
                return response()->json('User created successfully.', 201);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 401);
        }
     
    }

    public function storeUser($request)
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'type' => $request->type,
                'email_verified_at' => now()
            ]);
            return response()->json('User created successfully.', 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 401);
        }
       
    }

    public function getUserDetailsByID($id)
    {
        try {
            $user = User::where('_id',$id)->first();
            return new UserDetailResource($user);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 401);
        }
        
        
    }


    public function updateUser($request,$id)
    {
        try {
           
            $user = User::where('_id',$id)->first();
            $user->name = $request->name;
            $user->type = $request->type;
            
            if(!empty($user->password)){
                $user->password = bcrypt($request->password);
            }

            $user->save();
            return response()->json('User updated successfully.', 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 401);
        }
        
        
    }   

    public function destroyUser($id)
    {
        try {
            $user = User::where('_id',$id)->first();
            if($user){
                $task = Task::where('user_id',$user->id)->first();
                if($task){
                    return response()->json('User has task, it can not delete.', 201);
                }else{
                    $user->tokens()->delete();
                    $user->delete();
                    return response()->json('User deleted successfully.', 200);
                }
               
            }
                return response()->json('User not found.', 201);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 401);
        }
        
        
    }

    
}

?>