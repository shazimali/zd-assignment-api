<?php
namespace App\Repositories\API;

use App\Http\Resources\API\TaskDetailResource;
use App\Http\Resources\API\TasksListResource;
use App\Http\Resources\API\WorkersListResource;
use App\Interfaces\API\TaskInterface;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
class TaskRepository implements TaskInterface{
   
    public function getTasksList($request){
        try {
            $tasks = [];
            
            if($request->type == "MANAGER"){
                if($request->search_id){
                    $tasks =  Task::where('_id',$request->search_id)
                                ->with('user')
                                ->orderBy('created_at','DESC')
                                ->paginate($request->itemPerPage);
                }else{
                    $tasks =  Task::with('user')
                                ->orderBy('created_at','DESC')
                                ->paginate($request->itemPerPage);
                }
            }
            if($request->type == "WORKER"){
                if($request->search_id){
                    $tasks =  Task::where('_id',$request->search_id)
                                ->where('user_id',$request->user_id)
                                ->with('user')
                                ->orderBy('created_at','DESC')
                                ->paginate($request->itemPerPage);
                }else{
                    $tasks =  Task::where('user_id',$request->user_id)
                                ->with('user')
                                ->orderBy('created_at','DESC')
                                ->paginate($request->itemPerPage);
                }
            }
            if($tasks){
                return  TasksListResource::collection($tasks);
            }
           
            return $tasks;
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 401);
        }
      
    }

    public function storeTask($request)
    {
        try {
            $data = $request->all();
            
            if($request->file('image_path')){
               $file_path =  Storage::disk('public')->put('uploads', $request->image_path);
                $data['image_path'] = $file_path;
            }

            Task::create($data);

            return response()->json('Task created successfully.', 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 401);
        }
       
    }

    public function getWorkersList()
    {
        try {
            return WorkersListResource::collection(User::where('type','WORKER')->get());
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 401);
        }
        
    }

    public function getTaskDetailsByID($id)
    {
        try {
            $task = Task::with('user')->find($id);
            return new TaskDetailResource($task);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 401);
        }
        
        
    }


    public function updateTask($request,$id)
    {
        try {
            $data = $request->except(['image_path']);

            $task = Task::where('_id',$id)->first();

            if($request->file('image_path')){
                
                $file_path =  Storage::disk('public')->put('uploads', $request->image_path);
                $data['image_path'] = $file_path;

                if($task->image_path){
                    Storage::disk('public')->delete($task->image_path);
                }
  
            }

            $task->update($data);

            return response()->json('Task updated successfully.', 200);

        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 401);
        } 
    } 
    
    public function updateTaskStatus($request,$id)
    {
        try {

            if($request->status == 'InProgress' || $request->status == 'Completed'  ){
                
                Task::where('_id',$id)->update(['status' => $request->status]);
            }

            return response()->json('Task status updated successfully.', 200);

        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 401);
        } 
    } 

    public function destroyTask($id)
    {
        try {
            $task = Task::where('_id',$id)->where('status','Completed')->first();
           if($task){
                if($task->image_path){
                Storage::disk('public')->delete($task->image_path);
                }
                $task->delete();
                return response()->json('Task Deleted successfully.', 200);
           }else{
            return response()->json('Task can not be delete.', 201);
           }
            
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 401);
        }
        
        
    }

    
}

?>