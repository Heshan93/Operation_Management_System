<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Psy\VersionUpdater\Checker;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    function login()
    {
       // dd(request()->all());

        request()->validate([
            'email'=>"required|min:6|max:255",
            'password'=>"required|min:6|max:255",
        ]);

     

        $user = User::where('email', request()->email)->first();


           

          if($user)
          {
            if(Hash::check( request()->password, $user->password))
            {


                //add citizen info to session
                request()->session();
                
                session()->put('is_admin_login',true);
                session()->put('afname',$user->fname );
                session()->put('alname',$user->lname );
                session()->put('is_view_user',$user->is_view_user );
                session()->put('is_edit_user',$user->is_edit_user );
                session()->put('is_edit_user_access',$user->is_edit_user_access );
                session()->put('is_view_citizen',$user->is_view_citizen );
                session()->put('is_edit_citizen',$user->is_edit_citizen );
                session()->put('is_manage_appointment',$user->is_manage_appointment );
                session()->put('profile_file_name',$user->profile_file_name );

        

                /* dd(session()->all()); */
                return redirect('admin-dashboard');
            }
            else
            {
                return back()->with('fail', 'Your password is incorrect !');
            }

          }
          else
          {
             return back()->with('fail', 'Email is not registered !');
          }
    }

    function flush()
    {
        // Clear the session data
        session()->flush();

        // Redirect to home
       return redirect('admin-login');
    }



    function storAdmin()
    {
        request()->validate([
            "first_name" => 'required|string|max:255',
            "last_name" => 'required|string|max:255',
            "nic" => 'required|string|max:12|unique:users,nic',
            "email" => 'required|string|email|max:255|unique:users,email',
            "phone" => 'required|numeric|digits:10|unique:users,phone',
            "job_roll" => 'required|string|max:20',
            "district" => 'required|string|max:255',
            "division" => 'required|string|max:255',
            "address" => 'required|string',
            "password" => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            "profile_img" => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);
    
        try {
            $cnic = request()->nic;
            $cnicDirectory = storage_path('app/public/' . $cnic);
    
            if (!file_exists($cnicDirectory)) {
                mkdir($cnicDirectory, 0755, true);
            }
    
            $profilePicName = "img.jpg"; // Default image name
    
            if (request()->has('profile_img') && request()->file('profile_img')->isValid()) {
                $profilePicName = $cnic . '_profile_image.' . request('profile_img')->getClientOriginalExtension();
                // Resize and save the uploaded image
                $image = Image::make(request('profile_img'))->fit(200, 200);
                $image->save($cnicDirectory . '/' . $profilePicName);
            }
    
            DB::beginTransaction(); // Start a database transaction
    
            $user = User::create([
                'fname' => request()->first_name,
                'lname' => request()->last_name,
                'nic' => request()->nic,
                'email' => request()->email,
                'phone' => request()->phone,
                'job_roll' => request()->job_roll,
                'district' => request()->district,
                'division' => request()->division,
                'address' => request()->address,
                'profile_file_name' => $profilePicName,
                'password' => bcrypt(request('password')),
                'is_edit_user' => request('is_edit_user', false),
                'is_view_user' => request('is_view_user', false),
                'is_view_citizen' => request('is_view_citizen', false),
                'is_edit_citizen' => request('is_edit_citizen', false),
                'is_manage_appointment' => request('is_manage_appointment', false),
                'is_view_reports' => request('is_view_reports', false),
            ]);
    
            DB::commit(); // Commit the transaction
    
            return redirect('user-manager')->with('success', 'User added successfully.');

        } catch (\Throwable $th) {
            DB::rollBack(); // Rollback the transaction in case of an exception
            //throw $th;
             return back()->with('fail', 'An error occurred while saving data : ' . $th->getMessage());
        }
    }

    function getUserManager()
    {
        
        $users = User::all();
        
        $userData =[];

        if($users)
        {
            foreach ($users as $user) 
            {

                 $userData [] = $user;

            }

           // dd( $userData);

           
        }

        return view('Admin/user-manager',compact('userData'));
    
    }

    function getUserEdit()
    {

        $user = User::where('id',request('id'))->first();

        return view('Admin/edit-user',compact('user'));
    }

    function updateUser()
    {


        request()->validate([
            "first_name" => 'required|string|max:255',
            "last_name" => 'required|string|max:255',
            "nic" => 'required|string|max:12',
            "email" => 'required|string|email|max:255',
            "phone" => 'required|numeric|digits:10',
            "job_roll" => 'required|string|max:20',
            "district" => 'required|string|max:255',
            "division" => 'required|string|max:255',
            "address" => 'required|string',
            "password" => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            "profile_img" => 'image|mimes:jpeg,png,jpg,gif',
        ]);

       // dd(request()->all());

        $user = User::where('id',request('id'))->first();


        try {


            if(request()->has('profile_img'))
            {

                            
            $cnic = request()->nic;
            $cnicDirectory = storage_path('app/public/' . $cnic);

            if (!file_exists($cnicDirectory)) {
                mkdir($cnicDirectory, 0755, true);
            }

                $profilePicName = $cnic . '_profile_image.' . request('profile_img')->getClientOriginalExtension();
                // Resize and save the uploaded image
                $image = Image::make(request('profile_img'))->fit(200, 200);
                $image->save($cnicDirectory . '/' . $profilePicName);
            }
            else
            {
                $profilePicName = $user->profile_file_name;
            }

            

            $user->fname = request('first_name');
            $user->lname = request('last_name');
            $user->email = request('email');
            $user->phone = request('phone');
            $user->job_roll = request('job_roll');
            $user->district = request('district');
            $user->division = request('division');
            $user->address = request('address');
            $user->profile_file_name =  $profilePicName;
            $user->password = bcrypt(request('password'));
            $user->is_edit_user = request('is_edit_user',false);
            $user->is_view_user = request('is_view_user',false);
            $user->is_view_citizen = request('is_view_citizen',false);
            $user->is_edit_citizen = request('is_edit_citizen',false);
            $user->is_manage_appointment = request('is_manage_appointment',false);
            $user->is_view_reports = request('is_view_reports',false);

            $user->update();


            return redirect('user-manager')->with('success', 'User added successfully.');

        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('fail', 'An error occurred while saving data : ' . $th->getMessage());
        }
    }

    function deleteUser()
    {
        try {
            $userId = request('id');
            $user = User::find($userId);
    
            if (!$user) {
                return back()->with('fail', 'User not found.');
            }
    
            // Soft delete the user (move to the trash)
            $user->delete();
    
            return redirect('user-manager')->with('success', 'User deleted successfully.');
    
        } catch (\Throwable $th) {
            // Log the error or handle it appropriately
            return back()->with('fail', 'An error occurred while deleting user: ' . $th->getMessage());
        }
    }
    

}