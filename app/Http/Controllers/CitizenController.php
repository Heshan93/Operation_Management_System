<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\Citizen;
use App\Models\Service;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Echo_;
use Illuminate\Support\Arr;
use Exception;
use Illuminate\Support\Facades\Storage;
use App\Models\Document;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;







use function PHPUnit\Framework\returnSelf;

class CitizenController extends Controller
{



    function intProfile()
    {
        // Retrieve the citizen with their associated services and payments
        $citizen = Citizen::with(['services.payments', 'documents'])->find(request()->session()->get('cid'));
    
        if ($citizen) {
            // Access the services on citizen
            $services = $citizen->services;
            $payments = []; // Define an empty array for payments
    
            // Access payments for each service and push them into the $payments array
            foreach ($services as $service) {
                $payments[] = $service->payments;
            }
    
            // Access the documents for the citizen
            $documents = $citizen->documents;
    
            return view('profile', compact('citizen', 'services', 'payments', 'documents'));
        } else {
            // Handle the case when the citizen is not found
            // For example, you can return an error view or redirect.
            return view('/');
        }
    }
    




     function index(Request $req)
     {
 
        
            
        $req->validate([    

            'nic_l' => 'required|min:6|max:255',
            'password_l'  => 'required|min:6', 
        ]);

        $citizen = Citizen::where('nic', $req->nic_l)->first();
          //dd($citizen->services->service_type);
          
            if ($citizen) {

                if($citizen->is_registered == true)
                {
                    if (Hash::check($req->password_l, $citizen->password)) { //check the password
        
                        //add citizen info to session
                        $req->session()->put('cid', $citizen->id);
                        $req->session()->put('cfname', $citizen->fname);
                        $req->session()->put('clname', $citizen->lname);
                        $req->session()->put('is_clogin', true);
                        $req->session()->put('cemail', $citizen->email);
                        $req->session()->put('cnic', $citizen->nic);
                        $req->session()->put('cdob', $citizen->dob);
                        $req->session()->put('cgender', $citizen->gender);
                        $req->session()->put('cpassword', $citizen->password);
                        $req->session()->put('cphone', $citizen->phone);
                        $req->session()->put('caddress', $citizen->address);
                        $req->session()->put('cdistrict', $citizen->district);
                        $req->session()->put('cdivision', $citizen->division);
                        $req->session()->put('cdistrict', $citizen->district);
                        $req->session()->put('grama_niladari_certificate',$citizen->documents->grama_niladari_certificate);
                        $req->session()->put('v_emission_certificate', $citizen->documents->v_emission_certificate);
                        $req->session()->put('birth_certificate',$citizen->documents->birth_certificate);
                        $req->session()->put('vehicle_license', $citizen->documents->vehicle_license);
                        $req->session()->put('appointment_attachment', $citizen->documents->appointment_attachment);
                       // $req->session()->put('service_type', $citizen->services->service_type);

                        //dd($citizen);
                       // dd(session()->all());
                       /*  $data = array(
                            'cfName' =>$citizen->fname,
                            'clName' =>$citizen->clName,
                            'cnic' =>$citizen->nic,
                            
                        );
            */
            
                        // Access the services on citizen
                        $services = $citizen->services;
                
                        // access payments for each service

                        foreach ($services as $service) {
                            $payments = $service->payments; 
                        // dd($payments);
                        }
                
                        //access the documents for the citizen
                        $documents = $citizen->documents;
    
 
                        return view('profile', compact('citizen', 'services', 'payments', 'documents'));

                          //return view('profile');

                    } else {
                        return back()->with('fail', 'This password is not correct');
                    }
                }
                else
                {
                    return back()->with('fail', 'You are not registered yet, Please create a account first');
                }
            }
            else
            {
                
                return back()->with('fail', 'Your NIC is not Registered Please Contact Your Grama Niladari');
               
            }

    
     }


    function store(Request $req)
    {
         $req->validate([
            'nic' => 'required|min:6|max:15',
            'password' => 'required|min:6|max:255',
            'fname' => 'required|min:3',
            'lname' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required|min:10|max:13',
            'district' => 'required',
            'division' => 'required',
        ]);

       

        // Validate the registration conditions


        $citizen = Citizen::where('nic', $req->nic)->first();

       


        if (!$citizen) {
            return back()->with('fail', 'Your NIC is not registered on District Secretariat. Please contact your Grama Niladari.');
        } elseif ($citizen->is_registered) {
            return back()->with('fail', 'You have already registered. Please log in.');
        } elseif ($citizen->district != $req->district) {
            return back()->with('fail', 'Your district does not match. Please try again.');
        } elseif ($citizen->division != $req->division) {
            return back()->with('fail', 'Your division does not match. Please try again.');
        }



        // Set the attributes from the validated data
        $citizen->password = Hash::make($req['password']);
        $citizen->fname = $req['fname'];
        $citizen->lname = $req['lname'];
        $citizen->email = $req['email'];
        $citizen->phone = $req['phone'];
        $citizen->is_registered = true; 

        // Save the new Citizen to the database
        $citizen->update();

        //add citizen info to session
        $req->session()->put('cfname', $citizen->fname);
        $req->session()->put('clname', $citizen->lname);
        $req->session()->put('is_clogin', true);
        $req->session()->put('cemail', $citizen->email);
        $req->session()->put('cnic', $citizen->nic);
        $req->session()->put('cdob', $citizen->dob);
        $req->session()->put('cgender', $citizen->gender);
        $req->session()->put('cpassword', $citizen->password);
        $req->session()->put('cphone', $citizen->phone);
        $req->session()->put('caddress', $citizen->address);
        $req->session()->put('cdistrict', $citizen->district);
        $req->session()->put('cdivision', $citizen->division);
        $req->session()->put('cdistrict', $citizen->district);
        $req->session()->put('cprofile_image', $citizen->profile_image);

        // Redirect the user after successful registration
        return redirect('profile');
        

    }


    // Logout 
    function flush()
    {
        // Clear the session data
        session()->flush();

        // Redirect to home
       return redirect('/');
    }


    function update(Request $req)
    {   


       

       /*  dd($req->all()); */

         
            $req->validate([
        
                'password' =>'required|min:6|max:255',
                'fname' => 'required|min:3',
                'lname' => 'required|min:3',
                'email' => 'required|email',
                'phone' => 'required|min:10|max:13',
                'dob' => 'required|date',
                'gender' => 'required',
                'address' => 'required|min:10|max:255',
                
            ]);
            
           
         /*    dd(session()->all()); */

     

        $citizen = Citizen::where('nic',session('cnic'))->first();

        
         // Set the attributes from the validated data
         $citizen->password = Hash::make($req['password']);
         $citizen->fname = $req['fname'];
         $citizen->lname = $req['lname'];
         $citizen->email = $req['email'];
         $citizen->phone = $req['phone'];
         $citizen->dob = $req['dob'];
         $citizen->gender = $req['gender'];
         $citizen->address = $req['address'];

        // Save the new Citizen to the database
        $citizen->update();
        
        

         //add citizen info to session
         $req->session()->put('cfname', $citizen->fname);
         $req->session()->put('clname', $citizen->lname);
         $req->session()->put('cemail', $citizen->email);
         $req->session()->put('cnic', $citizen->nic);
         $req->session()->put('cdob', $citizen->dob);
         $req->session()->put('cgender', $citizen->gender);
         $req->session()->put('cphone', $citizen->phone);
         $req->session()->put('caddress', $citizen->address);

        /*  dd(session()->all()); */


        return redirect('profile')->with('success', 'Your Information is successfully updated');
         
    }

    function imageStore()
    {

        request()->validate([
            'profile_image' => 'required|image',
        ]);


         // dd(request()->all());
         
        try
        {
            

            $cnic = request()->session()->get('cnic');
            $cnicDirectory = storage_path('app/public/' . $cnic);

            if (!file_exists($cnicDirectory)) {
                // Create a directory for the user if it doesn't exist
                mkdir($cnicDirectory, 0755, true);
            }
        
            $profilePicName = $cnic . '_profile_image.' . request('profile_image')->getClientOriginalExtension();

            DB::beginTransaction(); // Start a database transaction

            $document =Document::where('citizen_id', Request()->session()->get('cid'))->first();

        
            if ($document) {

                $document->profile_image = $profilePicName;
                $document->update();

            } else {

                Document::create([
                    'citizen_id' => request()->session()->get('cid'),
                    'profile_image' => $profilePicName,
                ]);

            }


            DB::commit(); // Commit the transaction

                // Resize the image before saving
                $image = Image::make(request('profile_image'))->fit(200, 200);
                $image->save($cnicDirectory . '/' . $profilePicName);
            
            // Move and store the images with the new file names in the user's directory
           // request('profile_image')->move($cnicDirectory, $profilePicName);


            return redirect('profile')->with('success', 'Image uploaded successfully.');
            

        }
        catch(Exception $ex)
        {
            //throw $ex;
            DB::rollBack(); // Rollback the transaction in case of an exception
             return redirect('profile')->with('fail', 'An error occurred while saving the profile image : ' . $ex->getMessage());
        }

       
    }
    


}
