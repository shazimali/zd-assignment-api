<?php
 namespace App\Interfaces\API;

Interface TaskInterface{

    public function getTasksList($request);
    public function storeTask($request);
    public function getTaskDetailsByID($id);
    public function updateTask($request,$id);
    public function updateTaskStatus($request,$id);
    public function destroyTask($id);
    public function getWorkersList();
    
    
    
 }