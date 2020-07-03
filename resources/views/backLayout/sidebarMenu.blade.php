<div class="left_col scroll-view">
  <div class="navbar nav_title" style="border: 0;">
  </div>


  <!-- menu profile quick info -->
  <div class="profile" style="text-align: center;">

    <img src="{{ URL::asset('/images/footer-logo.png') }}" alt="..." style="width: 150px;">
  </div>
  <!-- /menu profile quick info -->
  <br />

  <!-- sidebar menu -->
  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      <!-- <h3>General</h3> -->
      <ul class="nav side-menu">
        @if (Sentinel::getUser()->hasAnyAccess(['user.*']))
        <li><a><i class="fa fa-users"></i>Users <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{route('user.index')}}">All users</a></li>
            <li><a href="{{route('user.create')}}">New user</a></li>
          </ul>
        </li>
        @endif
        @if (Sentinel::getUser()->hasAnyAccess(['role.*']))
        <li><a><i class="fa fa-cog"></i> Roles <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{route('role.index')}}">All Roles</a></li>
            <li><a href="{{route('role.create')}}">New Role</a></li>
          </ul>
        </li>
        @endif
        @if (Sentinel::getUser()->hasAnyAccess(['categories.*']))
        <li><a href="{{route('categories.index')}}"><i class="fa fa-bookmark"></i> Categories</a></li>
        @endif
      </ul>
    </div>
    <div class="menu_section">
      <ul class="nav side-menu">
        <li><a href="{{url('dashboard')}}"><i class="fa fa-sitemap"></i> File Management</a></li>
        <li><a><i class="fa fa-book"></i> Product Digital Library <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{route('questions.index')}}">All Products</a></li>
            @if (Sentinel::getUser()->hasAnyAccess(['questions.create']))
            <li><a href="{{route('questions.create')}}">New Product</a></li>
            @endif
          </ul>
        </li>
        
        <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span
              class="label label-success pull-right">Coming Soon</span></a></li>
      </ul>
    </div>
  </div>
  <!-- /sidebar menu -->

  <!-- /menu footer buttons -->
  <div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" title="Settings">
      <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Notification" >
      <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
    </a>
    <a href="{{route('user.edit', Sentinel::getUser()->id)}}" data-toggle="tooltip" data-placement="top" title="Edit Profile">
      <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
    </a>
    {!! Form::open(['url' => url('logout'),'class'=>'form-inline', 'id'=>'logoutform']) !!}
    {!! csrf_field() !!}
    <a data-toggle="tooltip" data-placement="top" title="Logout" onclick="document.getElementById('logoutform').submit();">
      <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
    {!! Form::close() !!}
  </div>
  <!-- /menu footer buttons -->
</div>