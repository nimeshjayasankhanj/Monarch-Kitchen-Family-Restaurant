<?php


namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function viewUsersIndex()
    {

        $users = User::where('user_role_iduser_role', '!=', 1)->get();

        return view('users.view-users', ['title' => "View Users", 'users' => $users]);
    }

    public function viewCustomersIndex()
    {

        $customer = User::find(Auth::user()->iduser_master);

        return view('employee.view-customers', ['title' => "View Customer", 'customer' => $customer]);
    }


    public function saveDriver(Request $request)
    {

        $validator = \Validator::make($request->all(), [

            'fName' => 'required|max:115',
            'lName' => 'required|max:115',
            'contactNo' => 'required|max:10|min:10',
            'username' => 'required|email',
            'password' => 'required|min:9',
            'address' => 'required',
        ], [
            'fName.required' => 'First Name should be provided!',
            'fName.max' => 'Last Name must be less than 115 characters.',
            'lName.required' => 'Last Name should be provided!',
            'lName.max' => 'Last Name must be less than 115 characters.',
            'contactNo.required' => 'Contact No should be provided!',
            'contactNo.max' => 'Contact No must be include 10 number.',
            'contactNo.min' => 'Contact No must be include 10 number.',
            'username.required' => 'User name should be provided!',
            'username.email' => 'User name should be valid email address!',
            'password.max' => 'Password must be include 9 number.',
            'password.required' => 'Password should be provided.',
            'address.required' => 'Address should be provided.',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        if (User::where('user_name', strtolower($request['username']))->first()) {
            return response()->json(['errorUser' => ['error' => 'User Name already exists.']]);
        }

        $save = new User();
        $save->first_name = strtoupper($request['fName']);
        $save->last_name = strtoupper($request['lName']);
        $save->contact_no = $request['contactNo'];
        $save->user_name = $request['username'];
        $save->address = $request['address'];
        $advanceEncryption = (new  \App\MyResources\AdvanceEncryption($request['password'], "Nova6566", 256));
        $save->password = $advanceEncryption->encrypt();
        $save->status = 1;
        $save->user_role_iduser_role = 2;
        $save->save();

        return response()->json(['success' => 'Driver saved successfully.']);
    }

    public function save(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = \Validator::make($request->all(), [

                'fName' => 'required|max:115',
                'lName' => 'required|max:115',
                'contactNo' => 'required|max:10|min:10',
                'username' => 'required|email',
                'password' => 'required|min:9',
                'address' => 'required|max:200',

            ], [
                'fName.required' => 'First Name should be provided!',
                'fName.max' => 'Last Name must be less than 115 characters.',
                'lName.required' => 'Last Name should be provided!',
                'lName.max' => 'Last Name must be less than 115 characters.',
                'contactNo.required' => 'Contact No should be provided!',
                'contactNo.max' => 'Contact No must be include 10 number.',
                'contactNo.min' => 'Contact No must be include 10 number.',
                'username.required' => 'User name should be provided!',
                'username.email' => 'User name should be valid email address!',
                'password.max' => 'Password must be include 9 number.',
                'password.required' => 'Password should be provided.',
                'address.required' => 'Address should be provided!',
                'address.max' => 'Address must be less than 200 characters.',

            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            if (User::where('user_name', strtolower($request['username']))->first()) {
                return response()->json(['errorUser' => ['error' => 'User Name already exists.']]);
            }

            $save = new User();
            $save->first_name = strtoupper($request['fName']);
            $save->last_name = strtoupper($request['lName']);
            $save->contact_no = $request['contactNo'];
            $save->user_name = $request['username'];
            $save->address = $request['address'];
            $advanceEncryption = (new  \App\MyResources\AdvanceEncryption($request['password'], "Nova6566", 256));
            $save->password = $advanceEncryption->encrypt();
            $save->status = 1;
            $save->user_role_iduser_role = 1;
            $save->save();
            DB::commit();
            return response()->json(['success' => 'Customer saved successfully.']);
        } catch (Exception $th) {
            DB::rollBack();
            throw $th;
        }
    }


    public function updatePassword(Request $request)
    {
        $update_pass2 = $request['update_pass2'];
        $hiddenPID = $request['hiddenPID'];
        $compass = $request['compass'];

        $validator = \Validator::make($request->all(), [
            'update_pass2' => 'required',
            'compass' => 'required',

        ], [
            'update_pass2.required' => 'Password should be provided!',
            'compass.required' => 'Conform Password should be provided!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        if ($compass != $update_pass2) {
            return response()->json(['errors' => ['error' => 'Password not match.']]);
        }

        $advanceEncryption = (new  \App\MyResources\AdvanceEncryption($request['password'], "Nova6566", 256));

        $pass = User::find(intval($hiddenPID));
        $pass->password = $advanceEncryption->encrypt();
        $pass->save();

        return response()->json(['success' => 'Password updated successfully ']);
    }

    public function getUserById(Request $request)
    {

        $userId = $request['userId'];

        $getUser = User::find($userId);

        return \response()->json($getUser);
    }

    public function resetPassword(Request $request)
    {
        $validator = \Validator::make($request->all(), [

            'userName' => 'required',
            'password' => 'required|min:9',
        ], [
            'userName.required' => 'User Name should be provided!',
            'password.max' => 'Password must be include 9 number.',
            'password.required' => 'Password should be provided.',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $getUserid = User::where('user_name', $request['userName'])->first();

        $advanceEncryption = (new  \App\MyResources\AdvanceEncryption($request['password'], "Nova6566", 256));

        $updatePassword = User::find(intval($getUserid->iduser_master));
        $updatePassword->password = $advanceEncryption->encrypt();
        $updatePassword->save();

        return response()->json(['success' => 'Password updated successfully ']);
    }


    public function updateUser(Request $request)
    {

        $validator = \Validator::make($request->all(), [

            'fName' => 'required|max:115',
            'lName' => 'required|max:115',
            'username' => 'required',
            'contactNo' => 'required|max:10|min:10',
            'address' => 'required|max:200',

        ], [
            'fName.required' => 'First Name should be provided!',
            'username.required' => 'Username should be provided!',
            'fName.max' => 'Last Name must be less than 115 characters.',
            'lName.required' => 'Last Name should be provided!',
            'lName.max' => 'Last Name must be less than 115 characters.',
            'contactNo.required' => 'Contact No should be provided!',
            'contactNo.max' => 'Contact No must be include 10 number.',
            'contactNo.min' => 'Contact No must be include 10 number.',

            'address.required' => 'Address should be provided!',
            'address.max' => 'Address must be less than 200 characters.',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        if (User::where('username', strtolower($request['username']))->where('iduser_master', '!=', $request['hiddenUID'])->first()) {
            return response()->json(['errorUser' => ['error' => 'User Name already exists.']]);
        }

        $update = User::find($request['hiddenUID']);
        $update->first_name = strtoupper($request['fName']);
        $update->last_name = strtoupper($request['lName']);
        $update->contact_no = $request['contactNo'];
        $update->username = strtolower($request['username']);
        $update->address = strtolower($request['address']);
        $update->save();



        return response()->json(['success' => 'Customer updated successfully.']);
    }

    public function addDriver()
    {
        return view('users.add-user', ['title' => 'Create Driver']);
    }
}
