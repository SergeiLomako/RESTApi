<?php
/**
 * Created by PhpStorm.
 * User: Flameseeker
 * Date: 22.07.2018
 * Time: 15:52
 */

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Routing\Controller;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function index(){
        $users = User::all()->toArray();

        return response()->json($users);
    }

    public function getUser($id){
        $user = User::findOrFail($id)->toArray();

        return response()->json($user);
    }

    public function create(UserRequest $request){
        $token = md5(uniqid());
        User::create([
                      'login' => $request->login,
                      'password' => $request->password,
                      'token' => $token]);

        return response()->json(['token' => $token]);
    }

    public function update(UpdateUserRequest $request, $id){
        $user = User::findOrFail($id);
        $user->fill($request->all())->save();

        return response()->json('User updated!');
    }

    public function delete($id){
        $user = User::findOrFail($id);
        $user->data()->delete();
        $user->delete();

        return response()->json('User deleted!');
    }
}