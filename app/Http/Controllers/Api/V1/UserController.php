<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserActivityLogs;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends ApiController
{

    public function test()
    {
        return "hello";
    }

    public function register(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
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
            ]
        ]);

        $user             = new User();
        $user->first_name = $validatedData["first_name"];
        $user->last_name  = $validatedData['last_name'];
        $user->email      = $validatedData['email'];
        $user->password   = Hash::make($validatedData['password']);
        $user->save();

        return $this->success($user->toArray(), 'Registration successfully.');
    }

    public function login(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'email'    => 'required|string|max:255|email',
            'password' => [
                'required',
                'string',
                'min:6',
                'regex:/[0-9]/',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[*.!#$]/'
            ]
        ]);

        /** @var User $user */
        $user = User::where('email', $validatedData['email'])->first();

        if (!$user || !Hash::check($validatedData['password'], $user)) {
            $this->error(401, 'Login failed.');
        }

        // create auth token
        $authToken = $user->createToken('')->plainTextToken;;

        return $this->success([
            'user'  => $user,
            'token' => $authToken
        ], 'Login successfully.');
    }

    public function logout()
    {
        /** @var User $user */
        $user = Auth::user();
        $tokenCount = $user->tokens()->delete();

        return $this->success([],"Logout successfully. {$tokenCount} token(s) revoked.");
    }

    public function activities(Request $request)
    {
        $userActivities = UserActivityLogs::where('user_id', $request->user()->id);
        return $this->success($this->filter($request, $userActivities)->toArray());
    }

    /**
     * Filtering endpoint
     */
    public function filter(Request $request, $user)
    {
        if ($request->has('endpoint')) {
            $user->where('endpoint', $request->input('endpoint'));
        }

        //Pagination
        $perPage = $request->input('per_page', 25);
        return $user->paginate($perPage);
        //return $user->get();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $perPage = $request->input('per_page', 25);

        return $this->success([
            'user' => $user->toArray(),
            'activities' => $user->activityLogs()->paginate($perPage)
        ]);
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
