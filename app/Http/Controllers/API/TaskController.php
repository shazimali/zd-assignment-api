<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Interfaces\API\TaskInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TaskController extends Controller
{

    public function __construct(public TaskInterface $taskRepository){}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       return  $this->taskRepository->getTasksList($request);
    }

    public function workers()
    {
        return  $this->taskRepository->getWorkersList();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
       return  $this->taskRepository->storeTask($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return  $this->taskRepository->getTaskDetailsByID($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, $id)
    {   
        return  $this->taskRepository->updateTask($request,$id);
    }

    public function updateStatus(Request $request, $id)
    {   
    return  $this->taskRepository->updateTaskStatus($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return  $this->taskRepository->destroyTask($id);
    }
}
