<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Payment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ServicesController extends Controller
{
    //

    function store()
    {
        request()->validate([
            "First_Name" => 'required|string|max:255',
            "Last_Name" => 'required|string|max:255',
            "NIC" => 'required|string|max:12|exists:citizens,nic', 
            "Email" => 'required|string|email|max:255', 
            "Phone" => 'required|string|max:20',
            "District" => 'required|string|max:255',
            "Division" => 'required|string|max:255',
            "Address" => 'required|string',
            "Certificate" => 'required|string',
            "delivary-method" => 'required|string',
        ]);
        
        // ddd(Request('delivary-method'));

    

        if(request()->Certificate == 'Birth Certificates') 
        {
            $productItemPrice = 1500.00;
        }

        if(request()->Certificate == 'Marriag Certificates') 
        {
            $productItemPrice = 5000.00;
        }

        if(request()->Certificate == 'Grama Niladari Certificates') 
        {
            $productItemPrice = 500.00;
        }







        if(Request('delivary-method') == 'deliver')
        {
            $Dilivery_price = 1000.00;
        }
        else
        {
            $Dilivery_price = 500.00;
        }


        $totalPrice = $productItemPrice + $Dilivery_price;

        $service = Service::create([
            'citizen_id' => request('cid'), 
            'service_type' => request('service_type'), 
            'certificate_type' => request('Certificate'),
            'delivary_method' => request('delivary-method'),
            'service_type' => request('service_type'),
            'item_price' => $productItemPrice,
            'delivery_price' => $Dilivery_price,
            'total' =>$totalPrice,
        ]);

        //dd($service);



        session()->put('delivary_method',  Request('delivary-method'));
        session()->put('product_item',  Request('Certificate'));
        session()->put('service_type',  Request('service_type'));
        session()->put('productItemPrice',  $productItemPrice );
        session()->put('service_id',  $service->id);
        session()->put('delivery_price', $Dilivery_price);
        session()->put('total_price', $totalPrice);


        return redirect('payment')->with('success', 'Request is successfully created, Please make payment');
        //return redirect('payment')->with('data', $data)->with('success', 'Request is successfully created, Please make payment');




    }


    function payment()
    {
 


       request()->validate([

        "cardnumber" => 'required|numeric|Min:10|',
        "mm/yy" => 'required|size:5',
        "cvv" => 'required|size:3',
        "cardname" => 'required|string|max:255',

       ]);

      

        $payment = Payment::create([
            'service_id' => request('service_id'), 
            'product_item' => request('product_item'),
            'item_price' => request('productItemPrice'),    
            'delivery_price' => request('delivery_price'),
            'delivary_method' => request('delivary_method'),
            'total' => request('total'),
        ]);

        $serviceStatus = Service::where('id', request('service_id'))->first();

        $serviceStatus->service_payment = true;

        $serviceStatus->update();

       // dd($serviceStatus);

        session()->pull('delivary_method');
        session()->pull('product_item');
        session()->pull('productItemPrice' );
        session()->pull('service_id');
        session()->pull('delivery_price');
        session()->pull('totalPrice');
     
        

        return redirect('profile')->with('success', 'Payment successful');

    }




    function paymentPending($id)
    {
       
        $service = Service::where('id', $id)->first();

        // dd($service->certificate_type);


         

        if($service->certificate_type == 'Birth Certificates') 
        {
            $productItemPrice = 1500.00;
        }

        if($service->certificate_type == 'Marriag Certificates') 
        {
            $productItemPrice = 5000.00;
        }

        if($service->certificate_type == 'Grama Niladari Certificates') 
        {
            $productItemPrice = 500.00;
        }







        if($service->delivary_method == 'deliver')
        {
            $Dilivery_price = 1000.00;
        }
        else
        {
            $Dilivery_price = 500.00;
        }

        $totalPrice = $productItemPrice + $Dilivery_price;


        session()->put('delivary_method',  $service->delivary_method);
        session()->put('product_item',  $service->certificate_type);
        session()->put('productItemPrice',  $productItemPrice );
        session()->put('service_id',  $service->id);
        session()->put('delivery_price', $Dilivery_price);
        session()->put('totalPrice', $totalPrice);
        session()->put('service_type', $service->service_type);


        return redirect('payment');
    }





    
    function nicStore()
    {

  
        


        request()->validate([
            "First_Name" => 'required|string|max:255',
            "Last_Name" => 'required|string|max:255',
            "NIC" => 'required|string|max:12|exists:citizens,nic', 
            "Email" => 'required|string|email|max:255', 
            "Phone" => 'required|string|max:20',
            "District" => 'required|string|max:255',
            "Division" => 'required|string|max:255',
            "Address" => 'required|string',
            "nic_type" => 'required|string',
            "grama_niladari_certificate" => 'required|image|mimes:jpeg,png,jpg,gif',
            "birth_certificate" => 'required|image|mimes:jpeg,png,jpg,gif',
            "delivary_method" => 'required',
        ]);
        
       //dd(Request()->session()->get('cid'));
        //dd(request()->all());




        try {

            if(request()->nic_type == 'New NIC') 
            {
                $productItemPrice =5000.00;
            }
    
            if(request()->nic_type == 'NIC Renewal') 
            {
                $productItemPrice = 2000.00;
            }
 
    
            if(Request('delivary-method') == 'deliver')
            {
                $Dilivery_price = 1000.00;
            }
            else
            {
                $Dilivery_price = 500.00;
            }

            $totalPrice = $productItemPrice + $Dilivery_price;


            $cnic = request()->session()->get('cnic');
            $cnicDirectory = storage_path('app/public/' . $cnic);
        
            if (!file_exists($cnicDirectory)) {
                // Create a directory for the user if it doesn't exist
                mkdir($cnicDirectory, 0755, true);
            }
        
            $gramaNiladariCertificateName = $cnic . '_grama_niladari_certificate.' . request('grama_niladari_certificate')->getClientOriginalExtension();
            $birthCertificateName = $cnic . '_birth_certificate.' . request('birth_certificate')->getClientOriginalExtension();
        
            

            DB::beginTransaction(); // Start a database transaction


            $service = Service::create([
                'citizen_id' => request('cid'), 
                'service_type' => request('service_type'), 
                'nic_service_type' => request('nic_type'), 
                'delivary_method' => request('delivary_method'),
                'total' =>$totalPrice,
            ]);
    
            
    /* 
            $gramaNiladariCertificateName = request('grama_niladari_certificate')->getClientOriginalName();
            $birthCertificateName = request('birth_certificate')->getClientOriginalName();
    
            //dd( $birthCertificateName); */
    
            $document =Document::where('citizen_id', Request()->session()->get('cid'))->first();

        
            if ($document) {

                $document->grama_niladari_certificate = $gramaNiladariCertificateName;
                $document->birth_certificate = $birthCertificateName;
                $document->update();

            } else {

                Document::create([
                    'citizen_id' => request('cid'),
                    'grama_niladari_certificate' => $gramaNiladariCertificateName,
                    'birth_certificate' => $birthCertificateName,
                ]);

            }
        

            
            // Move and store the images with the new file names in the user's directory
            request('grama_niladari_certificate')->move($cnicDirectory, $gramaNiladariCertificateName);
            request('birth_certificate')->move($cnicDirectory, $birthCertificateName);



            DB::commit(); // Commit the transaction
           // return back()->with('success', 'Document saved successfully');


           session()->put('delivary_method',  Request('delivary-method'));
           session()->put('product_item',  Request('service_type'));
           session()->put('productItemPrice',  $productItemPrice );
           session()->put('service_id',  $service->id);
           session()->put('delivery_price', $Dilivery_price);
           session()->put('totalPrice', $totalPrice);

           return redirect('payment')->with('success', 'Request is successfully created, Please make payment');

           
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback the transaction in case of an exception
        
            throw $e;
           // return back()->with('fail', 'An error occurred while saving the document: ' . $e->getMessage());
        }
     
/* 
        








       





       
        //return redirect('payment')->with('data', $data)->with('success', 'Request is successfully created, Please make payment');
 */



    }
}
