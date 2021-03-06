<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('api', ['except' => ['auth', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 400);
        }
        $user = auth()->user();
        return $this->respondWithToken($token,$user);
    }

    /**
     * Sign up.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $req = Validator::make($request->all(), [
            'username' => 'required|string|unique:users',
            'firstname' => 'required|string',
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'age' => 'required|integer'
        ]);

        if ($req->fails()) {
            return response()->json($req->errors()->toJson(), 400);
        }

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'age' => $request->age,
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'message' => 'User signed up',
            'user' => $user
        ], 201);
    }

    /**
     * Sign out
     */
    public function sign_out()
    {
        auth()->logout();
        return response()->json(['message' => 'User logged out']);
    }

    /**
     * Token refresh
     */
    public function refresh()
    {
        return $this->generateToken(auth()->refresh());
    }

    /**
     * User
     */
    public function allUsers()
    {
        return response()->json(User::all());
    }

    /**
     * Generate token
     */
    protected function respondWithToken($token,$user)
    {
        return response()->json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    protected function updateUser($id, Request $request) {
        $req = Validator::make($request->all(), [
            'username' => 'required|string',
            'firstname' => 'required|string',
            'name' => 'required|string|between:2,100',
            'age' => 'required|integer'
        ]);

        if ($req->fails()) {
            return response()->json($req->errors()->toJson(), 400);
        }

        User::where("_id", "=", $id)->update([
            'username' => $request["username"],
            'firstname' => $request["firstname"],
            'name' => $request["name"],
            'age' => $request["age"]
        ]);

        return response()->json([
            'message' => 'User udpate',
        ], 200);
    }

    protected function deleteUser($id) {
        $user = User::where("_id", '=', $id)->delete();

        if ($user) {
            return response()->json([
                'message' => 'Menu deleted',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Menu do not exist',
            ], 400);
        }
    }
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('api');
    }
}
