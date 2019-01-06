<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Jsonable;

use App\Http\Resources\User as UserResource;
use App\Http\Resources\Order as OrderResource;

use Illuminate\Support\Facades\DB;

use App\User;
use App\Order;
use App\StoreUserRequest;
use Hash;

class UserControllerAPI extends Controller
{
    public function index(Request $request)
    {
        return User::all();
        if ($request->has('page')) {
            return UserResource::collection(User::paginate(5));
        } else {
            return UserResource::collection(User::all());
        }  
    }

    public function getCookOrdersList($id){
        $user=User::findOrFail($id);
        $orders = $user->orders;
        
        $orders = $orders->filter(function ($order) {
            return $order->state == 'confirmed' || $order->state == 'in preparation';
        });
        
        $orders = $orders->sortBy('start')->sortByDesc('state');
        
        return OrderResource::collection($orders); 
    }

    public function add(Request $request) {
        $user = new User();
        $user->fill($request->all());
        $user->save();
        return response()->json($user, 200);
    }

    public function show($id)
    {
        return new UserResource(User::find($id));
    }

    public function getUsers(Request $request)
    {
       return UserResource::collection(User::all());
    }

   public function store(Request $request)
    {
        $request->validate([
                'name' => 'required|min:3|regex:/^[A-Za-záàâãéèêíóôõúçÁÀÂÃÉÈÍÓÔÕÚÇ ]+$/',
                'email' => 'required|email|unique:users,email',
                'password' => 'min:3'
            ]);
        $user = new User();
        $user->fill($request->all());
        $user->password = Hash::make($user->password);
        $user->save();
        return response()->json(new UserResource($user), 201);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
                'name' => 'required|min:3|regex:/^[A-Za-záàâãéèêíóôõúçÁÀÂÃÉÈÍÓÔÕÚÇ ]+$/',
                'email' => 'required|email|unique:users,email,'.$id
            ]);
        $user = User::findOrFail($id);
        $user->update($request->all());
        return new UserResource($user);
    }

    public function destroy($id)
    { 
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(null, 204);
    }

    

    public function emailAvailable(Request $request)
    {
        $totalEmail = 1;
        if ($request->has('email') && $request->has('id')) {
            $totalEmail = DB::table('users')->where('email', '=', $request->email)->where('id', '<>', $request->id)->count();
        } else if ($request->has('email')) {
            $totalEmail = DB::table('users')->where('email', '=', $request->email)->count();
        }
        return response()->json($totalEmail == 0);
    }


    public function changePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $currentPassword = $user->password;
        if (Hash::check($request->input('oldPassword'), $user->password) && ($request->input('newPassword') == $request->input('confirmPassword'))) {
            $user->update([
                'password' => Hash::make($request->input('newPassword'))
            ]);
            return response()->json([
                'message' => 'Password updated'
            ]);
        } else {
            return response()->json([
                'message' => 'Something Went Wrong!!'
            ]);
        }
        return $user;
    }

    public function blockUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->blocked === 1) {
            $user->blocked = 0;
        } else {
            $user->blocked = 1;
        }
        $user->save();
        return response()->json($user, 200);
    }

    
    public function myProfile(Request $request)
    {
        return new UserResource($request->user());
    }
}

