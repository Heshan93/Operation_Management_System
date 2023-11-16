@extends('Layouts/profile-layout')

@section('Content')


<div class="container-fluid" style="background-color: #005555">
    <div >


      @include('component.profile-nav')

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3 style="color: aliceblue">User Profile</h3>
           
          </div>
          
          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12 " >
              <div class="x_panel"  >

                @include('component.error-message') 
               {{--  @dd($services->find(44)) --}}
                                  
                <div class="clearfix"></div>
                <div class="x_content" >
                  <div class="col-md-3 col-sm-3  profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
              
                          {{-- @dd(asset('storage/'.session('cnic').'/'.$documents->profile_image)) --}}

                          <img class="img-responsive avatar-view" src="{{ !$documents->profile_image == null ? asset('storage/'.session('cnic').'/'.$documents->profile_image) : asset('storage/citizen/profile_image.png') }}"
                          alt="Profile Image">
                          
                        </div>
                      </div>
                     <br />

                      <form id="imageForm" action="profile-image-store" method="POST" enctype="multipart/form-data">
                        <label for="imageUpload" class="btn btn-success" style="color: aliceblue">
                            <i class="fa fa-edit m-right-xs" style="margin-right: 10px"></i>Change Image
                        </label>
                        <input type="file" id="imageUpload" name="profile_image" style="display: none">
                        <div class="text-danger" style="text-align: left">
                          <span>@error('profile_image') {{ $message }} @enderror</span>
                        </div>
                        @csrf 
                    </form>
                  
                    <script>
                        // Add an event listener for the file input
                        document.getElementById("imageUpload").addEventListener("change", function() {
                            document.getElementById("imageForm").submit(); // Submit the form when an image is selected
                        });
                    </script>
                    
                  
                  
                    <br />
                    <h3>{{session('cfName') . '  ' .  session('clName')}} </h3>

                    <ul class="list-unstyled user_data">
                      <li><i class="fa fa-map-marker user-profile-icon"></i> {{session('caddress')}}
                      </li>

                      <li>
                        <i class="fa fa-briefcase user-profile-icon"></i> {{session('cdistrict')}}
                      </li>

                      <li class="m-top-xs">
                        <i class="fa fa-external-link user-profile-icon"></i>{{session('cdivision')}}
                        
                      </li>
                      <li>
                        <i class="fa fa-briefcase user-profile-icon"></i> {{session('cnic')}}
                      </li>
                    </ul>

                  </div>
                  <div class="col-md-9 col-sm-9 ">

              

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Pending Services</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Services Histoy</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile Info</a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">

                        <div role="tabpanel" class="tab-pane active " id="tab_content1" aria-labelledby="home-tab">


                          
                          @include('component.citizen-service-pending')


                        </div>
                            
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                          @include('component.citizen-service-history')


                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                         
                          @include('component.citizen-profile-info')

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
      <!-- /page content -->


@endsection