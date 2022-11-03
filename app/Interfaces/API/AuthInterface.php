<?php
 namespace App\Interfaces\API;

Interface AuthInterface{

    public function getLoginDetails($data);
    public function getLogout($id);
    
 }
?>