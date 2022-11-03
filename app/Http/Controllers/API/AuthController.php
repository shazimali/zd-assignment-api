<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\AuthTokenRequest;
use App\Interfaces\API\AuthInterface;

class AuthController extends Controller
{
   
    public function __construct(public AuthInterface $authRepository){}
    
    public function login(AuthTokenRequest $request){

      return  $this->authRepository->getLoginDetails($request);
    
    }

    public function logout(Request $request){
       
      return  $this->authRepository->getLogout($request->id);
       
    }
}
