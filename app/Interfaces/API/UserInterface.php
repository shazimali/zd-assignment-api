<?php
 namespace App\Interfaces\API;

Interface UserInterface{

    public function getUsersList($request);
    public function storeUser($request);
    public function getUserDetailsByID($id);
    public function updateUser($request,$id);
    public function destroyUser($id);
    
    
 }