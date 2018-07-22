<?php
/**
 * Created by PhpStorm.
 * User: Flameseeker
 * Date: 23.07.2018
 * Time: 1:02
 */

namespace App\Http\Controllers;

use App\User;
use App\UserData;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\UserDataRequest;

class DataController extends Controller
{
    public function index(){
        $data = UserData::all()->toArray();

        return response()->json($data);
    }

    public function getData($id){
        $data = UserData::findOrFail($id)->toArray();

        return response()->json($data);
    }

    public function create(UserDataRequest $request){
        $user = User::findByToken($request->header('Authorization'));
        UserData::create(['data' => $request->data,'key' => $user->_id]);

        return response()->json('Data created!');
    }

    public function update(UserDataRequest $request, $id){
        $message = 'Access Denied!';
        $data = UserData::findOrFail($id);
        $user = User::findByToken($request->header('Authorization'));
        if($data->key === $user->_id){
            $data->fill($request->all())->save();
            $message = 'Data updated';
        }

        return response()->json($message);
    }

    public function delete(Request $request, $id){
        $message = 'Access Denied!';
        $data = UserData::findOrFail($id);
        $user = User::findByToken($request->header('Authorization'));
        if($data->key === $user->_id){
            $data->delete();
            $message = 'Data deleted';
        }

        return response()->json($message);
    }
}