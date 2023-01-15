<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends ApiController
{

    public function test()
    {
        return "hello";
    }

    public function register(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'first_name' => 'required|string|max:255',
                'last_name'  => 'required|string|max:255',
                'email'      => 'required|string|max:255|email|unique:users',
                'password'   => [
                    'required',
                    'string',
                    'min:6',
                    'regex:/[0-9]/',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[*.!#$]/'
                ],
            ]
        );

        if (!$validate) {
           return $this->error(400,$validate->errors());
        }

        $user             = new User();
        $user->first_name = $request["first_name"];
        $user->last_name  = $request['last_name'];
        $user->email      = $request['email'];
        $user->password   = Hash::make($request['password']);
        $user->save();

        return $this->success(json_encode($user),'Registration successfully.');
    }

    public function login(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'email'    => 'required|string|max:255|email|unique:users',
                'password' => [
                    'required',
                    'string',
                    'min:6',
                    'regex:/[0-9]/',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[*.!#$]/'
                ]
            ],
            [
                'name.required' => __('name.ErrorNameRequired'),
            ]
        );

        if(!$validate){
            return $this->error(400,$validate->errors());
        }


        //return bearer token
        return $this->success(null,'Login successfully.');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
