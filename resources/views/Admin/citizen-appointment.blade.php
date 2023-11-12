
<!DOCTYPE html>
<html lang="en">
  <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Gentelella Alela! | </title>



        
        <!-- Bootstrap -->
        <link href="{{asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <!-- NProgress -->
        <link href="{{asset('assets/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
         <!-- bootstrap-daterangepicker -->
         <link href="{{asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
         <!-- bootstrap-datetimepicker -->
         <link href="{{asset('assets/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">
 


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
                  <div class="x_panel" >
                    <div class="x_title">
                      <div class="row">
                        <div class="col-md-6 col-sm-6">
                          <h2> Citizen Appoinment </h2>
                        </div>
                        <div class="col-md-6 col-sm-6 text-right">
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                              <button class="btn btn-secondary" type="button">Go!</button>
                            </span>
                          </div>
                        </div>
                      </div>

                    
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                              <div class="card-box table-responsive">
                                <div class="row" style="padding: 15px">
                                  <div  class="col-md-6 col-sm-6 col-xs-6">
                                    <p class="text-muted font-13 m-b-30" style="padding-top: 15px">
                                     
                                    </p>
                                  </div>


                                </div>
                                 
                              

                                  <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%; padding-bottom: 30px">
                                    <thead>
                                      <tr>
                                        <th>Name</th>
                                        <th>Service Type</th>
                                        <th>Districts and Divisions</th>
                                        <th>Request Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
              
              

                                  



                                  
                                    <tbody>


                                      @for ($i=0; $i<15; $i++)

                                        <tr>
                                          <td>Tiger Nixon</td>
                                          <td>NIC Request</td>
                                          <td>Edinburgh</td>
                                          <td>2011/04/25</td>
                                          <td>Pending</td>
                                          <td>          
                                            
                                            <!-- Split button -->
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                                  aria-haspopup="true" aria-expanded="false">
                                                  Primary
                                                </button>
                                                <div class="dropdown-menu">
                                                  <a class="dropdown-item" href="#">View</a>
                                                  <a class="dropdown-item" href="#">Complete</a>
                                                  <a  class="dropdown-item" data-toggle="modal" data-target="#exampleModalCenter">Re Schedule</a>
                                                  <div class="dropdown-divider"></div>
                                                  <a  class="dropdown-item" data-toggle="modal" data-target="#Cencel">Cancelation</a>
                                                </div>
                                              </div>

                                            <!-- Split button -->
                                          </td>
                                        </tr>
                                      
                                      @endfor
                                    </tbody>
                                  </table>
                    </div>
                  </div>
                </div>
              </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>


    

              <!-- Modal -->
              <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 600px;">
                  <div class="modal-content" style="margin-top: -200px">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body"  >
                      <!-- Date and Time Picker -->
                      <div>
                        <form class="reservation-form" > 
                          <fieldset>
                            <div class="form-group row">
                              <label class="col-form-label col-md-3 col-sm-3 label-align">Appontment Date </label>
                              <div class="col-md-6 col-sm-6">
                                  <input id="NIC" class="form-control" required="required" type="Date">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label class="col-form-label col-md-3 col-sm-3 label-align">Appointment Time</label>
                              <div class="col-md-6 col-sm-6">
                                  <select id="appointment-time" class="form-control" required>
                                      @for ($hour = 8; $hour < 17; $hour++)
                                          @for ($minute = 0; $minute < 60; $minute += 15)
                                              @php
                                                  $time = sprintf("%02d:%02d", $hour, $minute);
                                              @endphp
                                              <option value="{{ $time }}">{{ $time }}</option>
                                          @endfor
                                      @endfor
                                  </select>
                              </div>
                          </div>
                          </fieldset>
                        </form>
                      </div>
                      <!-- End of Date and Time Picker -->
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>




              <!-- Modal -->
              <div class="modal fade" id="Cencel" tabindex="-1" role="dialog" aria-labelledby="CencelModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 600px;">
                  <div class="modal-content" style="margin-top: -200px">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Cancel Appointment</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body"  >
                      <!-- Date and Time Picker -->
                      
                      <h3>Are You Sure ?</h3>

                      <!-- End of Date and Time Picker -->
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>
                    </div>
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
    <!-- bootstrap-daterangepicker -->
   <script src="{{asset('assets/vendors/moment/min/moment.min.js')}}"></script>
   <script src="{{asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
   <script src="{{asset('assets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>

        <!-- Custom Theme Scripts -->
        <script src="{{asset('assets/js/gen-master/custom.min.js')}}"></script>



        <style>
          @media (max-width: 768px) {
            /* Adjust the date range picker's style for smaller screens */
            .daterangepicker {
              font-size: 14px; /* Adjust font size */
              overflow-y: auto;
             
            }
          }
        </style>

       

    </body>
</html> 