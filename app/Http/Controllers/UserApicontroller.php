<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserApicontroller extends Controller
{
    public function showUser($id = null)
    {
        if ($id == '') {
            $users = User::get();
            return response()->json(['users' => $users], 200);
        } else {
            $users = User::find($id);
            return response()->json(['users' => $users], 200);
        }
    }

    public function addUser(Request $request)
    {
        if ($request->ismethod('post')) {
            $data = $request->all();
            // return $data;

            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
            ];
            $custommess = [
                'name.required' => 'name is required',
                'email.required' => 'email is required',
                'email.email' => 'email is not valid',
                'email.unique' => 'email already exists',
                'password.required' => 'password is required',
            ];
            $validator = Validator::make($data, $rules, $custommess);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();
            $meassage = "User Successfully Added";
            return response()->json(['message' => $meassage], 201);
        }
    }

    // multiple user
    public function addmulUser(Request $request)
    {
        if ($request->ismethod('post')) {
            $data = $request->all();
            // return $data;

            $rules = [
                'users.*.name' => 'required',
                'users.*.email' => 'required|email|unique:users',
                'users.*.password' => 'required',
            ];
            $custommess = [
                'users.*.name.required' => 'name is required',
                'users.*.email.required' => 'email is required',
                'users.*.email.email' => 'email is not valid',
                'users.*.email.unique' => 'email already exists',
                'users.*.password.required' => 'password is required',
            ];
            $validator = Validator::make($data, $rules, $custommess);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            foreach ($data['users'] as $adduser)
                $user = new User();
            $user->name = $adduser['name'];
            $user->email = $adduser['email'];
            $user->password = bcrypt($adduser['password']);
            $user->save();
            $meassage = "MultipleUser Successfully Added";
            return response()->json(['message' => $meassage], 201);
        }
    }

    //update user
    public function updateUser(Request $request,$id)
    {
        if ($request->ismethod('put')) {
            $data = $request->all();
            // return $data;

            $rules = [
                'name' => 'required',
                'password' => 'required',
            ];
            $custommess = [
                'name.required' => 'name is required',
                'password.required' => 'password is required',
            ];
            $validator = Validator::make($data, $rules, $custommess);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $user = User::find($id);
            $user->name = $data['name'];
            $user->password = bcrypt($data['password']);
            $user->save();
            $meassage = "Updated Successfully ";
            return response()->json(['message' => $meassage], 202);
        }
    }

    //delete user
    public function deleteUser($id= null){
        User::findOrFail($id)->delete();
        return response()->json(['message' => 'User deleted successfully'], 200);
    }

    //multiple user delete
    public function deleteMulUser($ids){
        $ids= explode(',',$ids);
        User::whereIn('id',$ids)->delete();
        return response()->json(['message' => 'MultipleUser deleted successfully'], 200);

    }

}
