<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\ApplicationLayer\Accounts\AccountMainService;
use App\Infrastructure\Accounts\AccountMainRepository;
use App\Infrastructure\Items\ItemMainRepository;
use JWTAuth;
use App\Helpers\Mapper;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Response;
use App\Framework\Exceptions\BadRequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ResponseObject;
use App\ApplicationLayer\Accounts\Dtos\UserLoginDto;


class UserController extends Controller
{

    private $accountService;

    public function __construct(){
    	$this->middleware('jwt.auth', ['except' =>['login']]);
    	$this->accountService = new AccountMainService(new AccountMainRepository(),new ItemMainRepository());
    }

    public function login(Request $request){
    	$rules = [
    		'username' => 'required|min:2|max:64',
            'password' => 'required|min:6|max:24',
        ];

        $v = Validator::make($request->all(), $rules);
        if ($v->fails()) {
            return $this->handleValidationError($v->errors()->all());
        }

        $userLoginDto = Mapper::MapRequest(UserLoginDto::class,$request->all());

        $response = $this->accountService->login($userLoginDto);
        return $this->handleResponse($response);
    }

    public function addItem(Request $request){
        $user = JWTAuth::toUser();

        $rules = [
            'itemId' => 'required',
        ];

        $v = Validator::make($request->all(), $rules);
        if ($v->fails()) {
            return $this->handleValidationError($v->errors()->all());
        }

        $response = $this->accountService->addItem($user->id,$request->itemId);
        return $this->handleResponse($response);
    }

    public function getUserItems(Request $request){
        $user = JWTAuth::toUser();
        $response = $this->accountService->getUserItems($user->id);
        return $this->handleResponse($response);
    }

    public function getNonUserItems(Request $request){
        $user = JWTAuth::toUser();
        $response = $this->accountService->getNonUserItems($user->id);
        return $this->handleResponse($response);
    }
}