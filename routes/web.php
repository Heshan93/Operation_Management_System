<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CitizenController;
use App\Http\Controllers\ServicesController;
use App\Http\Middleware\AuthCitizen;
use App\Http\Controllers\DownloadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('news_1',function(){

    return view('News/news1');
});

Route::get('news_2',function(){

    return view('News/news2');
});

Route::get('news_3',function(){

    return view('News/news3');
});

Route::get('news_4',function(){

    return view('News/news4');
});

Route::get('about',function(){

    return view('about');
});

Route::get('contact-us',function(){

    return view('contact-us');
});

Route::get('service',function(){

    return view('service');
});









Route::get('pay-details',function(){

    return view('pay-details');
});






Route::get('user-access',function(){

    return view('Admin/user-access');
});





Route::get('view-user',function(){

    return view('Admin/view-user');
});




Route::get('add-citizen-id',function(){

    return view('Admin/add-citizen-id');
});





Route::get('view-citizen',function(){

    return view('Admin/view-citizen');
});



Route::get('edit-citizen',function(){

    return view('Admin/edit-citizen');
});


Route::get('citizen-file-manage',function(){

    return view('Admin/citizen-file-manage');
});





Route::get('citizen-appointment-view',function(){

    return view('Admin/citizen-appointment-view');
});


Route::get('appointment-user',function(){

    return view('Admin/appointment');
});



Route::get('appointment-complete',function(){

    return view('Admin/appointment-complete');
});


Route::get('appointment-reports',function(){

    return view('Admin/Reports/appointment-reports');
});









/*==========================*/

Route::view('Download','download');

Route::get('pdf1', [DownloadController::class, 'downloadPdf1']);
Route::get('pdf2', [DownloadController::class, 'downloadPdf2']);
Route::get('pdf3', [DownloadController::class, 'downloadPdf3']);

Route::view('citizen-login','Auth/citizen-login'); 
Route::post('login_Citizen',[CitizenController::class,'index']);
Route::post('register_Citizen',[CitizenController::class,'store']);
Route::get('logout_citizen',[CitizenController::class,'flush']);


Route::view('appointment', 'Forms/appointment')->middleware('AuthCitizen');
Route::post('appointment_store',[ServicesController::class,'appointmentStore'])->middleware('AuthCitizen');


Route::view('certificates', 'Forms/certificates')->middleware('AuthCitizen');
Route::post('certificates-store', [ServicesController::class,'store'])->middleware('AuthCitizen');
Route::view('payment', 'payment')->middleware('AuthCitizen');
Route::post('payment_store', [ServicesController::class,'payment'])->middleware('AuthCitizen');
Route::get('payment_pending/{id}', [ServicesController::class,'paymentPending'])->middleware('AuthCitizen');



Route::view('nic', 'Forms/nic')->middleware('AuthCitizen');
Route::post('nic-store',[ServicesController::class,'nicStore'])->middleware('AuthCitizen');

Route::view('passport', 'Forms/passport')->middleware('AuthCitizen');
Route::post('passport_store',[ServicesController::class,'passportStore'])->middleware('AuthCitizen');


Route::view('vehicle-revenue', 'Forms/vehicle-revenue')->middleware('AuthCitizen');
Route::post('vh_revenue_store',[ServicesController::class,'revenueStore'])->middleware('AuthCitizen');




Route::get('profile', [CitizenController::class,'intProfile'])->middleware('AuthCitizen');
Route::post('profile-store', [CitizenController::class,'update'])->middleware('AuthCitizen');
Route::post('profile-image-store', [CitizenController::class,'imageStore'])->middleware('AuthCitizen');



Route::get('admin-login', function(){
    
    if(session('is_admin_login') == true){

        return redirect('admin-dashboard');
    }

    return view('Auth/admin-login');
});

Route::view('admin-dashboard','Admin/dashboard')->middleware('AdminAuth');
Route::post('admin-auth',[Controller::class,'login']);
Route::get('logout_admin',[Controller::class,'flush']);



Route::view('add-user','Admin/add-user')->middleware('AdminAuth');
Route::post('stor_admin',[Controller::class,'storAdmin'])->middleware('AdminAuth');

Route::view('citizen-manager','Admin/citizen-manager')->middleware('AdminAuth');

Route::view('citizen-appointment','Admin/citizen-appointment')->middleware('AdminAuth');

Route::get('user-manager',[Controller::class,'getUserManager'])->middleware('AdminAuth');
Route::get('view_edit_user/{id}',[Controller::class,'getUserEdit'])->middleware('AdminAuth');
Route::post('update_admin', [Controller::class, 'updateUser'])->middleware('AdminAuth');
Route::get('delete_admin/{id}', [Controller::class, 'deleteUser'])->middleware('AdminAuth');






