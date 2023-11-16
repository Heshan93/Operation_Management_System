
<!DOCTYPE html>
<html lang="en">
  <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Gentelella Alela! | </title>


        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        
        <!-- Bootstrap -->
        <link href="{{asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <!-- NProgress -->
        <link href="{{asset('assets/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
        <!-- iCheck -->
        <link href="{{asset('assets/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
        <!-- bootstrap-wysiwyg -->
	      <link href="{{asset('assets/vendors/google-code-prettify/bin/prettify.min.css')}}" rel="stylesheet">      
        <!-- Select2 -->
        <link href="{{asset('assets/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
        <!-- Switchery -->
        <link href="{{asset('assets/vendors/switchery/dist/switchery.min.css')}}" rel="stylesheet">
        <!-- starrr -->
        <link href="{{asset('assets/vendors/starrr/dist/starrr.css')}}" rel="stylesheet">
        <!-- bootstrap-progressbar -->
        <link href="{{asset('assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
        
        <!-- Custom Theme Style   -->
        <link href="{{asset('assets/css/custom.min.css')}}" rel="stylesheet">
        
  </head>


<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">

            @include('Admin.Components.admin-sidebar')

              @include('Admin.Components.admin-topbar')


              <div class="right_col" role="main">




                <div class="col-md-12 col-sm-12 "  style="padding-top: 30px">

                  <form action="stor_admin" method="POST" enctype="multipart/form-data">
                    @csrf

                  <div class="x_panel" >
                    <form class="form-label-left input_mask">
                    <div class="x_title">
                      <div class="row">
                        <div class="col-md-6 col-sm-6">
                          <h2>Create User</h2>
                        </div>

                        @include('component.error-message') 
                        
                      </div>




                      <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                              
                              <div class="card-box table-responsive">

                                <div class="col-md-12 col-sm-12" style="padding-top: 30px">
                                  <div class="x_panel">

                                          <div class="x_content">
                                            <div class="row" style="padding: 15px">
                                                <div class="col-md-6 col-sm-6 mb-2">
                                                    <!-- Container for user image and icon -->
                                                    <div class="border border-dark" style="position: relative; max-width: 250px; cursor: pointer;">
                                                        <!-- User Image -->
                                                        <label for="imageUpload" style="width: 100%;">
                                                            <div id="user-image-container">
                                                                <img id="user-image" src="{{asset('assets/images/person_3-min.jpg')}}" alt="user-image" style="width: 100%;">
                                                            </div>
                                                            <!-- Plus-square icon inside the container -->
                                                            <i class="fa fa-plus-square" style="position: absolute; bottom: 0; right: 0; font-size: 24px; color:#2a3f54; background-color: rgb(255, 255, 255)"></i>
                                                        </label>
                                                        <div class="text-danger" style="text-align: left">
                                                          <span style="color: red;">@error('profile_img') {{ $message }} @enderror</span>
                                                        </div>
                                                        <input type="file" name="profile_img" id="imageUpload" style="display: none" accept=".jpeg, .png, .jpg" onchange="updateUserImage(this)">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 mb-2">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <script>
                                            function updateUserImage(input) {
                                                var userImageContainer = document.getElementById('user-image-container');
                                                var userImage = document.getElementById('user-image');
                                        
                                                var file = input.files[0];
                                        
                                                if (file) {
                                                    var reader = new FileReader();
                                        
                                                    reader.onload = function (e) {
                                                        userImage.src = e.target.result;
                                                    };
                                        
                                                    reader.readAsDataURL(file);
                                                }
                                            }
                                        </script>
                                        
                                      
                                    
                                  

{{--                                        
                                          <div class="col-md-6 col-sm-6  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="first-name" placeholder="ID" disabled>
                                            <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                                          </div> --}}
                                          
                    
                                        <div class="x_content">
                                          <div class="col-md-6 col-sm-6  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="first-name" name="first_name" placeholder="First Name">
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            <div class="text-danger" style="text-align: left">
                                              <span style="color: red;">@error('first_name') {{ $message }} @enderror</span>
                                            </div>
                                          </div>
                      
                                          <div class="col-md-6 col-sm-6  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" name="last_name" id="last-name" placeholder="Last Name">
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            <div class="text-danger" style="text-align: left">
                                              <span style="color: red;">@error('last_name') {{ $message }} @enderror</span>
                                            </div>
                                          </div>
                      
                                          <div class="col-md-6 col-sm-6  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" name="nic" id="inputSuccess4" placeholder="NIC">
                                            <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                                            <div class="text-danger" style="text-align: left">
                                              <span style="color: red;">@error('nic') {{ $message }} @enderror</span>
                                            </div>
                                          </div>
                      
                                          <div class="col-md-6 col-sm-6  form-group has-feedback">
                                            <input type="email" class="form-control has-feedback-left" name="email" id="inputSuccess4" placeholder="Email">
                                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                            <div class="text-danger" style="text-align: left">
                                              <span style="color: red;">@error('email') {{ $message }} @enderror</span>
                                            </div>
                                          </div>

                                          <div class="col-md-6 col-sm-6  form-group has-feedback">
                                            <input type="numeric" class="form-control has-feedback-left" name="phone" id="inputSuccess4" placeholder="Phone">
                                            <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                            <div class="text-danger" style="text-align: left">
                                              <span style="color: red;">@error('phone') {{ $message }} @enderror</span>
                                            </div>
                                          </div>

                                          
                                          <div class="col-md-6 col-sm-6  form-group has-feedback">
                                            <select class="form-control has-feedback-left" name="job_roll" id="inputSuccess4" >
                                              <option disabled selected>Choose Job Roll</option>
                                              <option>Grama Niladari</option>
                                              <option>Samurdi Niladari</option>
                                              <option>Sanwardana Niladari</option>
                                          </select>
                                            <span class="fa fa-suitcase form-control-feedback left" aria-hidden="true"></span>
                                            <div class="text-danger" style="text-align: left">
                                              <span style="color: red;">@error('job_roll') {{ $message }} @enderror</span>
                                            </div>
                                          </div>
                      
                                          <div class="col-md-6 col-sm-6  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" name="address" id="inputSuccess4" placeholder="Address">
                                            <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                                            <div class="text-danger" style="text-align: left">
                                              <span style="color: red;">@error('address') {{ $message }} @enderror</span>
                                            </div>
                                          </div>

                                          <div class="col-md-6 col-sm-6  form-group has-feedback">
                                            <select class="form-control has-feedback-left" name="district"  >
                                              <option disabled selected>Choose Duty District</option>
                                              <option>D1</option>
                                              <option>D2</option>
                                              <option>D3</option>
                                          </select>
                                            <span class="fa fa-university form-control-feedback left" aria-hidden="true"></span>
                                            <div class="text-danger" style="text-align: left">
                                              <span style="color: red;">@error('district') {{ $message }} @enderror</span>
                                            </div>
                                          </div>

                                          <div class="col-md-6 col-sm-6  form-group has-feedback">
                                            <select class="form-control has-feedback-left" name="division"  >
                                              <option disabled selected>Choose Duty Divition</option>
                                              <option>D1</option>
                                              <option>D2</option>
                                              <option>D3</option>
                                          </select>
                                            <span class="fa fa-sort form-control-feedback left" aria-hidden="true"></span>
                                            <div class="text-danger" style="text-align: left">
                                              <span style="color: red;">@error('division') {{ $message }} @enderror</span>
                                            </div>
                                          </div>

                                          <div class="col-md-6 col-sm-6  form-group has-feedback">
                                            <input type="password" class="form-control has-feedback-left" name="password" id="inputSuccess4" placeholder="Password">
                                            <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                                            <div class="text-danger" style="text-align: left">
                                              <span style="color: red;">@error('password') {{ $message }} @enderror</span>
                                            </div>
                                          </div>



                                       </div>

                     
                                    </div>

                                  </div>
                                </div>

                               </div>

                            </div>
                          </div>




                          <div class="col-md-12 col-sm-12" style="padding-top: 30px">
                            <div class="x_panel">

                              <div class="x_content">
                                <br />        

                                  <div class="row">
                                    <h2>Access Management</h2>
                                  </div>
                                  <div class="row">



                                                                    
                                <div class="col-md-12 col-sm-12">
                                  <div class="x_panel">

                                      <div class="row " style="padding-top: 30px">
                                        <div class="col-md-3 col-sm-3">
                                          <div class="">
                                            <label>
                                              <input type="checkbox" class="js-switch" value="1" name="is_view_user" unchecked /> View User
                                            </label>
                                          </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                          <div class="">
                                            <label>
                                              <input type="checkbox" class="js-switch" value="1" name="is_edit_user" unchecked /> User Edit
                                            </label>
                                          </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                          <div class="">
                                            <label>
                                              <input type="checkbox" class="js-switch" value="1" name="is_view_citizen" unchecked /> View Citizens
                                            </label>
                                          </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                          <div class="">
                                            <label>
                                              <input type="checkbox" class="js-switch" value="1" name="is_edit_citizen" unchecked />Edid Citizen
                                          </div>
                                        </div>

                                      </div>




                                      <div class="row " style="padding-top: 30px">
                                        <div class="col-md-3 col-sm-3">
                                          <div class="">
                                            <label>
                                              <input type="checkbox" class="js-switch" value="1" name="is_manage_appointment" unchecked /> Manage Service
                                            </label>
                                          </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                          <div class="">
                                            <label>
                                              <input type="checkbox" class="js-switch" value="1" name="is_view_reports" unchecked /> View Reports
                                            </label>
                                          </div>
                                        </div>
                                        {{-- <div class="col-md-3 col-sm-3">
                                          <div class="">
                                            <label>
                                              <input type="checkbox" class="js-switch" name="" checked /> User Delete
                                            </label>
                                          </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                          <div class="">
                                            <label>
                                              <input type="checkbox" class="js-switch" name="" checked />Access Management                                              
                                            </label>
                                          </div>
                                        </div> --}}

                                      </div>

                                      



                                  </div>
                                </div>


                                  </div>



                              </div>

                            </div>
                          </div>



                </div>

                <div class="col-md-9 col-sm-9  offset-md-3">
                                     
                  <button type="button" class="btn btn-primary">Back</button>
                 
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>


              </div>

            </form>
           

          </div>

        </form>
        </div>
      </div>
    </div>




    

            @include('Admin.Components.admin-footer')






       
    <!-- jQuery -->
    <script src="{{asset('assets/vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('assets/vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{asset('assets/vendors/nprogress/nprogress.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{asset('assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('assets/vendors/iCheck/icheck.min.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('assets/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="{{asset('assets/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js')}}"></script>
    <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="{{asset('assets/vendors/jquery.tagsinput/src/jquery.tagsinput.js')}}"></script>
    <!-- Switchery -->
    <script src="{{asset('assets/vendors/switchery/dist/switchery.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('assets/vendors/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- Parsley -->
    <script src="{{asset('assets/vendors/parsleyjs/dist/parsley.min.js')}}"></script>
    <!-- Autosize -->
    <script src="{{asset('assets/vendors/autosize/dist/autosize.min.js')}}"></script>
    <!-- jQuery autocomplete -->
    <script src="{{asset('assets/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js')}}"></script>
    <!-- starrr -->
    <script src="{{asset('assets/vendors/starrr/dist/starrr.js')}}"></script>
    


        <!-- Custom Theme Scripts -->
        <script src="{{asset('assets/js/gen-master/custom.min.js')}}"></script>



    </body>
</html>

