

    <div class="navbar nav_title" style="border: 0;">

        
        <a href="admin-dashboard" class="site_title">
            
            <img src="{{asset('assets/images/Dice_Bridge_logo.png')}}">
            <span style="padding-left: 15px">DiviBridge</span>
        </a>
   
    </div>



{{-- @dd( session('profile_file_name')) --}}

<div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{asset('storage/Admin-profiles/' . session('profile_file_name')) }}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{session('afname'). " " . session('alname')}}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />


        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                  <div class="menu_section">
                    <h3>Staff Management</h3>
                    <ul class="nav side-menu">
                          <li>
                            <a href="admin-dashboard"><i class="fa fa-home"></i> Dashboard </a>
                          </li>
                          <li>
                            <a href="user-manager"><i class="fa fa-home"></i> User Manager </a>
                          </li>
                          <li>
                            <a href="citizen-manager"><i class="fa fa-home"></i> Citizen Manager </a>
                          </li>
                          <li>
                            <a href="citizen-appointment"><i class="fa fa-home"></i> Appointmet Manager </a>
                          </li>
                          <li>
                            <a href="citizen-appointments"><i class="fa fa-home"></i> Reports </a>
                          </li>
                      </ul>
                  </div>

              
                 

          </div>


        <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small" >

              <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout_admin" style="width: 100%">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
        <!-- /menu footer buttons -->
</div>
</div>